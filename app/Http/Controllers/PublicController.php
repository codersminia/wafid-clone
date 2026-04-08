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
    public function privacyPolicy()
    {
        return view('public.privacy-policy');
    }

    public function termsConditions()
    {
        return view('public.terms-conditions');
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

        $banners = \App\Models\Banner::where('is_active', 1)
            ->orderBy('sort_order')
            ->orderBy('id', 'desc')
            ->get();

        $latestBlogs = \App\Models\Blog::with('category')
            ->where('status', 1)
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        $homeFaqs = \App\Models\Faq::where('status', 1)->take(8)->get();

        return view('public.home', compact('testimonials', 'banners', 'latestBlogs', 'homeFaqs'));
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

        // 2. Send Email
        $this->notificationService->notifyContactInquiry($data);

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
        $this->notificationService->notifyAppointment('Wafid', $appointment);


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
        $this->notificationService->notifyAppointment('Special', $appointment);

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
            $this->notificationService->notifyAppointment('Navtech', $appointment);

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
            $this->notificationService->notifyAppointment('Tasheer', $appointment);

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
            $this->notificationService->notifyAppointment('Soft Skill', $appointment);

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

    public function gccCountryPage($country)
    {
        $countries = [
            'saudi-arabia' => [
                'name'        => 'Saudi Arabia',
                'slug'        => 'saudi-arabia',
                'flag'        => '🇸🇦',
                'hero_image'  => 'https://images.unsplash.com/photo-1586724237569-f3d0c1dee8c6?auto=format&fit=crop&w=1400&q=80',
                'cities'      => ['Riyadh', 'Jeddah', 'Dammam', 'Mecca', 'Medina'],
                'db_name'     => 'Saudi Arabia',
                'title'       => 'Saudi GAMCA Medical Pakistan | WAFID Appointment 2026',
                'meta_desc'   => 'Book Saudi GAMCA medical from Pakistan. Fast WhatsApp slip delivery, 99% success rate. WAFID appointment fee PKR 4,500. Book now.',
                'intro'       => 'Pakistani workers planning to work in Saudi Arabia must complete the GAMCA (Wafid) medical test before visa stamping. This medical examination is a mandatory requirement for all Saudi work visas, including labor, skilled, and domestic worker categories. Without a valid medical fitness certificate, your Saudi visa cannot be processed.',
                'visa_types'  => ['Labor Visa', 'Skilled Worker Visa', 'Domestic Worker Visa', 'Iqama Renewal', 'Family Visa'],
                'jobs'        => ['Construction Worker', 'Driver', 'Electrician', 'Plumber', 'Domestic Helper', 'Security Guard', 'Nurse', 'Engineer'],
                'faqs'        => [
                    ['q' => 'How long does GAMCA medical take in Pakistan?', 'a' => 'The full medical process takes 2–3 hours at the center, and results are uploaded to the Saudi MOH system within 24–48 hours.'],
                    ['q' => 'Is GAMCA medical mandatory for Saudi Arabia?', 'a' => 'Yes, it is 100% mandatory for all Saudi work visa applicants from Pakistan, including labor, skilled, and domestic worker categories.'],
                    ['q' => 'Can I choose my GAMCA medical center?', 'a' => 'In standard booking, the system assigns a center automatically. However, our Wafid Choice service allows you to manually select your preferred center.'],
                    ['q' => 'What happens if I fail the GAMCA medical?', 'a' => 'If declared unfit, you may need treatment and can reapply after recovery. Some infectious diseases may result in permanent disqualification from the Saudi visa process.'],
                    ['q' => 'How do I get my GAMCA slip in Pakistan?', 'a' => 'Book online through our form and receive your official GAMCA appointment slip via WhatsApp as a PDF, ready to print and use at the medical center.'],
                    ['q' => 'Which cities in Pakistan have GAMCA centers for Saudi Arabia?', 'a' => 'GAMCA-approved centers are available in Karachi, Lahore, Islamabad, Rawalpindi, Faisalabad, Multan, Peshawar, and many other cities across Pakistan.'],
                ],
                'color'       => '#006C35',
                // Saudi-specific rich content
                'page_heading'   => 'Saudi GAMCA Medical in Pakistan – Complete Guide for 2026',
                'process_steps'  => [
                    ['title' => 'Job Offer & Visa Approval',   'desc' => 'Receive your employment offer and visa approval from your Saudi employer or sponsor.'],
                    ['title' => 'Book GAMCA Appointment',      'desc' => 'Book your GAMCA medical appointment online. You will be assigned an approved medical center automatically.'],
                    ['title' => 'Visit Medical Center',        'desc' => 'Go to the assigned GAMCA-approved medical center in your city and complete all required tests.'],
                    ['title' => 'Medical Testing',             'desc' => 'Complete tests including blood screening, chest X-ray, and full physical examination.'],
                    ['title' => 'Result Submission',           'desc' => 'Your results are uploaded to the Saudi Ministry of Health (MOH) system within 24–48 hours.'],
                    ['title' => 'Visa Processing',             'desc' => 'Once declared medically fit, your employer proceeds with visa stamping.'],
                ],
                'documents'      => [
                    'Original Pakistani passport (minimum 6 months validity)',
                    'Saudi visa approval or job offer letter',
                    '4 passport-size photos (white background)',
                    'GAMCA appointment slip (Wafid slip)',
                    'Medical fee in Pakistani Rupees',
                ],
                'tests'          => [
                    'Blood Tests'              => ['HIV screening', 'Hepatitis B & C', 'Blood sugar level', 'Complete blood count (CBC)'],
                    'Physical & Diagnostic'    => ['Chest X-ray (Tuberculosis check)', 'Blood pressure measurement', 'Vision test', 'Full doctor examination'],
                ],
                'center_cities'  => ['Karachi', 'Lahore', 'Islamabad', 'Rawalpindi', 'Faisalabad', 'Multan', 'Peshawar'],
                'fees'           => [
                    ['label' => 'Medical Test Fee',          'amount' => 'PKR 25,000'],
                    ['label' => 'Wafid Appointment Slip Fee','amount' => 'PKR 4,500'],
                    ['label' => 'Total Cost',                'amount' => 'PKR 29,500', 'highlight' => true],
                ],
                'fee_note'       => 'Fees may slightly vary depending on exchange rates and system updates.',
                'common_mistakes'=> [
                    'Selecting the wrong city or medical center',
                    'Passport details mismatch with appointment slip',
                    'Not bringing original documents on the day',
                    'Ignoring medical preparation instructions',
                    'Missing appointment date or arriving late',
                ],
                'why_us'         => [
                    'Fast GAMCA appointment booking in Pakistan',
                    'WhatsApp delivery of appointment slip as PDF',
                    '99% success rate across all Saudi visa categories',
                    'Support for labor, skilled, and domestic worker visas',
                    'Trusted Wafid-compliant process',
                ],
            ],
            'uae' => [
                'name'        => 'UAE',
                'slug'        => 'uae',
                'flag'        => '🇦🇪',
                'hero_image'  => 'https://images.unsplash.com/photo-1512453979798-5ea266f8880c?auto=format&fit=crop&w=1400&q=80',
                'cities'      => ['Dubai', 'Abu Dhabi', 'Sharjah', 'Ajman', 'Ras Al Khaimah'],
                'db_name'     => 'UAE',
                'title'       => 'UAE Medical Pakistan | Dubai Visa Medical Test 2026',
                'meta_desc'   => 'Book UAE visa medical from Pakistan. Fast WhatsApp confirmation, correct emirate matching. Dubai, Abu Dhabi & Sharjah. Book now.',
                'intro'       => 'Pakistani workers traveling to the United Arab Emirates must complete a visa medical examination before residency or employment approval. Unlike other GCC countries, the UAE does not follow the GAMCA/WAFID system, but still requires authorized medical testing through approved clinics. The UAE medical test is mandatory for all employment visas, including workers going to Dubai, Abu Dhabi, and Sharjah.',
                'visa_types'  => ['Employment Visa', 'Residence Visa', 'Domestic Worker Visa', 'Skilled Worker Visa'],
                'jobs'        => ['Engineer', 'IT Professional', 'Driver', 'Electrician', 'Accountant', 'Sales Executive', 'Nurse', 'Technician'],
                'faqs'        => [
                    ['q' => 'Is GAMCA required for UAE?', 'a' => 'No, the UAE follows a separate medical system and does not require GAMCA/WAFID tokens. However, an authorized medical test through approved UAE clinics is still mandatory for all employment and residency visas.'],
                    ['q' => 'How long does UAE medical take?', 'a' => 'The process usually takes 1–2 hours at the clinic, and results are available within 24–48 hours after submission to UAE immigration systems.'],
                    ['q' => 'Can I choose my UAE medical center?', 'a' => 'Yes, you can select your clinic based on your visa emirate (Dubai, Abu Dhabi, or Sharjah). We help you match the correct clinic to your visa type.'],
                    ['q' => 'Do UAE medical tests require fasting?', 'a' => 'Some tests may require fasting depending on clinic policy. Always follow the instructions provided at the time of booking.'],
                    ['q' => 'What happens if I fail UAE medical?', 'a' => 'You may need treatment or re-testing. Some conditions may affect visa eligibility. Contact us immediately for guidance on next steps.'],
                    ['q' => 'What documents are needed for UAE medical?', 'a' => 'You need your original passport, UAE visa or job offer letter, Emirates ID (if available), passport-size photos, and active mobile number.'],
                ],
                'color'       => '#00732F',
                'page_heading'   => 'UAE Medical for Pakistan Workers – Complete Guide 2026',
                'process_steps'  => [
                    ['title' => 'Receive Job Offer',        'desc' => 'Get your UAE job offer or visa approval from your employer or sponsor.'],
                    ['title' => 'Book Medical Appointment', 'desc' => 'Schedule your UAE medical test based on your visa type and emirate (Dubai, Abu Dhabi, or Sharjah).'],
                    ['title' => 'Visit Approved Clinic',    'desc' => 'Go to the assigned authorized UAE medical center for your examination.'],
                    ['title' => 'Complete Medical Tests',   'desc' => 'Undergo required tests including blood screening and chest X-ray.'],
                    ['title' => 'Result Processing',        'desc' => 'Medical results are processed and submitted to UAE immigration systems within 24–48 hours.'],
                    ['title' => 'Visa Completion',          'desc' => 'Once declared medically fit, your visa stamping or residency process continues.'],
                ],
                'documents'      => [
                    'Original passport (minimum 6 months validity)',
                    'UAE visa or job offer letter',
                    'Emirates ID (if available)',
                    'Passport-size photos (white background)',
                    'Active mobile number',
                    'Vaccination record (if required)',
                    'Previous medical reports (if applicable)',
                ],
                'tests'          => [
                    'Laboratory Tests'       => ['HIV screening', 'Hepatitis B & C', 'Blood sugar level'],
                    'Physical & Diagnostic'  => ['Chest X-ray (Tuberculosis screening)', 'Blood pressure check', 'Doctor physical examination'],
                ],
                'center_cities'  => ['Dubai', 'Abu Dhabi', 'Sharjah'],
                'center_note'    => 'Make sure your clinic matches your visa processing emirate.',
                'fees'           => [
                    ['label' => 'Appointment / Processing Fee', 'amount' => 'PKR 4,500'],
                    ['label' => 'UAE Medical Test Fee',         'amount' => 'AED 300 – 800 (approx.)'],
                    ['label' => 'Total Cost',                   'amount' => 'Depends on clinic & visa type', 'highlight' => true],
                ],
                'fee_note'       => 'Fees may vary depending on emirate and urgency.',
                'common_mistakes'=> [
                    'Selecting the wrong emirate (Dubai vs Abu Dhabi)',
                    'Missing appointment timing',
                    'Not carrying Emirates ID (if required)',
                    'Incorrect passport details on the booking form',
                    'Ignoring clinic instructions before the test',
                ],
                'why_us'         => [
                    'Fast UAE medical appointment booking',
                    'Correct emirate selection (Dubai / Abu Dhabi / Sharjah)',
                    'WhatsApp confirmation & reminders',
                    'Same-day / next-day slots available',
                    '99% success rate',
                    '24/7 WhatsApp support',
                ],
                'urgent_booking' => true,
            ],
            'qatar' => [
                'name'        => 'Qatar',
                'slug'        => 'qatar',
                'flag'        => '🇶🇦',
                'hero_image'  => 'https://images.unsplash.com/photo-1553697388-94e804e2f0f6?auto=format&fit=crop&w=1400&q=80',
                'cities'      => ['Doha', 'Al Khor', 'Al Wakrah', 'Lusail'],
                'db_name'     => 'Qatar',
                'title'       => 'Qatar WAFID Medical Token Pakistan | GAMCA Booking 2026',
                'meta_desc'   => 'Book Qatar WAFID medical token from Pakistan. Fast WhatsApp QR slip, correct sponsor city. Book now — same-day slots available.',
                'intro'       => 'Pakistani workers traveling to Qatar must obtain a WAFID (GAMCA) medical token before attending their medical examination. This token is a mandatory requirement for all Qatar work visas and ensures your medical results are correctly linked to Qatari immigration systems. Without a valid token, clinics will not process your medical test.',
                'visa_types'  => ['Employment Visa', 'Residence Permit', 'Skilled Worker Visa', 'Construction Visa'],
                'jobs'        => ['Construction Worker', 'Engineer', 'Driver', 'Electrician', 'Plumber', 'Hospitality Staff', 'Security Guard', 'Technician'],
                'faqs'        => [
                    ['q' => 'Is WAFID medical mandatory for Qatar?', 'a' => 'Yes, all workers applying for a Qatar employment visa must complete a WAFID (GAMCA) medical test. Without a valid token, clinics will not process your examination.'],
                    ['q' => 'How long does Qatar WAFID medical take?', 'a' => 'The process takes 2–3 hours at the clinic, and results are usually available within 24–48 hours after submission.'],
                    ['q' => 'Can I choose my Qatar medical center?', 'a' => 'Normally, the system assigns a center based on your sponsor city (Doha or Al Khor). Some flexibility may be available with our premium booking option.'],
                    ['q' => 'What happens if my WAFID token expires?', 'a' => 'Expired tokens cannot be reused. You must rebook a new Qatar GAMCA token. Contact us immediately to avoid delays in your visa process.'],
                    ['q' => 'Do Qatar medical tests require fasting?', 'a' => 'Some clinics may require fasting for blood tests. Always follow the instructions provided in your appointment slip to avoid test rejection.'],
                    ['q' => 'How do I receive my Qatar WAFID QR slip?', 'a' => 'After booking, your WAFID token QR slip is delivered as a PDF directly to your WhatsApp — ready to print and present at the clinic.'],
                ],
                'color'       => '#8D1B3D',
                // Qatar-specific rich content
                'page_heading'   => 'Qatar WAFID Medical Token Guide – Complete Process for 2026',
                'process_steps'  => [
                    ['title' => 'Receive Job Offer',       'desc' => 'Get your Qatar job offer or visa approval from your employer or sponsor.'],
                    ['title' => 'Book WAFID Token',        'desc' => 'Apply for your Qatar WAFID medical token online. Ensure all passport details are correct before submission.'],
                    ['title' => 'Get Appointment Slip',    'desc' => 'Receive your GAMCA slip (QR code) with clinic details and appointment schedule via WhatsApp.'],
                    ['title' => 'Visit Medical Center',    'desc' => 'Attend the assigned WAFID-approved clinic in Doha or Al Khor (or assigned GCC center if applicable).'],
                    ['title' => 'Complete Medical Tests',  'desc' => 'Undergo full medical screening including blood tests, chest X-ray, and physical examination.'],
                    ['title' => 'Results Submission',      'desc' => 'Your results are uploaded to the Qatar medical system and shared with your employer for visa processing.'],
                ],
                'documents'      => [
                    'Original passport (minimum 6 months validity)',
                    'Qatar visa or job offer letter',
                    'Printed WAFID token (QR slip)',
                    'Passport-size photos (white background)',
                    'Active mobile number for OTP verification',
                    'Previous medical reports (if applicable)',
                ],
                'tests'          => [
                    'Laboratory Tests'          => ['HIV screening', 'Hepatitis B & C', 'Blood sugar level', 'Complete blood count'],
                    'Physical & Diagnostic'     => ['Chest X-ray (TB screening)', 'Blood pressure check', 'Vision test', 'Doctor physical examination'],
                ],
                'center_cities'  => ['Doha', 'Al Khor'],
                'center_note'    => 'Your sponsor city must match your assigned clinic to avoid rejection.',
                'fees'           => [
                    ['label' => 'WAFID Token Fee',          'amount' => 'PKR 4,500'],
                    ['label' => 'Medical Test Fee',         'amount' => 'Varies by clinic'],
                    ['label' => 'Total Estimated Cost',     'amount' => 'PKR 25,000 – 30,000', 'highlight' => true],
                ],
                'fee_note'       => 'Fees may vary depending on exchange rate and clinic updates.',
                'common_mistakes'=> [
                    'Entering incorrect passport details',
                    'Selecting wrong sponsor city (Doha vs Al Khor)',
                    'Missing appointment timing',
                    'Not bringing printed QR slip to the clinic',
                    'Ignoring clinic instructions (fasting, hydration)',
                ],
                'why_us'         => [
                    'Fast Qatar WAFID token booking (same-day slots available)',
                    'WhatsApp delivery of GAMCA slip with QR code',
                    'Accurate sponsor city & clinic matching',
                    'Support for Pakistan, India, Bangladesh applicants',
                    '24/7 WhatsApp assistance',
                    'Error-free processing — no rejection risk',
                ],
                'urgent_booking' => true,
            ],
            'oman' => [
                'name'        => 'Oman',
                'slug'        => 'oman',
                'flag'        => '🇴🇲',
                'hero_image'  => 'https://images.unsplash.com/photo-1578895101408-1a36b834405b?auto=format&fit=crop&w=1400&q=80',
                'cities'      => ['Muscat', 'Sohar', 'Salalah', 'Nizwa'],
                'db_name'     => 'Oman',
                'title'       => 'Oman WAFID Medical Pakistan | GAMCA Token Booking 2026',
                'meta_desc'   => 'Book Oman WAFID medical token from Pakistan. Fast WhatsApp QR slip, Muscat/Sohar/Salalah matching. 99% success. Book now.',
                'intro'       => 'Pakistani workers planning to work in Oman must obtain a WAFID (GAMCA) medical token before completing their medical examination. This token is a mandatory requirement for all Oman employment visas and ensures your medical results are officially accepted by Omani authorities. Without a valid token, you cannot proceed with your GAMCA medical test.',
                'visa_types'  => ['Employment Visa', 'Residence Visa', 'Skilled Worker Visa', 'Domestic Worker Visa'],
                'jobs'        => ['Construction Worker', 'Driver', 'Electrician', 'Plumber', 'Oil & Gas Worker', 'Security Guard', 'Domestic Helper', 'Technician'],
                'faqs'        => [
                    ['q' => 'Is WAFID medical mandatory for Oman?', 'a' => 'Yes, all Oman employment visa applicants must complete a WAFID (GAMCA) medical test. Without a valid token, you cannot proceed with your medical examination.'],
                    ['q' => 'How long does Oman WAFID medical take?', 'a' => 'The process takes 2–3 hours at the clinic, and results are available within 24–48 hours after submission.'],
                    ['q' => 'Can I choose my Oman medical center?', 'a' => 'Normally, the system assigns a center based on your sponsor city (Muscat, Sohar, or Salalah). Contact us for premium center selection options.'],
                    ['q' => 'What happens if my Oman WAFID token expires?', 'a' => 'Expired tokens cannot be reused. You must rebook a new Oman WAFID token. Contact us immediately to avoid delays in your visa process.'],
                    ['q' => 'Do Oman medical tests require fasting?', 'a' => 'Some clinics may require fasting for blood tests. Always follow the instructions provided in your appointment slip to avoid test rejection.'],
                    ['q' => 'How do I receive my Oman WAFID QR slip?', 'a' => 'After booking, your WAFID token QR slip is delivered as a PDF directly to your WhatsApp — ready to print and present at the assigned clinic.'],
                ],
                'color'       => '#DB161B',
                'page_heading'   => 'Oman WAFID Medical Token Pakistan – Complete Guide 2026',
                'process_steps'  => [
                    ['title' => 'Get Job Offer',            'desc' => 'Receive your Oman job offer or visa approval from your employer or sponsor.'],
                    ['title' => 'Book WAFID Token',         'desc' => 'Apply for your Oman WAFID token online with correct passport details and sponsor city.'],
                    ['title' => 'Receive Appointment Slip', 'desc' => 'Get your GAMCA QR slip with clinic details and appointment timing via WhatsApp.'],
                    ['title' => 'Visit Medical Center',     'desc' => 'Attend the assigned WAFID-approved clinic in Muscat, Sohar, or Salalah.'],
                    ['title' => 'Complete Medical Tests',   'desc' => 'Undergo required tests including blood screening, chest X-ray, and physical examination.'],
                    ['title' => 'Result Submission',        'desc' => 'Your results are uploaded to the Oman medical system and shared with your employer for visa processing.'],
                ],
                'documents'      => [
                    'Original passport (minimum 6 months validity)',
                    'Oman visa or job offer letter',
                    'Printed WAFID token (QR slip)',
                    'Passport-size photos (white background)',
                    'Active mobile number for OTP verification',
                    'Previous medical reports (if applicable)',
                ],
                'tests'          => [
                    'Laboratory Tests'       => ['HIV screening', 'Hepatitis B & C', 'Blood sugar level', 'Complete blood count'],
                    'Physical & Diagnostic'  => ['Chest X-ray (TB screening)', 'Blood pressure check', 'Vision test', 'Doctor physical examination'],
                ],
                'center_cities'  => ['Muscat', 'Sohar', 'Salalah'],
                'center_note'    => 'Your sponsor city must match your assigned clinic to avoid rejection.',
                'fees'           => [
                    ['label' => 'WAFID Token Fee',        'amount' => 'PKR 4,500'],
                    ['label' => 'Medical Test Fee',       'amount' => 'PKR 25,000 (approx.)'],
                    ['label' => 'Total Estimated Cost',   'amount' => 'PKR 29,000 – 30,000', 'highlight' => true],
                ],
                'fee_note'       => 'Fees may vary depending on clinic and exchange rates.',
                'common_mistakes'=> [
                    'Incorrect passport information on the booking form',
                    'Wrong sponsor city selection (Muscat / Sohar / Salalah)',
                    'Missing QR slip print on appointment day',
                    'Late arrival at the assigned clinic',
                    'Ignoring fasting or hydration instructions',
                ],
                'why_us'         => [
                    'Instant GAMCA token booking for Oman',
                    'Correct city matching (Muscat / Sohar / Salalah)',
                    'WhatsApp PDF delivery — ready to print',
                    'Same-day slot availability',
                    '99% success rate',
                    '24/7 WhatsApp support',
                ],
                'urgent_booking' => true,
            ],
            'kuwait' => [
                'name'        => 'Kuwait',
                'slug'        => 'kuwait',
                'flag'        => '🇰🇼',
                'hero_image'  => 'https://images.unsplash.com/photo-1559329007-40df8a9345d8?auto=format&fit=crop&w=1400&q=80',
                'cities'      => ['Kuwait City', 'Hawalli', 'Farwaniya', 'Fahaheel'],
                'db_name'     => 'Kuwait',
                'title'       => 'Kuwait WAFID Medical Pakistan | GAMCA Token Booking 2026',
                'meta_desc'   => 'Book Kuwait WAFID medical token from Pakistan. Fast WhatsApp QR slip, correct clinic matching. Same-day slots. Book now.',
                'intro'       => 'Pakistani workers planning to work in Kuwait must obtain a WAFID (GAMCA) medical token before completing their medical examination. This token is a mandatory requirement for all Kuwait employment visas and ensures your medical results are officially accepted by Kuwaiti authorities. Without a valid token, you cannot proceed with your GAMCA medical test.',
                'visa_types'  => ['Employment Visa', 'Residence Visa', 'Domestic Worker Visa', 'Skilled Worker Visa'],
                'jobs'        => ['Construction Worker', 'Driver', 'Electrician', 'Domestic Helper', 'Security Guard', 'Plumber', 'Technician', 'Nurse'],
                'faqs'        => [
                    ['q' => 'Is WAFID medical mandatory for Kuwait?', 'a' => 'Yes, all Kuwait employment visa applicants must complete a WAFID (GAMCA) medical test. Without a valid token, you cannot proceed with your medical examination.'],
                    ['q' => 'How long does Kuwait WAFID medical take?', 'a' => 'The process takes 2–3 hours at the clinic, and results are available within 24–48 hours after submission to Kuwait\'s medical system.'],
                    ['q' => 'Can I choose my Kuwait medical center?', 'a' => 'Normally, the system assigns a center based on your sponsor city. Contact us for available options in Kuwait City, Farwaniya, or Fahaheel.'],
                    ['q' => 'What happens if my Kuwait WAFID token expires?', 'a' => 'Expired tokens cannot be reused. You must rebook a new Kuwait WAFID token. Contact us immediately to avoid delays in your visa process.'],
                    ['q' => 'Do Kuwait medical tests require fasting?', 'a' => 'Some clinics may require fasting depending on testing requirements. Always follow the instructions provided in your appointment slip.'],
                    ['q' => 'How do I receive my Kuwait WAFID QR slip?', 'a' => 'After booking, your WAFID token QR slip is delivered as a PDF directly to your WhatsApp — ready to print and present at the assigned clinic.'],
                ],
                'color'       => '#007A3D',
                'page_heading'   => 'Kuwait WAFID Medical Token Pakistan – Complete Guide 2026',
                'process_steps'  => [
                    ['title' => 'Receive Job Offer',        'desc' => 'Get your Kuwait job offer or visa approval from your employer or sponsor.'],
                    ['title' => 'Book WAFID Token',         'desc' => 'Apply for your Kuwait WAFID token online with correct passport details and sponsor city.'],
                    ['title' => 'Get Appointment Slip',     'desc' => 'Receive your GAMCA QR slip with clinic details and appointment timing via WhatsApp.'],
                    ['title' => 'Visit Medical Center',     'desc' => 'Attend the assigned WAFID-approved medical center based on your sponsor city.'],
                    ['title' => 'Complete Medical Tests',   'desc' => 'Undergo full medical screening including blood tests, chest X-ray, and physical examination.'],
                    ['title' => 'Results Submission',       'desc' => 'Your results are uploaded to Kuwait\'s medical system and shared with your employer for visa processing.'],
                ],
                'documents'      => [
                    'Original passport (minimum 6 months validity)',
                    'Kuwait visa or job offer letter',
                    'Printed WAFID token (QR slip)',
                    'Passport-size photos (white background)',
                    'Active mobile number for OTP verification',
                    'Previous medical reports (if applicable)',
                ],
                'tests'          => [
                    'Laboratory Tests'       => ['HIV screening', 'Hepatitis B & C', 'Blood sugar level', 'Complete blood count'],
                    'Physical & Diagnostic'  => ['Chest X-ray (TB screening)', 'Blood pressure check', 'Vision test', 'Doctor physical examination'],
                ],
                'center_cities'  => ['Kuwait City (Hawally)', 'Farwaniya', 'Fahaheel'],
                'center_note'    => 'Ensure your token matches your assigned clinic to avoid rejection.',
                'fees'           => [
                    ['label' => 'WAFID Token Fee',        'amount' => 'PKR 4,500'],
                    ['label' => 'Medical Test Fee',       'amount' => 'PKR 25,000 (approx.)'],
                    ['label' => 'Total Estimated Cost',   'amount' => 'PKR 29,000 – 30,000', 'highlight' => true],
                ],
                'fee_note'       => 'Fees may vary depending on clinic demand and exchange rates.',
                'common_mistakes'=> [
                    'Incorrect passport details on the booking form',
                    'Wrong sponsor city selection',
                    'Missing QR slip print on appointment day',
                    'Late arrival at the assigned clinic',
                    'Ignoring fasting or hydration instructions',
                ],
                'why_us'         => [
                    'Instant GAMCA token booking for Kuwait',
                    'Correct clinic & sponsor city matching',
                    'WhatsApp PDF delivery — ready to print',
                    'Same-day / next-day slots available',
                    '99% success rate',
                    '24/7 WhatsApp support',
                ],
                'urgent_booking' => true,
            ],
            'bahrain' => [
                'name'        => 'Bahrain',
                'slug'        => 'bahrain',
                'flag'        => '🇧🇭',
                'hero_image'  => 'https://images.unsplash.com/photo-1580674684081-7617fbf3d745?auto=format&fit=crop&w=1400&q=80',
                'cities'      => ['Manama', 'Riffa', 'Muharraq', 'Hamad Town'],
                'db_name'     => 'Bahrain',
                'title'       => 'Bahrain WAFID Medical Pakistan | GAMCA Token Booking 2026',
                'meta_desc'   => 'Book Bahrain WAFID medical token from Pakistan. Fast WhatsApp QR slip, Manama/Riffa clinic matching. 99% success. Book now.',
                'intro'       => 'Pakistani workers planning to work in Bahrain must obtain a WAFID (GAMCA) medical token before completing their visa medical examination. This token is a mandatory requirement for all Bahrain employment visas and ensures your medical results are officially accepted by Bahraini authorities. Without a valid token, you will not be allowed to proceed with your GAMCA medical test.',
                'visa_types'  => ['Employment Visa', 'Residence Visa', 'Skilled Worker Visa', 'Domestic Worker Visa'],
                'jobs'        => ['Finance Professional', 'Construction Worker', 'Driver', 'Hospitality Staff', 'Electrician', 'Nurse', 'Security Guard', 'Technician'],
                'faqs'        => [
                    ['q' => 'Is WAFID medical mandatory for Bahrain?', 'a' => 'Yes, all Bahrain employment visa applicants must complete a WAFID (GAMCA) medical test. Without a valid token, you cannot proceed with your medical examination.'],
                    ['q' => 'How long does Bahrain WAFID medical take?', 'a' => 'The process takes 2–3 hours at the clinic, and results are available within 24–48 hours after submission to Bahrain\'s medical system.'],
                    ['q' => 'Can I choose my Bahrain medical center?', 'a' => 'Normally, the system assigns a center based on your sponsor city (Manama or Riffa). Contact us for available options.'],
                    ['q' => 'What happens if my Bahrain WAFID token expires?', 'a' => 'Expired tokens cannot be reused. You must rebook a new Bahrain WAFID token. Contact us immediately to avoid delays in your visa process.'],
                    ['q' => 'Do Bahrain medical tests require fasting?', 'a' => 'Some clinics may require fasting depending on test requirements. Always follow the instructions provided in your appointment slip.'],
                    ['q' => 'How do I receive my Bahrain WAFID QR slip?', 'a' => 'After booking, your WAFID token QR slip is delivered as a PDF directly to your WhatsApp — ready to print and present at the assigned clinic.'],
                ],
                'color'       => '#CE1126',
                'page_heading'   => 'Bahrain WAFID Medical Token Pakistan – Complete Guide 2026',
                'process_steps'  => [
                    ['title' => 'Receive Job Offer',        'desc' => 'Get your Bahrain job offer or visa approval from your employer or sponsor.'],
                    ['title' => 'Book WAFID Token',         'desc' => 'Apply for your Bahrain WAFID token online with correct passport details and sponsor city.'],
                    ['title' => 'Receive Appointment Slip', 'desc' => 'Get your GAMCA QR slip with clinic details and appointment timing via WhatsApp.'],
                    ['title' => 'Visit Medical Center',     'desc' => 'Attend the assigned WAFID-approved medical center in your sponsor city.'],
                    ['title' => 'Complete Medical Tests',   'desc' => 'Undergo full medical screening including blood tests, chest X-ray, and physical examination.'],
                    ['title' => 'Result Submission',        'desc' => 'Your results are uploaded to Bahrain\'s medical system and shared with your employer for visa processing.'],
                ],
                'documents'      => [
                    'Original passport (minimum 6 months validity)',
                    'Bahrain visa or job offer letter',
                    'Printed WAFID token (QR slip)',
                    'Passport-size photos (white background)',
                    'Active mobile number for OTP verification',
                    'Vaccination card or previous medical reports (if applicable)',
                ],
                'tests'          => [
                    'Laboratory Tests'       => ['HIV screening', 'Hepatitis B & C', 'Blood sugar level', 'Complete blood count'],
                    'Physical & Diagnostic'  => ['Chest X-ray (TB screening)', 'Blood pressure check', 'Vision test', 'Doctor physical examination'],
                ],
                'center_cities'  => ['Manama', 'Riffa'],
                'center_note'    => 'Ensure your token matches your assigned clinic to avoid rejection.',
                'fees'           => [
                    ['label' => 'WAFID Token Fee',        'amount' => 'PKR 4,500'],
                    ['label' => 'Medical Test Fee',       'amount' => 'PKR 25,000 (approx.)'],
                    ['label' => 'Total Estimated Cost',   'amount' => 'PKR 29,000 – 30,000', 'highlight' => true],
                ],
                'fee_note'       => 'Fees may vary depending on clinic and demand.',
                'common_mistakes'=> [
                    'Incorrect passport details on the booking form',
                    'Wrong sponsor city selection',
                    'Missing QR slip print on appointment day',
                    'Late arrival at the assigned clinic',
                    'Not following clinic instructions before the test',
                ],
                'why_us'         => [
                    'Instant GAMCA token booking for Bahrain',
                    'Correct sponsor city & clinic matching',
                    'WhatsApp PDF delivery — ready to print',
                    'Same-day / next-day slots available',
                    '99% success rate',
                    '24/7 WhatsApp support',
                ],
                'urgent_booking' => true,
            ],
        ];

        if (!isset($countries[$country])) {
            abort(404);
        }

        $data = $countries[$country];

        // Fetch medical centers for this country from DB
        $centers = MedicalCenter::where('country', 'like', $data['db_name'])
            ->orderBy('city')
            ->orderBy('medical_center')
            ->get();

        // Related blogs
        $relatedBlogs = Blog::where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        // All countries for "other countries" section
        $otherCountries = array_filter($countries, fn($k) => $k !== $country, ARRAY_FILTER_USE_KEY);

        return view('public.gcc-country', compact('data', 'centers', 'relatedBlogs', 'otherCountries'));
    }

}
