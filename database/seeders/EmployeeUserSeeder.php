<?php
// database/seeders/EmployeeUserSeeder.php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Employee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EmployeeUserSeeder extends Seeder
{
    public function run(): void
    {
        // Create employee users with their employee records
        $employees = [
            [
                'user' => [
                    'name' => 'John Smith',
                    'email' => 'john@salon.com',
                    'password' => Hash::make('password'),
                    'role' => 'employee',
                    'phone' => '9876543210',
                    'address' => '123 Main St, New York, NY'
                ],
                'employee' => [
                    'employee_id' => 'EMP001',
                    'employment_type' => 'both',
                    'salary_amount' => 2000.00,
                    'commission_percentage' => 10.00,
                    'joining_date' => '2024-01-15',
                    'qualification' => 'Master Barber',
                    'experience_years' => 5,
                    'status' => 'active'
                ]
            ],
            [
                'user' => [
                    'name' => 'Sarah Johnson',
                    'email' => 'sarah@salon.com',
                    'password' => Hash::make('password'),
                    'role' => 'employee',
                    'phone' => '9876543211',
                    'address' => '456 Oak Ave, New York, NY'
                ],
                'employee' => [
                    'employee_id' => 'EMP002',
                    'employment_type' => 'commission',
                    'salary_amount' => null,
                    'commission_percentage' => 15.00,
                    'joining_date' => '2024-02-01',
                    'qualification' => 'Senior Stylist',
                    'experience_years' => 3,
                    'status' => 'active'
                ]
            ],
            [
                'user' => [
                    'name' => 'Michael Brown',
                    'email' => 'michael@salon.com',
                    'password' => Hash::make('password'),
                    'role' => 'employee',
                    'phone' => '9876543212',
                    'address' => '789 Pine St, New York, NY'
                ],
                'employee' => [
                    'employee_id' => 'EMP003',
                    'employment_type' => 'salary',
                    'salary_amount' => 2500.00,
                    'commission_percentage' => null,
                    'joining_date' => '2023-11-10',
                    'qualification' => 'Master Stylist',
                    'experience_years' => 7,
                    'status' => 'active'
                ]
            ],
            [
                'user' => [
                    'name' => 'Emily Davis',
                    'email' => 'emily@salon.com',
                    'password' => Hash::make('password'),
                    'role' => 'employee',
                    'phone' => '9876543213',
                    'address' => '321 Elm St, New York, NY'
                ],
                'employee' => [
                    'employee_id' => 'EMP004',
                    'employment_type' => 'commission',
                    'salary_amount' => null,
                    'commission_percentage' => 12.00,
                    'joining_date' => '2024-02-15',
                    'qualification' => 'Color Specialist',
                    'experience_years' => 4,
                    'status' => 'active'
                ]
            ],
            [
                'user' => [
                    'name' => 'David Wilson',
                    'email' => 'david@salon.com',
                    'password' => Hash::make('password'),
                    'role' => 'employee',
                    'phone' => '9876543214',
                    'address' => '654 Maple Dr, New York, NY'
                ],
                'employee' => [
                    'employee_id' => 'EMP005',
                    'employment_type' => 'both',
                    'salary_amount' => 1800.00,
                    'commission_percentage' => 8.00,
                    'joining_date' => '2024-03-01',
                    'qualification' => 'Barber',
                    'experience_years' => 2,
                    'status' => 'active'
                ]
            ],
        ];

        foreach ($employees as $empData) {
            $user = User::create($empData['user']);
            $empData['employee']['user_id'] = $user->id;
            Employee::create($empData['employee']);
        }
    }
}