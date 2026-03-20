<?php
// app/Http/Controllers/Employee/DashboardController.php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Commission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $employee = Auth::user()->employee;
        
        // Today's appointments
        if (!$employee) {
        return view('employee.dashboard', [
            'todayAppointments' => collect() // empty collection
        ]);
    }

    // Today's appointments
    $todayAppointments = Appointment::where('employee_id', $employee->id)
        ->whereDate('appointment_date', today())
        ->with('client', 'services')
        ->get();
        
        // Upcoming appointments
        $upcomingAppointments = Appointment::where('employee_id', $employee->id)
            ->whereDate('appointment_date', '>', today())
            ->where('appointment_status', 'scheduled')
            ->with('client', 'services')
            ->orderBy('appointment_date')
            ->orderBy('start_time')
            ->take(5)
            ->get();
        
        // Today's earnings (commission)
        $todayCommissions = Commission::where('employee_id', $employee->id)
            ->whereDate('commission_date', today())
            ->sum('commission_amount');
        
        // Monthly earnings
        $monthlyCommissions = Commission::where('employee_id', $employee->id)
            ->whereMonth('commission_date', now()->month)
            ->whereYear('commission_date', now()->year)
            ->sum('commission_amount');
        
        // Total appointments count
        $totalAppointments = Appointment::where('employee_id', $employee->id)
            ->where('appointment_status', 'completed')
            ->count();
        
        // Recent commissions
        $recentCommissions = Commission::where('employee_id', $employee->id)
            ->with('appointment.client')
            ->latest()
            ->take(5)
            ->get();
        
        return view('employee.dashboard', compact(
            'todayAppointments',
            'upcomingAppointments',
            'todayCommissions',
            'monthlyCommissions',
            'totalAppointments',
            'recentCommissions',
            'employee'
        ));
    }
}