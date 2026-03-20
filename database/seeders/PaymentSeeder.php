<?php
// database/seeders/PaymentSeeder.php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Payment;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        // Get all completed appointments
        $completedAppointments = Appointment::where('appointment_status', 'completed')
            ->where('payment_status', 'paid')
            ->get();

        foreach ($completedAppointments as $appointment) {
            // Create payment record
            Payment::create([
                'payment_number' => 'PAY-' . $appointment->appointment_number,
                'appointment_id' => $appointment->id,
                'amount' => $appointment->final_amount,
                'payment_method' => ['cash', 'card', 'upi'][rand(0, 2)],
                'payment_date' => $appointment->appointment_date,
                'notes' => rand(0, 1) ? 'Payment completed successfully' : null,
                'created_at' => $appointment->appointment_date,
                'updated_at' => $appointment->appointment_date
            ]);

            // Update client total spent
            $client = $appointment->client;
            $client->total_spent += $appointment->final_amount;
            $client->save();
        }
    }
}