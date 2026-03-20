<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->call([
            // First, create admin user (you already have this)
            AdminUserSeeder::class,
            
            // Create services
            ServiceSeeder::class,
            
            // Create employee users and their employee records
            EmployeeUserSeeder::class,
            
            // Create clients
            ClientSeeder::class,
            
            // Assign services to employees
            EmployeeServiceSeeder::class,
            
            // Create appointments
            AppointmentSeeder::class,
            
            // Create payments for completed appointments
            PaymentSeeder::class,
            
            // Create commissions based on appointments
            CommissionSeeder::class,
            
            // Create salary records
            SalarySeeder::class,
        ]);
    }
}
