<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Appointment;
use App\Models\Payment;
use App\Models\CheckResult;
use Illuminate\Support\Str;
use App\Models\SpecialAppointment;
use App\Models\SpecialPayment;
use App\Models\MedicalCenter;
use Illuminate\Support\Facades\DB;

class PublicController extends Controller
{
    public function index()
    {
        return view('public.home');
    }

    public function guidelines()
    {
        return view('public.guidelines');
    }

    public function faq()
    {
        return view('public.faq');
    }

    public function contactus(){
        return view('public.contact');
    }

    public function medicalExamination(){
        return view('public.appointments.medical-examination');
    }

    public function storeAppointment(Request $request)
    {
        $rules = [
            'country' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'country_traveling_to' => 'required|string|max:100',
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'date_of_birth' => 'required|date|before_or_equal:today',
            'nationality' => 'required|string|max:100',
            'gender' => 'required|string',
            'marital_status' => 'required|string',
            'passport_no' => 'required|string|max:50',
            'confirm_passport_no' => 'required|same:passport_no',
            'passport_issue_date' => 'required|date|before_or_equal:today',
            'passport_issue_place' => 'required|string|max:100',
            'passport_expiry_date' => [
                'required',
                'date',
                'after:passport_issue_date',
                function ($attribute, $value, $fail) {
                    $minExpiry = now()->addMonths(6)->addDays(21); // 6 months + 21 days from today
                    if (strtotime($value) < strtotime($minExpiry)) {
                        $fail('Passport Expiry Date must be at least 6 months and 21 days from today.');
                    }
                    if (strtotime($value) < time()) {
                        $fail('Passport Expiry Date cannot be in the past.');
                    }
                },
            ],
            'visa_type' => 'required|string|max:100',
            'email' => 'required|email',
            'phone' => ['required', 'regex:/^\+?\d[\d\s\-]{9,14}$/'],
            'national_id' => 'required|string|max:50',
            'position_applied' => 'required|string|max:100',
            'other_position' => 'nullable|required_if:position_applied,other|string|max:100',
            'confirm_info' => 'accepted',
        ];

        $messages = [
            'country.required' => 'Select Country',
            'city.required' => 'Select City',
            'country_traveling_to.required' => 'Select Country Traveling To',
            'first_name.required' => 'Enter First Name',
            'last_name.required' => 'Enter Last Name',
            'date_of_birth.required' => 'Enter Date of Birth',
            'date_of_birth.date' => 'Enter a valid Date of Birth',
            'date_of_birth.before_or_equal' => 'Date of Birth cannot be a future date',
            'nationality.required' => 'Select Nationality',
            'gender.required' => 'Select Gender',
            'marital_status.required' => 'Select Marital Status',
            'passport_no.required' => 'Enter Passport No',
            'confirm_passport_no.required' => 'Confirm Passport No is required',
            'confirm_passport_no.same' => 'Confirm Passport No must match Passport No',
            'passport_issue_date.required' => 'Enter Passport Issue Date',
            'passport_issue_date.before_or_equal' => 'Passport Issue Date cannot be in the future',
            'passport_issue_place.required' => 'Enter Passport Issue Place',
            'passport_expiry_date.required' => 'Enter Passport Expiry Date',
            'passport_expiry_date.after' => 'Passport Expiry Date must be after Passport Issue Date',
            'visa_type.required' => 'Select Visa Type',
            'email.required' => 'Enter Email ID',
            'email.email' => 'Enter a valid Email ID',
            'phone.required' => 'Enter Phone No',
            'phone.regex' => 'Phone number must be 10-15 digits',
            'national_id.required' => 'Enter National ID',
            'position_applied.required' => 'Select Position Applied For',
            'other_position.required_if' => 'Enter Other Position',
            'confirm_info.accepted' => 'You must confirm that the information is correct',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = $request->all();

        // Convert checkbox value to boolean
        $data['confirm_info'] = $request->has('confirm_info') ? 1 : 0;

        $appointment = Appointment::create($data);

        // Generate Appointment No (e.g., APPT-2025-00001)
        $appointment->appointment_no = 'APT' . '-' . str_pad($appointment->id, 3, '0', STR_PAD_LEFT);
        $appointment->save();

        
        // Store appointment ID in session
        session(['appointment_id' => $appointment->id]);

        return response()->json([
            'status' => 'success',
            'redirect' => route('appointment.confirmation') // no ID in URL
        ]);
    }

    public function confirmAppointment(Request $request)
    {
        $appointment_id = session('appointment_id');

        if (!$appointment_id || !$appointment = Appointment::find($appointment_id)) {
            // If no appointment in session, redirect home
            return redirect()->route('home')->with('error', 'Unauthorized access.');
        }

        return view('public.appointments.appointment-confirmation', compact('appointment'));
    }

    public function uploadPaymentProof(Request $request)
    {
        $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'passport_no' => 'required|string|max:50',
            'mobile_no' => 'required|string|max:20',
            'payment_method' => 'required|string',
            'transaction_no' => 'required|string',
            'proof_image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'agreeTerms' => 'accepted', // Checkbox must be checked
        ], [
            'passport_no.required' => 'Enter passport number',
            'mobile_no.required' => 'Enter phone number',
            'payment_method.required' => 'Select a payment method',
            'transaction_no.required' => 'Enter transaction number',
            'proof_image.required' => 'Upload your payment screenshot',
            'agreeTerms.accepted' => 'You must agree to the terms and conditions',
        ]);

