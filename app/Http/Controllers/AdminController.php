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

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
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
        return view('admin.dashboard');
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
            3 => 'city',
            4 => 'country',
            5 => 'id', // Placeholder for status sorting logic
            6 => 'created_at',
        ];

        $query = NavtechAppointment::with('payment');

        if ($request->search['value']) {
            $search = $request->search['value'];
            $query->where(function ($q) use ($search) {
                $q->where('occupation', 'like', "%$search%")
                ->orWhere('whatsapp_number', 'like', "%$search%")
                ->orWhere('city', 'like', "%$search%");
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
                $a->id,
                $a->occupation,
                $a->whatsapp_number,
                $a->city,
                $a->country,
                $isPaid,
                $a->created_at->format('d M Y'),
                '', // Actions placeholder
                $a->id, // Hidden ID for JS
                $a->is_new // Hidden is_new for row highlighting
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
            'city' => 'required',
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
            2 => 'whatsapp_number',
            3 => 'id', // Status column sorting
            4 => 'created_at',
        ];

        $query = TasheerAppointment::with('payment');

        if ($request->search['value']) {
            $search = $request->search['value'];
            $query->where(function ($q) use ($search) {
                $q->where('embassy', 'like', "%$search%")
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
                $a->whatsapp_number,             // 2
                $a->payment ? 1 : 0,             // 3: Status (Paid/Pending)
                $a->created_at->format('d M Y'), // 4
                '',                              // 5: Actions placeholder
                $a->id,                          // 6: Hidden ID
                $a->is_new                       // 7: Hidden is_new
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

}
