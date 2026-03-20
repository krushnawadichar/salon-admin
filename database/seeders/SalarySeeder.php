<?php
// database/seeders/SalarySeeder.php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Salary;
use App\Models\Commission;
use Illuminate\Database\Seeder;

class SalarySeeder extends Seeder
{
    public function run(): void
    {
        $employees = Employee::whereIn('employment_type', ['salary', 'both'])->get();
        
        // Create salaries for last 3 months
        $months = ['January', 'February', 'March'];
        $currentYear = now()->year;
        
        foreach ($months as $index => $month) {
            $monthNumber = $index + 1;
            
            foreach ($employees as $employee) {
                // Calculate commission earned for this month
                $commissionEarned = Commission::where('employee_id', $employee->id)
                    ->whereMonth('commission_date', $monthNumber)
                    ->whereYear('commission_date', $currentYear)
                    ->sum('commission_amount');
                
                $basicSalary = $employee->salary_amount ?? 0;
                $totalSalary = $basicSalary + $commissionEarned;
                
                // Past months are paid, current month is pending
                $status = $monthNumber < now()->month ? 'paid' : 'pending';
                
                Salary::create([
                    'employee_id' => $employee->id,
                    'basic_salary' => $basicSalary,
                    'commission_earned' => $commissionEarned,
                    'total_salary' => $totalSalary,
                    'month' => $month,
                    'year' => $currentYear,
                    'status' => $status,
                    'payment_date' => $status == 'paid' ? now()->subMonths(3 - $monthNumber)->endOfMonth() : null,
                    'created_at' => now()->subMonths(3 - $monthNumber),
                    'updated_at' => now()->subMonths(3 - $monthNumber)
                ]);
            }
        }
    }
}