<?php
// database/seeders/EmployeeServiceSeeder.php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeServiceSeeder extends Seeder
{
    public function run(): void
    {
        // Get all employees and services
        $employees = Employee::all();
        $services = Service::all();

        // Assign services to employees
        $assignments = [
            1 => [1, 2, 3, 8], // John Smith: Haircut, Beard Trim, Hair Wash, Head Massage
            2 => [1, 4, 5, 6, 7], // Sarah Johnson: Haircut, Hair Color, Facial, Manicure, Pedicure
            3 => [1, 2, 3, 8, 10], // Michael Brown: Haircut, Beard Trim, Hair Wash, Head Massage, Hair Straightening
            4 => [4, 5, 6, 7, 9], // Emily Davis: Hair Color, Facial, Manicure, Pedicure, Waxing
            5 => [1, 2, 3, 8], // David Wilson: Haircut, Beard Trim, Hair Wash, Head Massage
        ];

        foreach ($assignments as $employeeId => $serviceIds) {
            foreach ($serviceIds as $serviceId) {
                DB::table('employee_services')->insert([
                    'employee_id' => $employeeId,
                    'service_id' => $serviceId,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
    }
}