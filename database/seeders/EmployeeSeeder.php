<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Employee::updateOrCreate(
            ['email' => 'zia@gmail.com'],
            [
                'name' => 'Zia',
                'dob' => '1989-04-06',
                'department' => 'IT',
                'email' => 'zia@gmail.com',
                'gender' => 'male',
                'address' => 'pune',
            ]
        );
    }
}
