<?php
// app/Http/Controllers/Employee/AppointmentController.php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $employee = Auth::user()->employee;
        
        $query = Appointment::where('employee_id', $employee->id)
            ->with('client', 'services');
        
        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('appointment_status', $request->status);
        }
        
        // Filter by date range
        if ($request->has('date_from') && $request->date_from != '') {
            $query->whereDate('appointment_date', '>=', $request->date_from);
        }
        
        if ($request->has('date_to') && $request->date_to != '') {
            $query->whereDate('appointment_date', '<=', $request->date_to);
        }
        
        $appointments = $query->orderBy('appointment_date', 'desc')
            ->orderBy('start_time', 'desc')
            ->paginate(15);
        
        // Statistics
        $stats = [
            'total' => Appointment::where('employee_id', $employee->id)->count(),
            'completed' => Appointment::where('employee_id', $employee->id)
                ->where('appointment_status', 'completed')->count(),
            'scheduled' => Appointment::where('employee_id', $employee->id)
                ->where('appointment_status', 'scheduled')->count(),
            'cancelled' => Appointment::where('employee_id', $employee->id)
                ->where('appointment_status', 'cancelled')->count(),
        ];
        
        return view('employee.appointments.index', compact('appointments', 'stats'));
    }
    
    public function show(Appointment $appointment)
    {
        // Check if appointment belongs to this employee
        $employee = Auth::user()->employee;
        
        if ($appointment->employee_id !== $employee->id) {
            return redirect()->route('employee.appointments')
                ->with('error', 'You are not authorized to view this appointment.');
        }
        
        $appointment->load('client', 'services', 'payments');
        
        return view('employee.appointments.show', compact('appointment'));
    }
    
    public function updateStatus(Request $request, Appointment $appointment)
    {
        // Check if appointment belongs to this employee
        $employee = Auth::user()->employee;
        
        if ($appointment->employee_id !== $employee->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        
        $request->validate([
            'status' => 'required|in:completed,cancelled'
        ]);
        
        $appointment->update([
            'appointment_status' => $request->status
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Appointment status updated successfully.'
        ]);
    }
}