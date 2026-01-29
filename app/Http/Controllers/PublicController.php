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
use App\Models\NavtechAppointment;
use App\Models\NavtechPayment;
use App\Models\TasheerAppointment;
use App\Models\TasheerPayment;
use App\Models\SoftSkillCertificate;
use App\Models\SoftSkillPayment;
use App\Models\Faq;
use App\Models\ContactInquiry;
use App\Models\PrivateFeedback;
use App\Models\Blog;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactInquiryMail;
use Illuminate\Support\Facades\DB;
use App\Models\PaymentMethod;
use App\Models\AppointmentFee;
use App\Models\BlogCategory;
use App\Models\Testimonial;
use App\Models\WhatsappTrack;
use App\Models\VisitorLog;
use App\Services\NotificationService;

class PublicController extends Controller
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }
    private function getGeoLocation($ip)
    {
        // Skip localhost IPs
        if ($ip == '127.0.0.1' || $ip == '::1') {
            return ['country' => 'Localhost', 'region' => 'Local', 'city' => 'Local'];
        }

        try {
            $response = @file_get_contents("http://ip-api.com/json/{$ip}?fields=country,regionName,city");
            if ($response) {
                $data = json_decode($response, true);
                return [
                    'country' => $data['country'] ?? null,
                    'region' => $data['regionName'] ?? null,
                    'city' => $data['city'] ?? null,
                ];
            }
        } catch (\Exception $e) {
            // Fail silently
        }

        return ['country' => null, 'region' => null, 'city' => null];
    }

    public function trackWhatsapp(Request $request)
    {
        $ip = $request->ip();
        $location = $this->getGeoLocation($ip);

        WhatsappTrack::create([
            'ip_address' => $ip,
            'user_agent' => $request->header('User-Agent'),
            'page_url' => $request->headers->get('referer'),
            'country' => $location['country'],
            'region' => $location['region'],
            'city' => $location['city'],
        ]);

        return response()->json(['status' => 'tracked']);
    }

    public function trackVisitor(Request $request)
    {
        // Don't track if the user is already logged in as admin to keep data clean
        if (auth()->check()) {
            return response()->json(['status' => 'admin_ignored']);
        }

        $ip = $request->ip();
        $location = $this->getGeoLocation($ip);

        VisitorLog::create([
            'ip_address' => $ip,
            'user_agent' => $request->header('User-Agent'),
            'page_url' => $request->input('page_url') ?? $request->headers->get('referer') ?? url()->current(),
            'referrer' => $request->input('referrer'),
            'country' => $location['country'],
            'region' => $location['region'],
            'city' => $location['city'],
        ]);

        return response()->json(['status' => 'tracked']);
    }
    private function getFee($key, $default = 0)
    {
        return AppointmentFee::where('fee_key', $key)->value('amount') ?? $default;
    }
    public function index()
    {
        // Fetch up to 12 testimonials for the carousel: Prioritize Google, then Featured, then Latest approved
        $testimonials = Testimonial::approved()
            ->onHomepage()
            ->orderByRaw("FIELD(source, 'google') DESC")
            ->orderBy('is_featured', 'desc')
            ->orderBy('created_at', 'desc')
            ->take(12)
            ->get();

        return view('public.home', compact('testimonials'));
    }

    public function faq()
    {
        // Fetch active FAQs
        $faqs = Faq::where('status', 1)->get();

        return view('public.faq', compact('faqs'));
    }

    public function contactus()
    {
        $faqs = Faq::where('status', 1)->take(5)->get();
        return view('public.contact', compact('faqs'));
    }

    public function storecontact(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:100',
            'subject' => 'required|string|max:100',
            'message' => 'required|string|min:5|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = [
            'name' => strip_tags($request->name),
            'phone' => strip_tags($request->phone),
            'email' => strip_tags($request->email),
            'subject' => strip_tags($request->subject),
            'message' => strip_tags($request->message),
            'is_new' => 1,
        ];

        // 1. Save to Database
        ContactInquiry::create(array_merge($data, ['ip_address' => $request->ip()]));

        // 2. Send Email (Update 'admin@example.com' to your email)
        try {
            Mail::to('admin@yourdomain.com')->send(new ContactInquiryMail($data));
        } catch (\Exception $e) {
            // Log error but continue so the user knows their data was saved
            \Log::error("Mail failed: " . $e->getMessage());
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Thank you! Your inquiry has been sent successfully.'
        ]);
    }

    public function storeFeedback(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'rating' => 'required|integer|min:1|max:5',
            'message' => 'required|string|min:5|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        $sanitized = [
            'name' => strip_tags($request->name),
            'email' => strip_tags($request->email),
            'rating' => $request->rating,
            'message' => strip_tags($request->message),
        ];

        PrivateFeedback::create($sanitized);

        return response()->json([
            'status' => 'success',
            'message' => 'Thank you for your feedback! It helps us improve our service.'
        ]);
    }

    public function about()
    {
        return view('public.about');
    }

    public function medicalExamination()
    {
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

        $data['passport_no'] = strtoupper($request->passport_no);
        $data['confirm_passport_no'] = strtoupper($request->confirm_passport_no);
        $data['first_name'] = strtoupper($request->first_name);
        $data['last_name'] = strtoupper($request->last_name);

        // Convert checkbox value to boolean
        $data['confirm_info'] = $request->has('confirm_info') ? 1 : 0;

        $appointment = Appointment::create($data);

        // Generate Appointment No (e.g., APPT-2025-00001)
        $appointment->appointment_no = 'APT' . '-' . str_pad($appointment->id, 3, '0', STR_PAD_LEFT);
        $appointment->save();

        // Send Admin Notification
        $this->notificationService->notifyAdmin('Wafid', $appointment);


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

        // Fetch only active payment methods
        $paymentMethods = PaymentMethod::where('status', 1)->get();

        // DYNAMIC FEE
        $rawFee = $this->getFee('wafid_fee', 4500);
        $fee = number_format($rawFee); // Converts 4500 to "4,500"

        return view('public.appointments.appointment-confirmation', compact('appointment', 'fee', 'paymentMethods'));
    }

    public function uploadPaymentProof(Request $request)
    {
        $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'passport_no' => 'required|string|max:50',
            'mobile_no' => 'required|string|max:20',
            'payment_method' => 'required|string',
            'proof_image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'agreeTerms' => 'accepted', // Checkbox must be checked
        ], [
            'passport_no.required' => 'Enter passport number',
            'mobile_no.required' => 'Enter phone number',
            'payment_method.required' => 'Select a payment method',
            'proof_image.required' => 'Upload your payment screenshot',
            'agreeTerms.accepted' => 'You must agree to the terms and conditions',
        ]);

        // Upload image manually to public/uploads
        $image = $request->file('proof_image');
        $randomName = Str::random(40) . '.' . $image->getClientOriginalExtension();

        $image->move(public_path('uploads/medical-examination'), $randomName);

        // Save to DB
        Payment::create([
            'appointment_id' => $request->appointment_id,
            'passport_no' => $request->passport_no,
            'mobile_no' => $request->mobile_no,
            'payment_method' => $request->payment_method,
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

    public function payLater(Request $request)
    {
        $appointment_id = session('appointment_id');

        if (!$appointment_id || !$appointment = Appointment::find($appointment_id)) {
            return redirect()->route('home')->with('error', 'Unauthorized access.');
        }

        // Store appointment ID in session for Thank You page
        session(['appointment_paid_id' => $appointment_id]);

        // Forget the old session for confirmation page
        session()->forget('appointment_id');

        return redirect()->route('thank.you');
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

    public function ViewMedicalReport()
    {
        return view('public.appointments.ViewMedicalReport');
    }

    public function saveMedicalReport(Request $request)
    {
        $validated = $request->validate(
            [
                'passport_no' => 'required|string|max:255',
                'nationality' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
            ],
            [
                'passport_no.required' => 'Please enter your passport number',
                'phone.required' => 'WhatsApp number is required to send the report'
            ]
        );

        // Force Uppercase for Passport
        $validated['passport_no'] = strtoupper($request->passport_no);

        CheckResult::create($validated);

        return response()->json([
            'status' => 'success',
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

        $data['passport_no'] = strtoupper($request->passport_no);
        $data['confirm_passport_no'] = strtoupper($request->confirm_passport_no);
        $data['first_name'] = strtoupper($request->first_name);
        $data['last_name'] = strtoupper($request->last_name);

        // Convert checkbox value to boolean
        $data['confirm_info'] = $request->has('confirm_info') ? 1 : 0;

        $appointment = SpecialAppointment::create($data);

        // Generate Appointment No (e.g., SP-2025-00001)
        $appointment->appointment_no = 'SP' . '-' . str_pad($appointment->id, 3, '0', STR_PAD_LEFT);
        $appointment->save();

        // Send Admin Notification
        $this->notificationService->notifyAdmin('Special', $appointment);

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

        // NEW: Fetch active payment methods from the database
        $paymentMethods = PaymentMethod::where('status', 1)->get();

        // DYNAMIC FEE WITH CITY LOGIC
        // We fetch the values from DB first to ensure they are dynamic
        $gujranwalaFee = $this->getFee('special_gujranwala', 7000);
        $lahoreFee = $this->getFee('special_lahore', 12000);
        $defaultFee = $this->getFee('special_default', 4500);

        $rawFee = match (strtolower($appointment->city)) {
            'gujranwala' => $gujranwalaFee,
            'lahore' => $lahoreFee,
            default => $defaultFee,
        };

        $fee = number_format($rawFee); // Optional formatting if view expects "7,000"

        // Pass $paymentMethods to the view
        return view('public.specialappointments.appointment-confirmation', compact('appointment', 'fee', 'paymentMethods'));
    }

    public function uploadSpecialPaymentProof(Request $request)
    {
        $request->validate([
            'special_appointment_id' => 'required|exists:special_appointments,id',
            'passport_no' => 'required|string|max:50',
            'mobile_no' => 'required|string|max:20',
            'payment_method' => 'required|string',
            'proof_image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'agreeTerms' => 'accepted',
        ], [
            'special_appointment_id.required' => 'Invalid appointment',
            'special_appointment_id.exists' => 'Invalid appointment',
            'passport_no.required' => 'Enter passport number',
            'mobile_no.required' => 'Enter phone number',
            'payment_method.required' => 'Select a payment method',
            'proof_image.required' => 'Upload your payment screenshot',
            'agreeTerms.accepted' => 'You must agree to the terms and conditions',
        ]);

        // Upload image to public/uploads
        $image = $request->file('proof_image');
        $randomName = Str::random(40) . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('uploads/special-medical'), $randomName);

        // Save special payment
        SpecialPayment::create([
            'special_appointment_id' => $request->special_appointment_id,
            'passport_no' => $request->passport_no,
            'mobile_no' => $request->mobile_no,
            'payment_method' => $request->payment_method,
            'proof_image' => $randomName,
        ]);

        session(['special_appointment_paid_id' => $request->special_appointment_id]);

        return response()->json([
            'status' => 'success',
            'redirect' => route('special.thankyou'),
        ]);
    }

    public function payLaterSpecial(Request $request)
    {
        $id = session('special_appointment_id');
        if (!$id || !SpecialAppointment::find($id)) {
            return redirect()->route('home')->with('error', 'Unauthorized access.');
        }

        session(['special_appointment_paid_id' => $id]);
        session()->forget('special_appointment_id');

        return redirect()->route('special.thankyou');
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

    public function medicalCenters()
    {
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

    public function navtechform()
    {
        return view('public.navtechappointments.navtech-appointment-form');
    }

    public function navtechstore(Request $request)
    {
        // 1. Validation
        $validator = Validator::make($request->all(), [
            'country' => 'required|string',
            'whatsapp_number' => 'required|string',
            'occupation' => 'required|string',
            'passport_pic' => 'required|image|mimes:jpeg,png,jpg|max:5120',
            'id_card_front' => 'required|image|mimes:jpeg,png,jpg|max:5120',
            'user_pic' => 'required|image|mimes:jpeg,png,jpg|max:5120',
        ], [
            'passport_pic.max' => 'Your passport photo is too large. Please use a smaller image (max 5MB).',
            'passport_pic.required' => 'Please upload your Passport scan.',
            'id_card_front.required' => 'The ID card front image is required.',
            'user_pic.required' => 'A personal passport-size photo is required.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // REMOVED 'city' from the only() array
            $data = $request->only(['country', 'whatsapp_number', 'occupation']);
            $data['is_new'] = true;

            // 2. Process and Save Files...
            $fileFields = ['passport_pic', 'id_card_front', 'user_pic'];

            foreach ($fileFields as $field) {
                if ($request->hasFile($field)) {
                    $image = $request->file($field);
                    $randomName = Str::random(40) . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('uploads/navtech'), $randomName);
                    $data[$field] = $randomName;
                }
            }

            $appointment = NavtechAppointment::create($data);

            // Send Admin Notification
            $this->notificationService->notifyAdmin('Navtech', $appointment);

            session(['navtech_appointment_id' => $appointment->id]);

            return response()->json([
                'status' => 'success',
                'redirect' => route('navtech.confirm')
            ]);

        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Something went wrong.'], 500);
        }
    }

    public function confirmNavtechAppointment()
    {
        $id = session('navtech_appointment_id');
        if (!$id || !$appointment = NavtechAppointment::find($id)) {
            return redirect()->route('navtechform');
        }

        // NEW: Fetch active payment methods
        $paymentMethods = PaymentMethod::where('status', 1)->get();

        // DYNAMIC FEE
        $fee = $this->getFee('navtech_fee', 18000); // Returns integer 18000 

        return view('public.navtechappointments.navtech-confirmation', compact('appointment', 'fee', 'paymentMethods'));
    }

    public function uploadNavtechPaymentProof(Request $request)
    {
        $request->validate([
            'navtech_appointment_id' => 'required|exists:navtech_appointments,id',
            'whatsapp_number' => 'required',
            'payment_method' => 'required',
            'proof_image' => 'required|image|max:5120',
            'agreeTerms' => 'accepted',
        ]);

        $image = $request->file('proof_image');
        $name = Str::random(40) . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('uploads/navtech'), $name);

        NavtechPayment::create([
            'navtech_appointment_id' => $request->navtech_appointment_id,
            'whatsapp_number' => $request->whatsapp_number,
            'payment_method' => $request->payment_method,
            'proof_image' => $name,
        ]);

        session(['navtech_paid_id' => $request->navtech_appointment_id]);

        return response()->json([
            'status' => 'success',
            'redirect' => route('navtech.thankyou'),
        ]);
    }

    public function payLaterNavtech(Request $request)
    {
        $id = session('navtech_appointment_id');
        if (!$id || !NavtechAppointment::find($id)) {
            return redirect()->route('navtechform')->with('error', 'Unauthorized access.');
        }

        session(['navtech_paid_id' => $id]);
        session()->forget('navtech_appointment_id');

        return redirect()->route('navtech.thankyou');
    }

    // 4. Final Thank You
    public function navtechThankYou()
    {
        $id = session('navtech_paid_id');
        if (!$id || !$appointment = NavtechAppointment::find($id)) {
            return redirect()->route('navtechform');
        }
        session()->forget('navtech_paid_id');
        return view('public.navtechappointments.thank-you', compact('appointment'));
    }

    public function tasheerForm()
    {
        return view('public.tasheerappointments.form');
    }

    public function tasheerStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'embassy' => 'required|string',
            'etimad_center' => 'required|string', // Added validation
            'whatsapp_number' => 'required|string',
            'passport_pic' => 'required|image|mimes:jpeg,png,jpg|max:5120',
        ], [
            'passport_pic.required' => 'Please upload a clear photo of the passport front page.'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        try {
            // Updated to include etimad_center in the array
            $data = $request->only(['embassy', 'etimad_center', 'whatsapp_number']);
            $data['is_new'] = true;

            if ($request->hasFile('passport_pic')) {
                $image = $request->file('passport_pic');
                $name = Str::random(40) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads'), $name);
                $data['passport_pic'] = $name;
            }

            $appointment = TasheerAppointment::create($data);

            // Send Admin Notification
            $this->notificationService->notifyAdmin('Tasheer', $appointment);

            session(['tasheer_appointment_id' => $appointment->id]);

            return response()->json(['status' => 'success', 'redirect' => route('tasheer.confirm')]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Error saving data.'], 500);
        }
    }

    public function confirmTasheerAppointment()
    {
        $id = session('tasheer_appointment_id');
        if (!$id || !$appointment = TasheerAppointment::find($id)) {
            return redirect()->route('tasheer.form');
        }

        // NEW: Fetch active payment methods
        $paymentMethods = PaymentMethod::where('status', 1)->get();

        // DYNAMIC FEE
        $fee = $this->getFee('tasheer_fee', 500);

        // Pass $paymentMethods to the view
        return view('public.tasheerappointments.confirmation', compact('appointment', 'fee', 'paymentMethods'));
    }

    public function uploadTasheerPaymentProof(Request $request)
    {
        $request->validate([
            'tasheer_appointment_id' => 'required|exists:tasheer_appointments,id',
            'whatsapp_number' => 'required',
            'payment_method' => 'required',
            'proof_image' => 'required|image|max:5120',
            'agreeTerms' => 'accepted',
        ]);

        $image = $request->file('proof_image');
        $name = Str::random(40) . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('uploads'), $name);

        TasheerPayment::create([
            'tasheer_appointment_id' => $request->tasheer_appointment_id,
            'whatsapp_number' => $request->whatsapp_number,
            'payment_method' => $request->payment_method,
            'proof_image' => $name,
        ]);

        session(['tasheer_paid_id' => $request->tasheer_appointment_id]);
        return response()->json(['status' => 'success', 'redirect' => route('tasheer.thankyou')]);
    }

    public function payLaterTasheer(Request $request)
    {
        $id = session('tasheer_appointment_id');
        if (!$id || !TasheerAppointment::find($id)) {
            return redirect()->route('tasheer.form')->with('error', 'Unauthorized access.');
        }

        session(['tasheer_paid_id' => $id]);
        session()->forget('tasheer_appointment_id');

        return redirect()->route('tasheer.thankyou');
    }

    public function tasheerThankYou()
    {
        $id = session('tasheer_paid_id');
        if (!$id || !$appointment = TasheerAppointment::find($id))
            return redirect()->route('tasheer.form');
        session()->forget('tasheer_paid_id');
        return view('public.tasheerappointments.thank-you', compact('appointment'));
    }

    public function softSkillForm()
    {
        return view('public.skillcertificates.form');
    }

    public function softSkillStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'whatsapp_number' => 'required|string',
            'id_card_front' => 'required|image|mimes:jpeg,png,jpg|max:5120',
            'passport_pic' => 'required|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        try {
            $data = $request->only(['whatsapp_number']);

            // Only processing ID Front and Passport now
            $fields = ['id_card_front', 'passport_pic'];

            foreach ($fields as $field) {
                if ($request->hasFile($field)) {
                    $image = $request->file($field);
                    $name = Str::random(20) . '_' . $field . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('uploads/softskill'), $name);
                    $data[$field] = $name;
                }
            }

            $appointment = SoftSkillCertificate::create($data);

            // Send Admin Notification
            $this->notificationService->notifyAdmin('Soft Skill', $appointment);

            session(['softskill_id' => $appointment->id]);

            return response()->json(['status' => 'success', 'redirect' => route('softskill.confirm')]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Error saving data.'], 500);
        }
    }

    public function softSkillConfirm()
    {
        $id = session('softskill_id');
        if (!$id || !$record = SoftSkillCertificate::find($id)) {
            return redirect()->route('softskill.form');
        }

        // NEW: Fetch active payment methods from the database
        $paymentMethods = PaymentMethod::where('status', 1)->get();

        // DYNAMIC FEE
        $fee = $this->getFee('softskill_fee', 1500);

        // Pass $paymentMethods to the view
        return view('public.skillcertificates.confirmation', compact('record', 'fee', 'paymentMethods'));
    }

    public function softSkillPaymentUpload(Request $request)
    {
        $request->validate([
            'softskill_id' => 'required|exists:soft_skill_certificates,id',
            'whatsapp_number' => 'required',
            'payment_method' => 'required',
            'proof_image' => 'required|image|max:5120',
            'agreeTerms' => 'accepted',
        ]);

        $image = $request->file('proof_image');
        $name = Str::random(40) . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('uploads/payments'), $name);

        SoftSkillPayment::create([
            'softskill_id' => $request->softskill_id,
            'whatsapp_number' => $request->whatsapp_number,
            'payment_method' => $request->payment_method,
            'proof_image' => $name,
        ]);

        session(['softskill_paid_id' => $request->softskill_id]);
        return response()->json(['status' => 'success', 'redirect' => route('softskill.thankyou')]);
    }

    public function payLaterSoftSkill(Request $request)
    {
        $id = session('softskill_id');
        if (!$id || !SoftSkillCertificate::find($id)) {
            return redirect()->route('softskill.form')->with('error', 'Unauthorized access.');
        }

        session(['softskill_paid_id' => $id]);
        session()->forget('softskill_id');

        return redirect()->route('softskill.thankyou');
    }

    public function softSkillThankYou()
    {
        $id = session('softskill_paid_id');
        if (!$id || !$record = SoftSkillCertificate::find($id))
            return redirect()->route('softskill.form');
        session()->forget('softskill_paid_id');
        return view('public.skillcertificates.thank-you', compact('record'));
    }

    // ==========================
    // Blog Methods
    // ==========================

    public function blogs(Request $request)
    {
        $query = Blog::with('category')->where('status', 'published');

        // Search Filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%$search%")
                    ->orWhere('short_description', 'like', "%$search%")
                    ->orWhere('content', 'like', "%$search%");
            });
        }

        // Category Filter
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $blogs = $query->orderBy('published_at', 'desc')->paginate(9);

        $categories = BlogCategory::withCount([
            'blogs' => function ($q) {
                $q->where('status', 'published');
            }
        ])->get();

        return view('public.blogs.index', compact('blogs', 'categories'));
    }

    public function blogDetails($slug)
    {
        $blog = Blog::with('category')
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        $recentBlogs = Blog::where('status', 'published')
            ->where('id', '!=', $blog->id)
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        return view('public.blogs.details', compact('blog', 'recentBlogs'));
    }

    public function medicalCentersByCity($city)
    {
        // Replace dashes with spaces and title case for DB search
        $cityName = ucwords(str_replace('-', ' ', $city));

        $centers = MedicalCenter::where('city', 'like', $cityName)
            ->orderBy('medical_center', 'asc')
            ->get();

        if ($centers->isEmpty()) {
            abort(404);
        }

        // Fetch optional city-specific media (Hero image and description)
        $cityMedia = \App\Models\CityMedia::where('city_name', $cityName)->first();

        return view('public.medical_centers_city', compact('centers', 'cityName', 'cityMedia'));
    }

}
