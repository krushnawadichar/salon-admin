<?php
// app/Http/Controllers/Admin/ReportController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Employee;
use App\Models\Commission;
use App\Models\Salary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function dailyReport(Request $request)
    {
        $date = $request->date ? Carbon::parse($request->date) : Carbon::today();
        
        $appointments = Appointment::whereDate('appointment_date', $date)
            ->with(['client', 'employee.user', 'services'])
            ->orderBy('start_time')
            ->get();
        
        $totalRevenue = $appointments->where('payment_status', 'paid')->sum('final_amount');
        $totalAppointments = $appointments->count();
        $completedAppointments = $appointments->where('appointment_status', 'completed')->count();
        
        $employeeStats = Employee::with(['user', 'appointments' => function($query) use ($date) {
                $query->whereDate('appointment_date', $date)
                      ->with('services');
            }])
            ->get()
            ->map(function($employee) use ($date) {
                $employee->total_appointments = $employee->appointments->count();
                $employee->total_revenue = $employee->appointments->where('payment_status', 'paid')->sum('final_amount');
                
                // Calculate total services done
                $totalServices = 0;
                foreach ($employee->appointments as $appointment) {
                    $totalServices += $appointment->services->count();
                }
                $employee->total_services = $totalServices;
                
                return $employee;
            });
        
        return view('admin.reports.daily', compact(
            'date', 
            'appointments', 
            'totalRevenue', 
            'totalAppointments', 
            'completedAppointments', 
            'employeeStats'
        ));
    }

    public function monthlyReport(Request $request)
    {
        $month = $request->month ?? Carbon::now()->month;
        $year = $request->year ?? Carbon::now()->year;
        
        $appointments = Appointment::whereMonth('appointment_date', $month)
            ->whereYear('appointment_date', $year)
            ->with(['client', 'employee.user'])
            ->get();
        
        $totalRevenue = $appointments->where('payment_status', 'paid')->sum('final_amount');
        $totalAppointments = $appointments->count();
        
        $dailyBreakdown = $appointments->groupBy(function($appointment) {
            return $appointment->appointment_date->format('Y-m-d');
        })->map(function($dayAppointments) {
            return [
                'count' => $dayAppointments->count(),
                'revenue' => $dayAppointments->where('payment_status', 'paid')->sum('final_amount')
            ];
        })->sortKeys();
        
        $employeePerformance = Employee::with(['user', 'appointments' => function($query) use ($month, $year) {
                $query->whereMonth('appointment_date', $month)
                      ->whereYear('appointment_date', $year)
                      ->where('payment_status', 'paid');
            }])
            ->whereIn('employment_type', ['commission', 'both', 'salary'])
            ->get()
            ->map(function($employee) use ($month, $year) {
                $employee->total_appointments = $employee->appointments->count();
                $employee->total_revenue = $employee->appointments->sum('final_amount');
                
                // Calculate commission for the month
                $employee->total_commission = Commission::where('employee_id', $employee->id)
                    ->whereMonth('commission_date', $month)
                    ->whereYear('commission_date', $year)
                    ->sum('commission_amount');
                
                return $employee;
            })
            ->filter(function($employee) {
                return $employee->total_appointments > 0 || $employee->total_commission > 0;
            });
        
        return view('admin.reports.monthly', compact(
            'month', 
            'year', 
            'totalRevenue', 
            'totalAppointments', 
            'dailyBreakdown', 
            'employeePerformance'
        ));
    }

    public function commissionReport(Request $request)
    {
        $month = $request->month ?? Carbon::now()->month;
        $year = $request->year ?? Carbon::now()->year;
        
        $commissions = Commission::whereMonth('commission_date', $month)
            ->whereYear('commission_date', $year)
            ->with(['employee.user', 'appointment.client'])
            ->orderBy('commission_date', 'desc')
            ->get();
        
        $totalCommission = $commissions->sum('commission_amount');
        $pendingCommission = $commissions->where('status', 'pending')->sum('commission_amount');
        $paidCommission = $commissions->where('status', 'paid')->sum('commission_amount');
        
        $employeeCommissions = $commissions->groupBy('employee_id')
            ->map(function($empCommissions) {
                $employee = $empCommissions->first()->employee;
                return [
                    'employee' => $employee,
                    'total' => $empCommissions->sum('commission_amount'),
                    'pending' => $empCommissions->where('status', 'pending')->sum('commission_amount'),
                    'paid' => $empCommissions->where('status', 'paid')->sum('commission_amount'),
                    'count' => $empCommissions->count()
                ];
            })
            ->sortByDesc('total');
        
        return view('admin.reports.commission', compact(
            'month', 
            'year', 
            'commissions', 
            'totalCommission', 
            'pendingCommission', 
            'paidCommission', 
            'employeeCommissions'
        ));
    }

    public function salaryReport(Request $request)
    {
        $month = $request->month ?? Carbon::now()->month;
        $year = $request->year ?? Carbon::now()->year;
        
        $salaries = Salary::where('month', $month)
            ->where('year', $year)
            ->with('employee.user')
            ->get();
        
        $totalSalary = $salaries->sum('total_salary');
        
        // Calculate pending salaries
        $employees = Employee::with('user')
            ->whereIn('employment_type', ['salary', 'both'])
            ->where('status', 'active')
            ->get();
            
        $pendingSalaries = [];
        
        foreach ($employees as $employee) {
            $salaryExists = $salaries->contains('employee_id', $employee->id);
            
            if (!$salaryExists) {
                // Calculate commission for the month
                $commissionEarned = Commission::where('employee_id', $employee->id)
                    ->whereMonth('commission_date', $month)
                    ->whereYear('commission_date', $year)
                    ->sum('commission_amount');
                
                $basicSalary = $employee->salary_amount ?? 0;
                $totalSalaryAmount = $basicSalary + $commissionEarned;
                
                $pendingSalaries[] = [
                    'employee' => $employee,
                    'basic_salary' => $basicSalary,
                    'commission' => $commissionEarned,
                    'total' => $totalSalaryAmount
                ];
            }
        }
        
        return view('admin.reports.salary', compact(
            'month', 
            'year', 
            'salaries', 
            'totalSalary', 
            'pendingSalaries'
        ));
    }

    public function processSalary(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'month' => 'required|integer|between:1,12',
            'year' => 'required|integer|min:2020',
            'basic_salary' => 'required|numeric|min:0',
            'commission_earned' => 'required|numeric|min:0',
            'total_salary' => 'required|numeric|min:0'
        ]);
        
        // Convert month number to month name
        $monthName = Carbon::create()->month($request->month)->format('F');
        
        DB::transaction(function () use ($request, $monthName) {
            // Create salary record
            Salary::create([
                'employee_id' => $request->employee_id,
                'basic_salary' => $request->basic_salary,
                'commission_earned' => $request->commission_earned,
                'total_salary' => $request->total_salary,
                'month' => $monthName,
                'year' => $request->year,
                'status' => 'paid',
                'payment_date' => Carbon::today()
            ]);
            
            // Mark commissions as paid for this month
            Commission::where('employee_id', $request->employee_id)
                ->whereMonth('commission_date', $request->month)
                ->whereYear('commission_date', $request->year)  
                ->update(['status' => 'paid']);
        });
        
        return redirect()->back()->with('success', 'Salary processed successfully for the employee.');
    }
}