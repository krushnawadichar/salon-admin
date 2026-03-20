<?php
// app/Http/Controllers/Employee/CommissionController.php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Commission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommissionController extends Controller
{
    public function index(Request $request)
    {
        $employee = Auth::user()->employee;
        
        $query = Commission::where('employee_id', $employee->id)
            ->with('appointment.client');
        
        // Filter by month
        if ($request->has('month') && $request->month != '') {
            $query->whereMonth('commission_date', $request->month);
        } else {
            $query->whereMonth('commission_date', now()->month);
        }
        
        // Filter by year
        if ($request->has('year') && $request->year != '') {
            $query->whereYear('commission_date', $request->year);
        } else {
            $query->whereYear('commission_date', now()->year);
        }
        
        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }
        
        $commissions = $query->orderBy('commission_date', 'desc')
            ->paginate(15);
        
        // Summary statistics
        $summary = [
            'total_commission' => Commission::where('employee_id', $employee->id)
                ->whereMonth('commission_date', $request->month ?? now()->month)
                ->whereYear('commission_date', $request->year ?? now()->year)
                ->sum('commission_amount'),
            
            'pending_commission' => Commission::where('employee_id', $employee->id)
                ->whereMonth('commission_date', $request->month ?? now()->month)
                ->whereYear('commission_date', $request->year ?? now()->year)
                ->where('status', 'pending')
                ->sum('commission_amount'),
            
            'paid_commission' => Commission::where('employee_id', $employee->id)
                ->whereMonth('commission_date', $request->month ?? now()->month)
                ->whereYear('commission_date', $request->year ?? now()->year)
                ->where('status', 'paid')
                ->sum('commission_amount'),
            
            'total_appointments' => Commission::where('employee_id', $employee->id)
                ->whereMonth('commission_date', $request->month ?? now()->month)
                ->whereYear('commission_date', $request->year ?? now()->year)
                ->count()
        ];
        
        // Monthly breakdown for chart
        $monthlyData = Commission::where('employee_id', $employee->id)
            ->whereYear('commission_date', now()->year)
            ->select(
                DB::raw('MONTH(commission_date) as month'),
                DB::raw('SUM(commission_amount) as total')
            )
            ->groupBy('month')
            ->orderBy('month')
            ->get();
        
        $months = [];
        $amounts = [];
        
        for ($i = 1; $i <= 12; $i++) {
            $months[] = date('F', mktime(0, 0, 0, $i, 1));
            $monthData = $monthlyData->where('month', $i)->first();
            $amounts[] = $monthData ? $monthData->total : 0;
        }
        
        return view('employee.commissions.index', compact(
            'commissions', 
            'summary', 
            'months', 
            'amounts'
        ));
    }
    
    public function show(Commission $commission)
    {
        // Check if commission belongs to this employee
        $employee = Auth::user()->employee;
        
        if ($commission->employee_id !== $employee->id) {
            return redirect()->route('employee.commissions')
                ->with('error', 'You are not authorized to view this commission.');
        }
        
        $commission->load('appointment.client', 'appointment.services');
        
        return view('employee.commissions.show', compact('commission'));
    }
}