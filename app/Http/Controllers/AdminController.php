<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Appointment;
use App\Models\Payment;

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
        return view('admin.appointments');
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
        ];

        // Base query with left join for payment existence
        $query = Appointment::query()
            ->leftJoin('payments as p', 'appointments.id', '=', 'p.appointment_id') // Adjust join based on your relation (assuming hasOne Payment)
            ->with('payment')
            ->select('appointments.*');

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
            $query->latest('appointments.created_at');
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
                $a->id // hidden id for actions
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
        $appointment = Appointment::with('payment')->findOrFail($id);
        return view('admin.editappointment', compact('appointment'));
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

    
}
