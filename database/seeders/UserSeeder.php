<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Manager;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Super Admin
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
                'role' => 'superadmin',
            ]
        );

        // Create Manager
        $managerUser = User::firstOrCreate(
            ['email' => 'manager@example.com'],
            [
                'name' => 'Ahmedabad Manager',
                'password' => Hash::make('password'),
                'role' => 'manager',
                'branch_id' => 1,
            ]
        );

        Manager::firstOrCreate(
            ['user_id' => $managerUser->id],
            [
                'name' => $managerUser->name,
                'email' => $managerUser->email,
                'phone_number' => '1234567890',
                'branch_id' => 1,
            ]
        );

        // Create Employee
        $employeeUser = User::firstOrCreate(
            ['email' => 'employee@example.com'],
            [
                'name' => 'Ahmedabad Employee',
                'password' => Hash::make('password'),
                'role' => 'employee',
                'branch_id' => 1,
            ]
        );

        Employee::firstOrCreate(
            ['user_id' => $employeeUser->id],
            [
                'name' => $employeeUser->name,
                'email' => $employeeUser->email,
                'phone_number' => '0987654321',
                'branch_id' => 1,
            ]
        );

        // Create Accounts
        User::firstOrCreate(
            ['email' => 'accounts@example.com'],
            [
                'name' => 'Accounts',
                'password' => Hash::make('password'),
                'role' => 'accounts',
                'branch_id' => 1,
            ]
        );
    }
}
