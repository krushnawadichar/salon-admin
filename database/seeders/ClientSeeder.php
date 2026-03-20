<?php
// database/seeders/ClientSeeder.php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    public function run(): void
    {
        $clients = [
            [
                'name' => 'Robert Johnson',
                'email' => 'robert.j@email.com',
                'phone' => '555-0101',
                'address' => '123 Main St, Apt 4B',
                'date_of_birth' => '1985-03-15',
                'gender' => 'male',
                'notes' => 'Prefers appointments in the morning',
                'total_visits' => 12,
                'total_spent' => 450.00,
                'status' => 'active'
            ],
            [
                'name' => 'Maria Garcia',
                'email' => 'maria.g@email.com',
                'phone' => '555-0102',
                'address' => '456 Oak Ave',
                'date_of_birth' => '1990-07-22',
                'gender' => 'female',
                'notes' => 'Allergic to certain hair products',
                'total_visits' => 8,
                'total_spent' => 320.00,
                'status' => 'active'
            ],
            [
                'name' => 'James Williams',
                'email' => 'james.w@email.com',
                'phone' => '555-0103',
                'address' => '789 Pine Rd',
                'date_of_birth' => '1978-11-30',
                'gender' => 'male',
                'notes' => 'Regular customer, likes the same stylist',
                'total_visits' => 25,
                'total_spent' => 875.00,
                'status' => 'active'
            ],
            [
                'name' => 'Patricia Brown',
                'email' => 'patricia.b@email.com',
                'phone' => '555-0104',
                'address' => '321 Elm St',
                'date_of_birth' => '1982-09-18',
                'gender' => 'female',
                'notes' => 'Prefers weekends only',
                'total_visits' => 15,
                'total_spent' => 680.00,
                'status' => 'active'
            ],
            [
                'name' => 'Michael Davis',
                'email' => 'michael.d@email.com',
                'phone' => '555-0105',
                'address' => '654 Maple Ln',
                'date_of_birth' => '1995-05-05',
                'gender' => 'male',
                'notes' => 'Student, asks for discounts',
                'total_visits' => 6,
                'total_spent' => 150.00,
                'status' => 'active'
            ],
            [
                'name' => 'Jennifer Miller',
                'email' => 'jennifer.m@email.com',
                'phone' => '555-0106',
                'address' => '987 Cedar Blvd',
                'date_of_birth' => '1988-12-12',
                'gender' => 'female',
                'notes' => 'Bride-to-be, planning wedding services',
                'total_visits' => 3,
                'total_spent' => 210.00,
                'status' => 'active'
            ],
            [
                'name' => 'William Taylor',
                'email' => 'william.t@email.com',
                'phone' => '555-0107',
                'address' => '147 Birch Way',
                'date_of_birth' => '1970-04-25',
                'gender' => 'male',
                'notes' => 'Senior citizen discount applies',
                'total_visits' => 30,
                'total_spent' => 900.00,
                'status' => 'active'
            ],
            [
                'name' => 'Elizabeth Anderson',
                'email' => 'elizabeth.a@email.com',
                'phone' => '555-0108',
                'address' => '258 Spruce Ct',
                'date_of_birth' => '1992-08-08',
                'gender' => 'female',
                'notes' => 'Color specialist needed',
                'total_visits' => 10,
                'total_spent' => 550.00,
                'status' => 'active'
            ],
            [
                'name' => 'Thomas Martinez',
                'email' => 'thomas.m@email.com',
                'phone' => '555-0109',
                'address' => '369 Willow Dr',
                'date_of_birth' => '1980-01-20',
                'gender' => 'male',
                'notes' => 'Prefers the same barber every time',
                'total_visits' => 18,
                'total_spent' => 540.00,
                'status' => 'active'
            ],
            [
                'name' => 'Susan Robinson',
                'email' => 'susan.r@email.com',
                'phone' => '555-0110',
                'address' => '741 Ash Ave',
                'date_of_birth' => '1975-06-30',
                'gender' => 'female',
                'notes' => 'Comes with her daughter sometimes',
                'total_visits' => 22,
                'total_spent' => 880.00,
                'status' => 'active'
            ],
        ];

        foreach ($clients as $client) {
            Client::create($client);
        }
    }
}