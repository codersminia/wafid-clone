<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Appointment;
use App\Models\Payment;
use App\Models\CheckResult;
use App\Models\SpecialAppointment;
use App\Models\SpecialPayment;
use App\Models\NavtechAppointment;
use App\Models\TasheerAppointment;
use App\Models\SoftSkillCertificate;
use App\Models\SoftSkillPayment;
use App\Models\PaymentMethod;
use App\Models\AppointmentFee;
use App\Models\Faq;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Models\ContactInquiry;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\MedicalCenter;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)
            ->where('is_admin', true)
            ->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user, $request->filled('remember'));
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'credential' => 'The provided credentials are incorrect.',
        ])->withInput($request->only('email'));
    }

    public function index()
    {
        // 1. Fetch Counts for the Cards
        $stats = [
            'wafid' => [
                'total' => Appointment::count(),
                'new' => Appointment::where('is_new', 1)->count()
            ],
            'special' => [
                'total' => SpecialAppointment::count(),
                'new' => SpecialAppointment::where('is_new', 1)->count()
            ],
            'tasheer' => [
                'total' => TasheerAppointment::count(),
                'new' => TasheerAppointment::where('is_new', 1)->count()
            ],
            'navtech' => [
                'total' => NavtechAppointment::count(),
                'new' => NavtechAppointment::where('is_new', 1)->count()
            ],
            'medical' => [
                'total' => CheckResult::count(),
                'new' => CheckResult::where('is_new', 1)->count()
            ],
            'softskill' => [
                'total' => SoftSkillCertificate::count(),
                'new' => SoftSkillCertificate::where('is_new', 1)->count()
            ],
            'contact' => [
                'total' => ContactInquiry::count(),
                'new' => ContactInquiry::where('is_new', 1)->count()
            ],
        ];

        // 2. Fetch Recent Wafid Appointments (e.g., last 5)
        $recent_appointments = Appointment::with('payment')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recent_appointments'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

    public function allAppointments()
    {
        return view('admin.appointments.appointments');
    }

    public function appointmentsData(Request $request)
    {
        // Define orderable columns mapping (index => column name)
        $columns = [
            0 => 'appointment_no',
            1 => 'first_name', // Order by first_name for the name column
            2 => 'passport_no',
            3 => 'phone',
            4 => 'country_traveling_to',
            5 => 'payment_status', // Custom handling for payment status
            6 => 'created_at'
        ];

        // Base query with left join for payment existence
        $query = Appointment::query()
            ->leftJoin('payments as p', 'appointments.id', '=', 'p.appointment_id')
            ->with('payment')
            ->select('appointments.*')
            ->whereNull('appointments.deleted_at');

        // SEARCH
        if ($request->search['value']) {
            $search = $request->search['value'];

            $query->where(function ($q) use ($search) {
                $q->where('appointments.first_name', 'like', "%$search%")
                    ->orWhere('appointments.last_name', 'like', "%$search%")
                    ->orWhere('appointments.passport_no', 'like', "%$search%")
                    ->orWhere('appointments.phone', 'like', "%$search%")
                    ->orWhere('appointments.country_traveling_to', 'like', "%$search%")
                    ->orWhereRaw("CONCAT(appointments.first_name, ' ', appointments.last_name) LIKE ?", ["%$search%"]);
            });
        }

        // TOTAL COUNTS
        $recordsTotal = Appointment::count();
        $recordsFiltered = $query->count();

        // APPLY ORDERING
        if (isset($request->order) && count($request->order)) {
            for ($i = 0; $i < count($request->order); $i++) {
                $columnIndex = intval($request->order[$i]['column']);
                $dir = $request->order[$i]['dir'] === 'asc' ? 'asc' : 'desc';

                if (isset($columns[$columnIndex])) {
                    $column = $columns[$columnIndex];

                    if ($column === 'payment_status') {
                        $query->orderByRaw("CASE WHEN p.id IS NOT NULL THEN 1 ELSE 0 END $dir");
                    } else {
                        $query->orderBy('appointments.' . $column, $dir);
                    }
                }
            }
        } else {
            // Default order if none specified
            $query->orderBy('appointments.id', 'desc');
        }

        // APPLY LIMIT, OFFSET
        $appointments = $query
            ->skip($request->start)
            ->take($request->length)
            ->get();

        // FORMAT RESPONSE
        $data = [];

        foreach ($appointments as $a) {
            $data[] = [
                $a->appointment_no,
                $a->first_name . ' ' . $a->last_name,
                $a->passport_no,
                $a->phone,
                $a->country_traveling_to,
                $a->payment ? 1 : 0,
                '', // actions handled in JS render
                $a->id, // hidden id for actions
                $a->is_new,
                $a->created_at ? $a->created_at->format('d M Y') : '', // created date        
            ];
        }

        // JSON RESPONSE FOR DATATABLES
        return response()->json([
            'draw' => intval($request->draw),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data
        ]);
    }

    public function editAppointment($id)
    {
        $appointment = Appointment::findOrFail($id);

        // Set is_new to 0 when user opens the edit page
        if ($appointment->is_new) {
            $appointment->is_new = 0;
            $appointment->save();
        }

        $appointment->load('payment'); // Load relation
        return view('admin.appointments.editappointment', compact('appointment'));
    }


    public function updateAppointment(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);

        $request->validate([
            'country' => 'required',
            'city' => 'required',
            'country_traveling_to' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'date_of_birth' => 'required|date',
            'nationality' => 'required',
            'gender' => 'required',
            'marital_status' => 'required',
            'passport_no' => 'required',
            'confirm_passport_no' => 'required|same:passport_no',
            'passport_issue_date' => 'required|date',
            'passport_issue_place' => 'required',
            'passport_expiry_date' => 'required|date',
            'visa_type' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'national_id' => 'required',
            'position_applied' => 'required',
        ]);

        $appointment->update($request->all());

        return redirect()->route('admin.appointments')
            ->with('success', 'Appointment updated successfully!');
    }

    public function deleteAppointment($id)
    {
        $appointment = Appointment::with('payment')->findOrFail($id);

        // Delete payment manually (hard delete)
        if ($appointment->payment) {
            $appointment->payment->delete();
        }

        // Soft delete appointment
        $appointment->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Appointment and payment deleted successfully'
        ]);
    }

    public function checkResults()
    {
        return view('admin.checkMedicalResults');
    }

    public function checkResultsData(Request $request)
    {
        // Columns mapping for ordering
        $columns = [
            0 => 'id',
            1 => 'passport_no',
            2 => 'phone',
            3 => 'created_at'
        ];

        // Base query
        $query = CheckResult::query();

        // SEARCH
        if ($request->search['value']) {
            $search = $request->search['value'];

            $query->where(function ($q) use ($search) {
                $q->where('passport_no', 'like', "%$search%")
                    ->orWhere('phone', 'like', "%$search%");
            });
        }

        // TOTAL RECORDS
        $recordsTotal = CheckResult::count();
        $recordsFiltered = $query->count();

        // ORDERING
        if (isset($request->order) && count($request->order)) {
            foreach ($request->order as $order) {
                $columnIndex = intval($order['column']);
                $dir = $order['dir'] === 'asc' ? 'asc' : 'desc';

                if (isset($columns[$columnIndex])) {
                    $query->orderBy($columns[$columnIndex], $dir);
                }
            }
        } else {
            // Default order: ID DESC
            $query->orderBy('id', 'desc');
        }

        // PAGINATION
        $results = $query
            ->skip($request->start)
            ->take($request->length)
            ->get();

        // BUILD RESPONSE DATA
        $data = [];

        foreach ($results as $row) {
            $rowClass = $row->is_new ? 'new-record' : '';
            $data[] = [
                'DT_RowClass' => $rowClass, // add class for new records
                $row->id,
                $row->passport_no,
                $row->phone,
                $row->created_at->format("d M Y"),
                '<a href="javascript:;" class="btn btn-sm btn-clean btn-icon delete-result" data-id="' . $row->id . '" title="Delete">
                    <i class="la la-trash"></i>
                </a>'
            ];
        }

        // RETURN JSON (datatables format)
        return response()->json([
            'draw' => intval($request->draw),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data
        ]);
    }

    public function markAsRead($id)
    {
        $result = CheckResult::findOrFail($id);
        $result->is_new = 0;
        $result->save();

        return response()->json(['success' => true, 'message' => 'Record marked as read']);
    }

    public function deleteCheckResult($id)
    {
        $result = CheckResult::find($id);

        if (!$result) {
            return response()->json(['status' => 'error', 'message' => 'Record not found'], 404);
        }

        $result->delete(); // now performs SOFT DELETE

        return response()->json(['status' => 'success', 'message' => 'Deleted successfully']);
    }

    public function allSpecialAppointments()
    {
        return view('admin.specialappointments.appointments');
    }

    public function specialAppointmentsData(Request $request)
    {
        // 1. Match these exactly to your DB columns for sorting
        $columns = [
            0 => 'appointment_no',
            1 => 'first_name',
            2 => 'passport_no',
            3 => 'phone',
            4 => 'city',
            5 => 'medical_center',
            6 => 'country_traveling_to',
            7 => 'payment_status', // Virtual column logic handled in ordering below
            8 => 'created_at',
        ];

        $query = SpecialAppointment::query()
            ->leftJoin('special_payments as sp', 'special_appointments.id', '=', 'sp.special_appointment_id')
            ->select('special_appointments.*', 'sp.id as payment_id') // Select payment_id to check status
            ->whereNull('special_appointments.deleted_at');

        // ... (Your Search Logic is fine) ... 
        if ($request->search['value']) {
            $search = $request->search['value'];
            $query->where(function ($q) use ($search) {
                $q->where('special_appointments.first_name', 'like', "%$search%")
                    ->orWhere('special_appointments.last_name', 'like', "%$search%")
                    ->orWhere('special_appointments.passport_no', 'like', "%$search%")
                    ->orWhere('special_appointments.phone', 'like', "%$search%");
            });
        }

        $recordsTotal = SpecialAppointment::count();
        $recordsFiltered = $query->count();

        // ... (Your Ordering Logic) ...
        if ($request->order) {
            foreach ($request->order as $order) {
                $column = $columns[$order['column']] ?? null;
                $dir = $order['dir'];
                if ($column === 'payment_status') {
                    $query->orderByRaw("CASE WHEN sp.id IS NOT NULL THEN 1 ELSE 0 END $dir");
                } elseif ($column) {
                    $query->orderBy('special_appointments.' . $column, $dir);
                }
            }
        } else {
            $query->orderBy('special_appointments.id', 'desc');
        }

        $appointments = $query
            ->skip($request->start)
            ->take($request->length)
            ->get();

        $data = [];

        foreach ($appointments as $a) {
            // Determine Payment Status
            $isPaid = $a->payment_id ? 1 : 0;

            $data[] = [
                $a->appointment_no,             // 0: ID (Fixed column name)
                $a->first_name . ' ' . $a->last_name, // 1: Name
                $a->passport_no,                // 2: Passport
                $a->phone,                      // 3: Phone
                $a->city,                       // 4: City
                $a->medical_center,             // 5: Medical Center
                $a->country_traveling_to,       // 6: Country
                $isPaid,                        // 7: Payment Status (0 or 1)
                $a->created_at?->format('d M Y'), // 8: Date
                '',                             // 9: Actions (Placeholder)
                $a->id,                         // 10: Hidden ID
                $a->is_new                      // 11: Hidden Is New (For row highlighting)
            ];
        }

        return response()->json([
            'draw' => intval($request->draw),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data
        ]);
    }

    public function editSpecialAppointment($id)
    {
        $appointment = SpecialAppointment::with('specialPayment')->findOrFail($id);

        if ($appointment->is_new) {
            $appointment->update(['is_new' => 0]);
        }

        return view('admin.specialappointments.editappointment', compact('appointment'));
    }

    public function updateSpecialAppointment(Request $request, $id)
    {
        $appointment = SpecialAppointment::findOrFail($id);

        $request->validate([
            'country' => 'required',
            'city' => 'required',
            'medical_center' => 'required',
            'country_traveling_to' => 'required',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'nationality' => 'required',
            'gender' => 'required|in:Male,Female',
            'marital_status' => 'required|in:Single,Married',
            'passport_no' => 'required|string|max:50',
            'confirm_passport_no' => 'required|string|same:passport_no',
            'passport_issue_date' => 'required|date',
            'passport_issue_place' => 'required|string|max:255',
            'passport_expiry_date' => 'required|date',
            'visa_type' => 'required|in:work-visa,family-visa',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'national_id' => 'required|string|max:50',
            'position_applied' => 'required|string',
            'other_position' => 'nullable|string|max:255',
        ]);

        // Update the appointment
        $appointment->update($request->all());

        return redirect()->route('admin.special.appointments')
            ->with('success', 'Special appointment updated successfully!');
    }

    public function deleteSpecialAppointment($id)
    {
        $appointment = SpecialAppointment::with('specialPayment')->findOrFail($id);

        if ($appointment->specialPayment) {
            $appointment->specialPayment->delete();
        }

        $appointment->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Special appointment deleted successfully'
        ]);
    }

    public function allNavtechAppointments()
    {
        return view('admin.navtechappointments.index');
    }

    public function navtechAppointmentsData(Request $request)
    {
        $columns = [
            0 => 'id',
            1 => 'occupation',
            2 => 'whatsapp_number',
            3 => 'country', // Was City, now Country
            4 => 'id',      // Placeholder for Status
            5 => 'created_at',
        ];

        $query = NavtechAppointment::with('payment');

        if ($request->search['value']) {
            $search = $request->search['value'];
            $query->where(function ($q) use ($search) {
                $q->where('occupation', 'like', "%$search%")
                    ->orWhere('whatsapp_number', 'like', "%$search%");
            });
        }

        $recordsTotal = NavtechAppointment::count();
        $recordsFiltered = $query->count();

        if ($request->order) {
            $query->orderBy($columns[$request->order[0]['column']], $request->order[0]['dir']);
        } else {
            $query->orderBy('id', 'desc');
        }

        $appointments = $query->skip($request->start)->take($request->length)->get();

        $data = [];
        foreach ($appointments as $a) {
            $isPaid = $a->payment ? 1 : 0;
            $data[] = [
                $a->id,                     // 0
                $a->occupation,             // 1
                $a->whatsapp_number,        // 2
                $a->country,                // 3 (City removed)
                $isPaid,                    // 4
                $a->created_at->format('d M Y'), // 5
                '',                         // 6 (Actions)
                $a->id,                     // 7 (Hidden ID)
                $a->is_new                  // 8 (Hidden New Status)
            ];
        }

        return response()->json([
            'draw' => intval($request->draw),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data
        ]);
    }

    public function editNavtechAppointment($id)
    {
        $appointment = NavtechAppointment::with('payment')->findOrFail($id);

        if ($appointment->is_new) {
            $appointment->update(['is_new' => 0]);
        }

        return view('admin.navtechappointments.edit', compact('appointment'));
    }

    public function updateNavtechAppointment(Request $request, $id)
    {
        $appointment = NavtechAppointment::findOrFail($id);

        $request->validate([
            'country' => 'required',
            'whatsapp_number' => 'required',
            'occupation' => 'required',
        ]);

        $appointment->update($request->all());

        return redirect()->route('admin.navtech.appointments')->with('success', 'Appointment updated successfully!');
    }

    public function deleteNavtechAppointment($id)
    {
        // Find the record
        $appointment = NavtechAppointment::findOrFail($id);

        $appointment->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Appointment moved to trash successfully'
        ]);
    }

    public function allTasheerAppointments()
    {
        return view('admin.tasheerappointments.index');
    }

    public function tasheerAppointmentsData(Request $request)
    {
        $columns = [
            0 => 'id',
            1 => 'embassy',
            2 => 'etimad_center', // Added this
            3 => 'whatsapp_number',
            4 => 'id', // Status column sorting
            5 => 'created_at',
        ];

        $query = TasheerAppointment::with('payment');

        if ($request->search['value']) {
            $search = $request->search['value'];
            $query->where(function ($q) use ($search) {
                $q->where('embassy', 'like', "%$search%")
                    ->orWhere('etimad_center', 'like', "%$search%") // Added this
                    ->orWhere('whatsapp_number', 'like', "%$search%");
            });
        }

        $recordsTotal = TasheerAppointment::count();
        $recordsFiltered = $query->count();

        if ($request->order) {
            $query->orderBy($columns[$request->order[0]['column']], $request->order[0]['dir']);
        } else {
            $query->orderBy('id', 'desc');
        }

        $appointments = $query->skip($request->start)->take($request->length)->get();

        $data = [];
        foreach ($appointments as $a) {
            $data[] = [
                $a->id,                          // 0
                $a->embassy,                     // 1
                $a->etimad_center,               // 2 (New)
                $a->whatsapp_number,             // 3
                $a->payment ? 1 : 0,             // 4: Status
                $a->created_at->format('d M Y'), // 5
                '',                              // 6: Actions
                $a->id,                          // 7: Hidden ID
                $a->is_new                       // 8: Hidden is_new
            ];
        }

        return response()->json([
            'draw' => intval($request->draw),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data
        ]);
    }

    public function editTasheerAppointment($id)
    {
        $appointment = TasheerAppointment::with('payment')->findOrFail($id);

        if ($appointment->is_new) {
            $appointment->update(['is_new' => 0]);
        }

        return view('admin.tasheerappointments.edit', compact('appointment'));
    }

    public function updateTasheerAppointment(Request $request, $id)
    {
        $appointment = TasheerAppointment::findOrFail($id);

        $request->validate([
            'embassy' => 'required',
            'etimad_center' => 'required', // Added validation
            'whatsapp_number' => 'required',
        ]);

        $appointment->update($request->all());

        return redirect()->route('admin.tasheer.appointments')->with('success', 'Tasheer appointment updated successfully!');
    }

    public function deleteTasheerAppointment($id)
    {
        $appointment = TasheerAppointment::findOrFail($id);
        $appointment->delete(); // Soft delete
        return response()->json(['status' => 'success']);
    }

    public function allSoftSkillAppointments()
    {
        return view('admin.softskill.index');
    }

    public function softSkillAppointmentsData(Request $request)
    {
        $columns = [0 => 'id', 1 => 'whatsapp_number', 2 => 'id', 3 => 'created_at'];

        $query = SoftSkillCertificate::with('payment');

        if ($request->search['value']) {
            $search = $request->search['value'];
            $query->where('whatsapp_number', 'like', "%$search%");
        }

        $recordsTotal = SoftSkillCertificate::count();
        $recordsFiltered = $query->count();

        if ($request->order) {
            $query->orderBy($columns[$request->order[0]['column']], $request->order[0]['dir']);
        } else {
            $query->orderBy('id', 'desc');
        }

        $appointments = $query->skip($request->start)->take($request->length)->get();

        $data = [];
        foreach ($appointments as $a) {
            $data[] = [
                $a->id,
                $a->whatsapp_number,
                $a->payment ? 1 : 0,
                $a->created_at->format('d M Y'),
                '',
                $a->id,
                $a->is_new // Assuming you added this column in migration
            ];
        }

        return response()->json([
            'draw' => intval($request->draw),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data
        ]);
    }

    public function editSoftSkillAppointment($id)
    {
        $appointment = SoftSkillCertificate::with('payment')->findOrFail($id);
        if ($appointment->is_new) {
            $appointment->update(['is_new' => 0]);
        }
        return view('admin.softskill.edit', compact('appointment'));
    }

    public function updateSoftSkillAppointment(Request $request, $id)
    {
        $appointment = SoftSkillCertificate::findOrFail($id);
        $appointment->update($request->only(['whatsapp_number']));
        return redirect()->route('admin.softskill.appointments')->with('success', 'Record updated successfully!');
    }

    public function deleteSoftSkillAppointment($id)
    {
        $appointment = SoftSkillCertificate::findOrFail($id);
        $appointment->delete();

        return response()->json(['status' => 'success']);
    }

    public function allPaymentMethods()
    {
        return view('admin.paymentmethods.index');
    }

    public function paymentMethodsData(Request $request)
    {
        $query = PaymentMethod::query();

        // 1. Total records (before filtering)
        $recordsTotal = PaymentMethod::count();

        // 2. Apply Search
        if ($request->has('search') && !empty($request->input('search')['value'])) {
            $searchValue = $request->input('search')['value'];
            $query->where(function ($q) use ($searchValue) {
                $q->where('account_name', 'LIKE', "%{$searchValue}%")
                    ->orWhere('account_title', 'LIKE', "%{$searchValue}%")
                    ->orWhere('account_number', 'LIKE', "%{$searchValue}%");
            });
        }

        // 3. Count records after filtering (for pagination calculation)
        $recordsFiltered = $query->count();

        // 4. Apply Ordering (Optional but recommended)
        if ($request->has('order')) {
            $columns = ['id', 'account_name', 'account_title', 'account_number', 'status']; // Map columns to indices
            $columnIndex = $request->input('order')[0]['column'];
            $columnDir = $request->input('order')[0]['dir'];
            if (isset($columns[$columnIndex])) {
                $query->orderBy($columns[$columnIndex], $columnDir);
            }
        }

        // 5. Apply Pagination (Limit and Offset)
        $start = $request->input('start', 0);
        $length = $request->input('length', 10);
        $methods = $query->offset($start)->limit($length)->get();

        // 6. Format Data
        $data = [];
        foreach ($methods as $m) {
            $data[] = [
                $m->id,
                $m->account_name,
                $m->account_title,
                $m->account_number,
                $m->status,
                $m->qr_code ? asset('uploads/qr/' . $m->qr_code) : null,
                $m->id // Used for actions
            ];
        }

        return response()->json([
            'draw' => intval($request->draw),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data
        ]);
    }

    public function createPaymentMethod()
    {
        return view('admin.paymentmethods.create');
    }

    public function storePaymentMethod(Request $request)
    {
        $data = $request->validate([
            'account_name' => 'required',
            'account_title' => 'required',
            'account_number' => 'required',
            'iban' => 'nullable',
            'qr_code' => 'required|image|mimes:jpeg,png,jpg|max:2048' // Required as requested
        ]);

        if ($request->hasFile('qr_code')) {
            $imageName = time() . '.' . $request->qr_code->extension();
            $request->qr_code->move(public_path('uploads/qr'), $imageName);
            $data['qr_code'] = $imageName;
        }

        PaymentMethod::create($data);
        return redirect()->route('admin.payment.methods.index')->with('success', 'Payment method added successfully!');
    }

    public function editPaymentMethod($id)
    {
        $method = PaymentMethod::findOrFail($id);
        return view('admin.paymentmethods.edit', compact('method'));
    }

    public function updatePaymentMethod(Request $request, $id)
    {
        $method = PaymentMethod::findOrFail($id);

        $data = $request->validate([
            'account_name' => 'required',
            'account_title' => 'required',
            'account_number' => 'required',
            'iban' => 'nullable',
            'status' => 'required|in:0,1',
            'qr_code' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('qr_code')) {
            if ($method->qr_code && file_exists(public_path('uploads/qr/' . $method->qr_code))) {
                unlink(public_path('uploads/qr/' . $method->qr_code));
            }
            $imageName = time() . '.' . $request->qr_code->extension();
            $request->qr_code->move(public_path('uploads/qr'), $imageName);
            $data['qr_code'] = $imageName;
        }

        $method->update($data);
        return redirect()->route('admin.payment.methods.index')->with('success', 'Payment method updated successfully!');
    }

    public function deletePaymentMethod($id)
    {
        $method = PaymentMethod::findOrFail($id);
        if ($method->qr_code)
            File::delete(public_path('uploads/qr/' . $method->qr_code));
        $method->delete();
        return response()->json(['status' => 'success']);
    }

    public function editfee()
    {
        // Fetch all fees keyed by their 'fee_key' for easy access in view
        $fees = AppointmentFee::all()->pluck('amount', 'fee_key');

        return view('admin.fees.edit', compact('fees'));
    }

    public function updatefee(Request $request)
    {
        $data = $request->except('_token');

        foreach ($data as $key => $amount) {
            AppointmentFee::where('fee_key', $key)->update(['amount' => $amount]);
        }

        return redirect()->back()->with('success', 'Appointment fees updated successfully.');
    }

    public function showFaqPage()
    {
        return view('admin.faqs.index');
    }

    public function fetchFaqData(Request $request)
    {
        // 1. Basic Query
        $query = Faq::query();

        // 2. Count Total Records (before filtering)
        $totalRecords = $query->count();

        // 3. Search Logic
        // DataTables sends search value in $request->input('search')['value']
        if ($searchValue = $request->input('search.value')) {
            $query->where(function ($q) use ($searchValue) {
                $q->where('question', 'LIKE', "%{$searchValue}%")
                    ->orWhere('answer', 'LIKE', "%{$searchValue}%");
            });
        }

        // 4. Count Filtered Records (after search, before pagination)
        $filteredRecords = $query->count();

        // 5. Sorting Logic
        // Map DataTables column index to Database column name
        $columns = ['id', 'question', 'answer', 'status'];

        if ($request->has('order')) {
            $orderColumnIndex = $request->input('order.0.column');
            $orderDirection = $request->input('order.0.dir'); // asc or desc

            // Ensure we don't try to sort by the "Actions" column (index 4)
            if (isset($columns[$orderColumnIndex])) {
                $query->orderBy($columns[$orderColumnIndex], $orderDirection);
            }
        } else {
            // Default Sort
            $query->orderBy('created_at', 'desc');
        }

        // 6. Pagination Logic
        $start = $request->input('start');  // Offset
        $length = $request->input('length'); // Limit

        // Apply pagination only if length is valid (not -1 for "All")
        if ($length != -1) {
            $query->skip($start)->take($length);
        }

        $faqs = $query->get();

        // 7. Format Data for Display
        $data = [];
        foreach ($faqs as $faq) {
            $statusBadge = $faq->status == 1
                ? '<span class="label label-light-success label-inline">Active</span>'
                : '<span class="label label-light-danger label-inline">Inactive</span>';

            $buttons = '<a href="' . route('admin.faqs.edit', $faq->id) . '" class="btn btn-sm btn-clean btn-icon" title="Edit"><i class="la la-edit"></i></a>
                        <button class="btn btn-sm btn-clean btn-icon delete-btn" data-id="' . $faq->id . '" title="Delete"><i class="la la-trash"></i></button>';

            $data[] = [
                $faq->id,
                $faq->question,
                Str::limit($faq->answer, 50),
                $statusBadge,
                $buttons
            ];
        }

        // 8. Return JSON
        return response()->json([
            "draw" => intval($request->input('draw')),
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $filteredRecords,
            "data" => $data
        ]);
    }

    public function addFaqForm()
    {
        return view('admin.faqs.create');
    }

    public function saveFaqEntry(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'status' => 'required|in:0,1',
        ]);

        Faq::create([
            'question' => $request->question,
            'answer' => $request->answer,
            'status' => $request->status
        ]);

        return redirect()->route('admin.faqs.page')->with('success', 'FAQ Added Successfully');
    }

    public function editFaqForm($id)
    {
        $faq = Faq::findOrFail($id);
        return view('admin.faqs.edit', compact('faq'));
    }

    public function updateFaqEntry(Request $request, $id)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'status' => 'required|in:0,1',
        ]);

        $faq = Faq::findOrFail($id);
        $faq->update([
            'question' => $request->question,
            'answer' => $request->answer,
            'status' => $request->status
        ]);

        return redirect()->route('admin.faqs.page')->with('success', 'FAQ Updated Successfully');
    }

    public function removeFaqEntry($id)
    {
        $faq = Faq::find($id);
        if ($faq) {
            $faq->delete();
            return response()->json(['success' => 'Deleted successfully']);
        }
        return response()->json(['error' => 'Not found'], 404);
    }

    public function editprofile()
    {
        $user = Auth::user();
        return view('admin.profile.edit', compact('user'));
    }

    public function updateprofile(Request $request)
    {
        $user = Auth::user();

        // 1. Handle "Info" Update
        if ($request->input('action') == 'info') {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
                'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            ]);

            $user->name = $request->name;
            $user->email = $request->email;

            // Handle Avatar Upload
            if ($request->hasFile('avatar')) {
                if ($user->avatar && File::exists(public_path($user->avatar))) {
                    File::delete(public_path($user->avatar));
                }
                $file = $request->file('avatar');
                $filename = time() . '_' . $user->id . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/users'), $filename);
                $user->avatar = 'uploads/users/' . $filename;
            }

            $user->save();
            return redirect()->back()->with('success', 'Personal information updated successfully!');
        }

        // 2. Handle "Password" Update
        if ($request->input('action') == 'password') {
            $request->validate([
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);

            $user->password = Hash::make($request->password);
            $user->save();

            return redirect()->back()->with('success', 'Password changed successfully!');
        }

        return redirect()->back()->with('error', 'Invalid request.');
    }

    // ==========================================
    // Contact Inquiries Management
    // ==========================================

    public function allContacts()
    {
        return view('admin.contacts.index');
    }

    public function contactsData(Request $request)
    {
        $columns = [
            0 => 'id',
            1 => 'name',
            2 => 'email',
            3 => 'subject',
            4 => 'created_at',
            5 => 'id', // Actions
        ];

        $query = ContactInquiry::query();

        if ($request->search['value']) {
            $search = $request->search['value'];
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%")
                    ->orWhere('subject', 'like', "%$search%")
                    ->orWhere('phone', 'like', "%$search%");
            });
        }

        $recordsTotal = ContactInquiry::count();
        $recordsFiltered = $query->count();

        if ($request->order) {
            $query->orderBy($columns[$request->order[0]['column']], $request->order[0]['dir']);
        } else {
            $query->orderBy('id', 'desc');
        }

        $contacts = $query->skip($request->start)->take($request->length)->get();

        $data = [];
        foreach ($contacts as $c) {
            // Add 'new-record' class if is_new == 1
            $rowClass = ($c->is_new == 1) ? 'new-record' : '';

            $data[] = [
                "DT_RowClass" => $rowClass,
                "",
                $c->name . '<br><small class="text-muted">' . $c->phone . '</small>',
                $c->email,
                Str::limit($c->subject, 30),
                $c->created_at->format('d M Y h:i A'),
                '
                <button class="btn btn-sm btn-info view-contact" data-id="' . $c->id . '" data-msg="' . e($c->message) . '" title="View Message"><i class="la la-eye"></i></button>
                <button class="btn btn-sm btn-danger delete-contact" data-id="' . $c->id . '" title="Delete"><i class="la la-trash"></i></button>
                ',
                $c->id
            ];
        }

        return response()->json([
            'draw' => intval($request->draw),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data
        ]);
    }

    public function markContactAsRead($id)
    {
        $contact = ContactInquiry::find($id);
        if ($contact) {
            $contact->is_new = 0;
            $contact->save();
            return response()->json(['status' => 'success']);
        }
        return response()->json(['status' => 'error'], 404);
    }

    public function deleteContact($id)
    {
        $contact = ContactInquiry::findOrFail($id);
        $contact->delete();
        return response()->json(['status' => 'success', 'message' => 'Inquiry deleted successfully']);
    }


    // ==========================
    // Blog Categories
    // ==========================

    public function blogCategories()
    {
        return view('admin.blogs.categories.index');
    }

    public function blogCategoriesData(Request $request)
    {
        $columns = [
            0 => 'id',
            1 => 'name',
            2 => 'slug',
            3 => 'created_at',
        ];

        $query = BlogCategory::query();

        if ($request->search['value']) {
            $search = $request->search['value'];
            $query->where('name', 'like', "%$search%")
                ->orWhere('slug', 'like', "%$search%");
        }

        $recordsTotal = BlogCategory::count();
        $recordsFiltered = $query->count();

        if ($request->order) {
            $column = $columns[$request->order[0]['column']] ?? 'id';
            $dir = $request->order[0]['dir'];
            $query->orderBy($column, $dir);
        } else {
            $query->orderBy('id', 'desc');
        }

        $categories = $query->skip($request->start)->take($request->length)->get();

        $data = [];
        foreach ($categories as $c) {
            $data[] = [
                $c->id,
                $c->name,
                $c->slug,
                $c->created_at->format('d M Y'),
                '<a href="' . route('admin.blog.categories.edit', $c->id) . '" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit details"><i class="la la-edit"></i></a>' .
                '<a href="javascript:;" class="btn btn-sm btn-clean btn-icon delete-category" data-id="' . $c->id . '" title="Delete"><i class="la la-trash"></i></a>'
            ];
        }

        return response()->json([
            'draw' => intval($request->draw),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data
        ]);
    }

    public function storeBlogCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blog_categories,slug',
        ]);

        BlogCategory::create([
            'name' => $request->name,
            'slug' => Str::slug($request->slug),
        ]);

        return redirect()->route('admin.blog.categories')->with('success', 'Category created successfully');
    }

    public function editBlogCategory($id)
    {
        $category = BlogCategory::findOrFail($id);
        return view('admin.blogs.categories.edit', compact('category'));
    }

    public function updateBlogCategory(Request $request, $id)
    {
        $category = BlogCategory::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blog_categories,slug,' . $id,
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->slug),
        ]);

        return redirect()->route('admin.blog.categories')->with('success', 'Category updated successfully');
    }

    public function deleteBlogCategory($id)
    {
        $category = BlogCategory::findOrFail($id);
        $category->delete();
        return response()->json(['status' => 'success', 'message' => 'Category deleted successfully']);
    }

    // ==========================
    // Blogs
    // ==========================

    public function blogs()
    {
        return view('admin.blogs.index');
    }

    public function blogsData(Request $request)
    {
        $columns = [
            0 => 'id',
            1 => 'title',
            2 => 'category_id',
            3 => 'status',
            4 => 'created_at',
        ];

        $query = Blog::with('category');

        if ($request->search['value']) {
            $search = $request->search['value'];
            $query->where('title', 'like', "%$search%")
                ->orWhereHas('category', function ($q) use ($search) {
                    $q->where('name', 'like', "%$search%");
                });
        }

        $recordsTotal = Blog::count();
        $recordsFiltered = $query->count();

        if ($request->order) {
            $columnIndex = $request->order[0]['column'];
            $columnName = $columns[$columnIndex] ?? 'id';
            $columnSortOrder = $request->order[0]['dir'];
            $query->orderBy($columnName, $columnSortOrder);
        } else {
            $query->orderBy('id', 'desc');
        }

        $blogs = $query->skip($request->start)->take($request->length)->get();

        $data = [];
        foreach ($blogs as $b) {
            $data[] = [
                $b->id,
                $b->title,
                $b->category ? $b->category->name : 'N/A',
                '<span class="label label-lg font-weight-bold label-light-' . ($b->status == 'published' ? 'success' : 'warning') . ' label-inline">' . ucfirst($b->status) . '</span>',
                $b->created_at->format('d M Y'),
                '<a href="' . route('admin.blogs.edit', $b->id) . '" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit details"><i class="la la-edit"></i></a>' .
                '<a href="javascript:;" class="btn btn-sm btn-clean btn-icon delete-blog" data-id="' . $b->id . '" title="Delete"><i class="la la-trash"></i></a>'
            ];
        }

        return response()->json([
            'draw' => intval($request->draw),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data
        ]);
    }

    public function createBlog()
    {
        $categories = BlogCategory::all();
        return view('admin.blogs.create', compact('categories'));
    }

    public function storeBlog(Request $request)
    {
        if (trim(strip_tags($request->input('content'))) == '') {
            $request->merge(['content' => null]);
        }

        $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:blogs,slug',
            'category_id' => 'required',
            'content' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->except('image');
        $data['slug'] = Str::slug($request->slug);

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/blogs'), $imageName);
            $data['image'] = 'uploads/blogs/' . $imageName;
        }

        Blog::create($data);

        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Blog created successfully'
            ]);
        }

        return redirect()->route('admin.blogs.index')->with('success', 'Blog created successfully');
    }

    public function editBlog($id)
    {
        $blog = Blog::findOrFail($id);
        $categories = BlogCategory::all();
        return view('admin.blogs.edit', compact('blog', 'categories'));
    }

    public function updateBlog(Request $request, $id)
    {
        if (trim(strip_tags($request->input('content'))) == '') {
            $request->merge(['content' => null]);
        }
        $blog = Blog::findOrFail($id);
        $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:blogs,slug,' . $id,
            'category_id' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->except('image');
        $data['slug'] = Str::slug($request->slug);

        if ($request->hasFile('image')) {
            if ($blog->image && file_exists(public_path($blog->image))) {
                @unlink(public_path($blog->image));
            }
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/blogs'), $imageName);
            $data['image'] = 'uploads/blogs/' . $imageName;
        }

        $blog->update($data);

        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Blog updated successfully'
            ]);
        }

        return redirect()->route('admin.blogs.index')->with('success', 'Blog updated successfully');
    }

    public function deleteBlog($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();
        return response()->json(['status' => 'success', 'message' => 'Blog deleted successfully']);
    }

    public function allMedicalCenters()
    {
        return view('admin.medical_centers.index');
    }

    public function medicalCentersData(Request $request)
    {
        $columns = [
            0 => 'id',
            1 => 'city',
            2 => 'medical_center',
            3 => 'phone',
            4 => 'created_at'
        ];

        $query = MedicalCenter::query();

        if ($request->search['value']) {
            $search = $request->search['value'];
            $query->where(function ($q) use ($search) {
                $q->where('medical_center', 'like', "%$search%")
                    ->orWhere('country', 'like', "%$search%")
                    ->orWhere('city', 'like', "%$search%")
                    ->orWhere('phone', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%");
            });
        }

        $recordsTotal = MedicalCenter::count();
        $recordsFiltered = $query->count();

        if (isset($request->order) && count($request->order)) {
            $columnIndex = intval($request->order[0]['column']);
            $dir = $request->order[0]['dir'];
            $column = $columns[$columnIndex] ?? 'id';
            $query->orderBy($column, $dir);
        } else {
            $query->orderBy('id', 'desc');
        }

        $centers = $query->skip($request->start)->take($request->length)->get();

        $data = [];
        foreach ($centers as $c) {
            $data[] = [
                $c->id,
                $c->city,
                $c->medical_center,
                $c->phone,
                $c->id, // actions handled in JS
            ];
        }

        return response()->json([
            'draw' => intval($request->draw),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data
        ]);
    }

    public function createMedicalCenter()
    {
        return view('admin.medical_centers.create');
    }

    public function storeMedicalCenter(Request $request)
    {
        $request->validate([
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'medical_center' => 'required|string|max:255',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'address_line_1' => 'nullable|string',
            'address_line_2' => 'nullable|string',
            'website' => 'nullable|url|max:255',
            'rating' => 'nullable|numeric|min:0|max:5',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/medical_centers'), $imageName);
            $data['image'] = 'uploads/medical_centers/' . $imageName;
        }

        MedicalCenter::create($data);

        return redirect()->route('admin.medical_centers.index')->with('success', 'Medical Center created successfully!');
    }

    public function editMedicalCenter($id)
    {
        $center = MedicalCenter::findOrFail($id);
        return view('admin.medical_centers.edit', compact('center'));
    }

    public function updateMedicalCenter(Request $request, $id)
    {
        $center = MedicalCenter::findOrFail($id);

        $request->validate([
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'medical_center' => 'required|string|max:255',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'address_line_1' => 'nullable|string',
            'address_line_2' => 'nullable|string',
            'website' => 'nullable|url|max:255',
            'rating' => 'nullable|numeric|min:0|max:5',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            // Delete old image
            if ($center->image && File::exists(public_path($center->image))) {
                File::delete(public_path($center->image));
            }

            $image = $request->file('image');
            $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/medical_centers'), $imageName);
            $data['image'] = 'uploads/medical_centers/' . $imageName;
        }

        $center->update($data);

        return redirect()->route('admin.medical_centers.index')->with('success', 'Medical Center updated successfully!');
    }

    public function deleteMedicalCenter($id)
    {
        $center = MedicalCenter::findOrFail($id);

        if ($center->image && File::exists(public_path($center->image))) {
            File::delete(public_path($center->image));
        }

        $center->delete();
        return response()->json(['status' => 'success', 'message' => 'Medical Center deleted successfully']);
    }

    // ==========================================
    // City Media Management (Hero Images)
    // ==========================================

    public function cityMedia()
    {
        return view('admin.city_media.index');
    }

    public function cityMediaData(Request $request)
    {
        $query = \App\Models\CityMedia::query();
        $recordsTotal = $query->count();
        $recordsFiltered = $query->count();

        $results = $query->orderBy('id', 'desc')->get();

        $data = [];
        foreach ($results as $row) {
            $data[] = [
                $row->id,
                $row->city_name,
                $row->hero_image ? '<img src="' . asset($row->hero_image) . '" class="rounded shadow-sm" style="max-height: 50px;">' : 'No Image',
                $row->created_at->format('d M Y'),
                '', // actions handled in JS
                $row->id
            ];
        }

        return response()->json([
            'draw' => intval($request->draw),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data
        ]);
    }

    public function createCityMedia()
    {
        // Fetch unique cities from medical centers to help the user
        $cities = MedicalCenter::distinct()->pluck('city')->sort();
        return view('admin.city_media.create', compact('cities'));
    }

    public function storeCityMedia(Request $request)
    {
        $request->validate([
            'city_name' => 'required|string|unique:city_media,city_name',
            'hero_image' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
            'description' => 'nullable|string',
        ]);

        $data = $request->only(['city_name', 'description']);

        if ($request->hasFile('hero_image')) {
            $image = $request->file('hero_image');
            $imageName = time() . '_' . Str::slug($request->city_name) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/cities'), $imageName);
            $data['hero_image'] = 'uploads/cities/' . $imageName;
        }

        \App\Models\CityMedia::create($data);

        return redirect()->route('admin.city_media.index')->with('success', 'City Media created successfully!');
    }

    public function deleteCityMedia($id)
    {
        $media = \App\Models\CityMedia::findOrFail($id);

        if ($media->hero_image && File::exists(public_path($media->hero_image))) {
            File::delete(public_path($media->hero_image));
        }

        $media->delete();

        return response()->json(['status' => 'success', 'message' => 'City Media deleted successfully']);
    }
}
