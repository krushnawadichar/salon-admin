<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Client;
use App\Models\Employee;
use App\Models\Service;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalServices = Service::count();
        $totalEmployees = Employee::count();
        $totalClients = Client::count();
        $todayAppointments = Appointment::whereDate('appointment_date', today())->count();
        $todayRevenue = Appointment::whereDate('appointment_date', today())
            ->where('payment_status', 'paid')
            ->sum('final_amount');
        
        $monthlyRevenue = Appointment::whereMonth('appointment_date', now()->month)
            ->whereYear('appointment_date', now()->year)
            ->where('payment_status', 'paid')
            ->sum('final_amount');
        
        $recentAppointments = Appointment::with(['client', 'employee'])
            ->latest()
            ->take(10)
            ->get();
        
        return view('admin.dashboard', compact(
            'totalServices', 'totalEmployees', 'totalClients',
            'todayAppointments', 'todayRevenue', 'monthlyRevenue',
            'recentAppointments'
        ));
    }
}