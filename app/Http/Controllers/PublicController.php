<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Appointment;
use App\Models\Payment;


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
        return view('public.medical-examination');
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
        $appointment->appointment_no = 'APT' . '-' . str_pad($appointment->id, 5, '0', STR_PAD_LEFT);
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

        return view('public.appointment-confirmation', compact('appointment'));
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

        // Upload image
        $imagePath = $request->file('proof_image')->store('payment_proofs', 'public');

        // Save to DB
        Payment::create([
            'appointment_id' => $request->appointment_id,
            'passport_no' => $request->passport_no,
            'mobile_no' => $request->mobile_no,
            'payment_method' => $request->payment_method,
            'transaction_no' => $request->transaction_no,
            'proof_image' => $imagePath,
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

        return view('public.thank-you', compact('appointment'));
    }



}
