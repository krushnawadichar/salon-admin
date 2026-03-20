<?php
// database/seeders/AppointmentSeeder.php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Client;
use App\Models\Employee;
use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AppointmentSeeder extends Seeder
{
    public function run(): void
    {
        $clients = Client::all();
        $employees = Employee::all();
        
        // Past appointments (last 30 days)
        for ($i = 1; $i <= 30; $i++) {
            $date = Carbon::now()->subDays($i);
            $this->createAppointmentForDate($date, $clients, $employees, 'completed', 'paid');
        }
        
        // Today's appointments
        $today = Carbon::today();
        $this->createAppointmentForDate($today, $clients, $employees, 'scheduled', 'pending', 5);
        
        // Tomorrow's appointments
        $tomorrow = Carbon::tomorrow();
        $this->createAppointmentForDate($tomorrow, $clients, $employees, 'scheduled', 'pending', 4);
        
        // Future appointments
        for ($i = 2; $i <= 10; $i++) {
            $date = Carbon::now()->addDays($i);
            $this->createAppointmentForDate($date, $clients, $employees, 'scheduled', 'pending', rand(2, 4));
        }
    }

    private function createAppointmentForDate($date, $clients, $employees, $status, $paymentStatus, $count = 3)
    {
        for ($i = 0; $i < $count; $i++) {
            $client = $clients->random();
            $employee = $employees->random();
            
            // Select random services (1-3 services)
            $services = Service::inRandomOrder()->take(rand(1, 3))->get();
            $totalAmount = $services->sum('price');
            $discount = rand(0, 1) ? rand(5, 15) : 0; // Random discount
            $finalAmount = $totalAmount - $discount;
            
            // Generate start time (between 9 AM and 5 PM)
            $hour = rand(9, 16);
            $minute = rand(0, 3) * 15; // 0, 15, 30, 45
            $startTime = Carbon::parse($date->format('Y-m-d') . ' ' . sprintf('%02d:%02d:00', $hour, $minute));
            
            // Calculate end time based on total duration
            $totalDuration = $services->sum('duration');
            $endTime = $startTime->copy()->addMinutes($totalDuration);

            $appointmentNumber = 'APT-' . $date->format('Ymd') . '-' . str_pad(($i + 1), 3, '0', STR_PAD_LEFT);

            $appointment = Appointment::create([
                'appointment_number' => $appointmentNumber,
                'client_id' => $client->id,
                'employee_id' => $employee->id,
                'appointment_date' => $date,
                'start_time' => $startTime,
                'end_time' => $endTime,
                'total_amount' => $totalAmount,
                'discount' => $discount,
                'final_amount' => $finalAmount,
                'payment_status' => $paymentStatus,
                'appointment_status' => $status,
                'notes' => rand(0, 1) ? 'Sample appointment notes' : null,
                'created_at' => $date->copy()->subDays(rand(1, 5)),
                'updated_at' => $date
            ]);

            // Attach services
            foreach ($services as $service) {
                DB::table('appointment_services')->insert([
                    'appointment_id' => $appointment->id,
                    'service_id' => $service->id,
                    'price' => $service->price,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
    }
}