        // Upload image manually to public/uploads
        $image = $request->file('proof_image');
        $randomName = Str::random(40) . '.' . $image->getClientOriginalExtension();

        $image->move(public_path('uploads'), $randomName);

        // Save to DB
        Payment::create([
            'appointment_id' => $request->appointment_id,
            'passport_no' => $request->passport_no,
            'mobile_no' => $request->mobile_no,
            'payment_method' => $request->payment_method,
            'transaction_no' => $request->transaction_no,
            'proof_image' => $randomName,
        ]);

        // Store appointment ID in session for Thank You page
        session(['appointment_paid_id' => $request->appointment_id]);

        // Forget the old session for confirmation page
        session()->forget('appointment_id');

        return response()->json([
            'status' => 'success',
            'redirect' => route('thank.you') // no ID in URL
        ]);
    }

    public function thankYou(Request $request)
    {
        $appointment_id = session('appointment_paid_id');

        if (!$appointment_id || !$appointment = Appointment::find($appointment_id)) {
            return redirect()->route('home')->with('error', 'Unauthorized access.');
        }

        // Clear session so the user cannot reload the thank-you page
        session()->forget('appointment_paid_id');

        return view('public.appointments.thank-you', compact('appointment'));
    }

    public function ViewMedicalReport(){
        return view('public.appointments.ViewMedicalReport');
    }

    public function saveMedicalReport(Request $request)
    {
        $validated = $request->validate([
            'passport_no' => 'required|string|max:255',
            'nationality' => 'required|string|max:255',
            'phone'       => 'required|string|max:20',
        ]);

        CheckResult::create($validated);

        return response()->json([
            'status'   => 'success',
            'redirect' => route('ViewMedicalReport'),
        ]);
    }

    public function specialAppointmentForm()
    {
        return view('public.specialappointments.special-medical-examination');
    }

    public function storeSpecialAppointment(Request $request)
    {
        $rules = [
            'country' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'country_traveling_to' => 'required|string|max:100',
            'medical_center' => 'required|string|max:150', // new field
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'date_of_birth' => 'required|date|before_or_equal:today',
            'nationality' => 'required|string|max:100',
            'gender' => 'required|string',
            'marital_status' => 'required|string',
            'passport_no' => 'required|string|max:50',
            'confirm_passport_no' => 'required|same:passport_no',
            'passport_issue_date' => 'required|date|before_or_equal:today',
            'passport_issue_place' => 'required|string|max:100',
            'passport_expiry_date' => [
                'required',
                'date',
                'after:passport_issue_date',
                function ($attribute, $value, $fail) {
                    $minExpiry = now()->addMonths(6)->addDays(21);
                    if (strtotime($value) < strtotime($minExpiry)) {
                        $fail('Passport Expiry Date must be at least 6 months and 21 days from today.');
                    }
                    if (strtotime($value) < time()) {
                        $fail('Passport Expiry Date cannot be in the past.');
                    }
                },
            ],
            'visa_type' => 'required|string|max:100',
            'email' => 'required|email',
            'phone' => ['required', 'regex:/^\+?\d[\d\s\-]{9,14}$/'],
            'national_id' => 'required|string|max:50',
            'position_applied' => 'required|string|max:100',
            'other_position' => 'nullable|required_if:position_applied,other|string|max:100',
            'confirm_info' => 'accepted',
        ];

        $messages = [
            'country.required' => 'Select Country',
            'city.required' => 'Select City',
            'country_traveling_to.required' => 'Select Country Traveling To',
            'medical_center.required' => 'Select Medical Center',
            'first_name.required' => 'Enter First Name',
            'last_name.required' => 'Enter Last Name',
            'date_of_birth.required' => 'Enter Date of Birth',
            'date_of_birth.date' => 'Enter a valid Date of Birth',
            'date_of_birth.before_or_equal' => 'Date of Birth cannot be a future date',
            'nationality.required' => 'Select Nationality',
            'gender.required' => 'Select Gender',
            'marital_status.required' => 'Select Marital Status',
            'passport_no.required' => 'Enter Passport No',
            'confirm_passport_no.required' => 'Confirm Passport No is required',
            'confirm_passport_no.same' => 'Confirm Passport No must match Passport No',
            'passport_issue_date.required' => 'Enter Passport Issue Date',
            'passport_issue_date.before_or_equal' => 'Passport Issue Date cannot be in the future',
            'passport_issue_place.required' => 'Enter Passport Issue Place',
            'passport_expiry_date.required' => 'Enter Passport Expiry Date',
            'passport_expiry_date.after' => 'Passport Expiry Date must be after Passport Issue Date',
            'visa_type.required' => 'Select Visa Type',
            'email.required' => 'Enter Email ID',
            'email.email' => 'Enter a valid Email ID',
            'phone.required' => 'Enter Phone No',
            'phone.regex' => 'Phone number must be 10-15 digits',
            'national_id.required' => 'Enter National ID',
            'position_applied.required' => 'Select Position Applied For',
            'other_position.required_if' => 'Enter Other Position',
            'confirm_info.accepted' => 'You must confirm that the information is correct',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = $request->all();

        // Convert checkbox value to boolean
        $data['confirm_info'] = $request->has('confirm_info') ? 1 : 0;

        $appointment = SpecialAppointment::create($data);

        // Generate Appointment No (e.g., SP-2025-00001)
        $appointment->appointment_no = 'SP' . '-' . str_pad($appointment->id, 3, '0', STR_PAD_LEFT);
        $appointment->save();

        // Store appointment ID in session
        session(['special_appointment_id' => $appointment->id]);

        return response()->json([
            'status' => 'success',
            'redirect' => route('special.confirm') // no ID in URL, use session
        ]);
    }

    public function confirmSpecialAppointment(Request $request)
    {
        $appointment_id = session('special_appointment_id');

        if (!$appointment_id || !$appointment = SpecialAppointment::find($appointment_id)) {
            return redirect()->route('home')->with('error', 'Unauthorized access.');
        }

        // Fee calculation based on city
        $fee = match (strtolower($appointment->city)) {
            'gujranwala' => 7000,
            'lahore' => 12000,
            default => 4500,
        };

        return view('public.specialappointments.appointment-confirmation', compact('appointment', 'fee'));
    }

    public function uploadSpecialPaymentProof(Request $request)
    {
        $request->validate([
            'special_appointment_id' => 'required|exists:special_appointments,id',
            'passport_no' => 'required|string|max:50',
            'mobile_no' => 'required|string|max:20',
            'payment_method' => 'required|string',
            'transaction_no' => 'required|string',
            'proof_image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'agreeTerms' => 'accepted',
        ], [
            'special_appointment_id.required' => 'Invalid appointment',
            'special_appointment_id.exists' => 'Invalid appointment',
            'passport_no.required' => 'Enter passport number',
            'mobile_no.required' => 'Enter phone number',
            'payment_method.required' => 'Select a payment method',
            'transaction_no.required' => 'Enter transaction number',
            'proof_image.required' => 'Upload your payment screenshot',
            'agreeTerms.accepted' => 'You must agree to the terms and conditions',
        ]);

        // Upload image to public/uploads
        $image = $request->file('proof_image');
        $randomName = Str::random(40) . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('uploads'), $randomName);

        // Save special payment
        SpecialPayment::create([
            'special_appointment_id' => $request->special_appointment_id,
            'passport_no' => $request->passport_no,
            'mobile_no' => $request->mobile_no,
            'payment_method' => $request->payment_method,
            'transaction_no' => $request->transaction_no,
            'proof_image' => $randomName,
        ]);

        session(['special_appointment_paid_id' => $request->special_appointment_id]);

        return response()->json([
            'status' => 'success',
            'redirect' => route('special.thankyou'),
        ]);
    }

    public function specialThankYou(Request $request)
    {
        $specialAppointmentId = session('special_appointment_paid_id');

        if (
            !$specialAppointmentId ||
            !$appointment = SpecialAppointment::find($specialAppointmentId)
        ) {
            return redirect()->route('home')->with('error', 'Unauthorized access.');
        }

        // Clear session so page can't be reloaded
        session()->forget('special_appointment_paid_id');

        return view('public.specialappointments.thank-you', compact('appointment'));
    }

    public function medicalCenters(){
        return view('public.ViewMedicalCenters');
    }

    public function search(Request $request)
    {
        $query = DB::table('medical_centers');

        // 1. Filtering
        if ($request->filled('country')) {
            $query->where('country', $request->country);
        }
        if ($request->filled('city')) {
            $query->where('city', $request->city);
        }
        if ($request->filled('center_name')) {
            $query->where('medical_center', 'LIKE', '%' . $request->center_name . '%');
        }

        // 2. Sorting (Default to medical_center ASC)
        $sortColumn = $request->get('sort_by', 'medical_center');
        $sortOrder = $request->get('sort_order', 'asc');

        // Whitelist columns to prevent SQL injection
        $allowedColumns = ['medical_center', 'country', 'city', 'address_line_1', 'address_line_2', 'phone', 'email', 'website', 'rating'];
        
        if (in_array($sortColumn, $allowedColumns)) {
            $query->orderBy($sortColumn, $sortOrder);
        } else {
            $query->orderBy('medical_center', 'asc');
        }

        // 3. Pagination (10 per page)
        $results = $query->paginate(10);

        return response()->json([
            'status' => 'success',
            'data' => $results
        ]);
    }

}
