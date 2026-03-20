<?php
// database/seeders/CommissionSeeder.php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Commission;
use App\Models\Employee;
use Illuminate\Database\Seeder;

class CommissionSeeder extends Seeder
{
    public function run(): void
    {
        // Get all completed and paid appointments
        $appointments = Appointment::where('appointment_status', 'completed')
            ->where('payment_status', 'paid')
            ->get();

        foreach ($appointments as $appointment) {
            $employee = $appointment->employee;
            
            // Check if employee is eligible for commission
            if (in_array($employee->employment_type, ['commission', 'both']) && $employee->commission_percentage > 0) {
                $commissionAmount = ($appointment->final_amount * $employee->commission_percentage) / 100;
                
                // Determine if commission is paid (for previous months) or pending (current month)
                $status = $appointment->appointment_date->month < now()->month ? 'paid' : 'pending';
                
                Commission::create([
                    'employee_id' => $employee->id,
                    'appointment_id' => $appointment->id,
                    'service_amount' => $appointment->final_amount,
                    'commission_percentage' => $employee->commission_percentage,
                    'commission_amount' => $commissionAmount,
                    'commission_date' => $appointment->appointment_date,
                    'status' => $status,
                    'created_at' => $appointment->appointment_date,
                    'updated_at' => $appointment->appointment_date
                ]);
            }
        }
    }
}