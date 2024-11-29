<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'first_name' => 'Admin',
                'last_name' => 'Admin',
                'email' => 'admin@gmail.com',
                'phone' => null,
                'gender' => 'male',
                'date' => null,
                'password' => Hash::make('password'),
                'role' => 'admin'
            ],
            [
                'first_name' => 'User',
                'last_name' => 'User',
                'email' => 'user@gmail.com',
                'phone' => '089511223344',
                'gender' => 'male',
                'date' => null,
                'password' => Hash::make('password'),
                'role' => 'user'
            ],
            [
                'first_name' => 'User2',
                'last_name' => 'User2',
                'email' => 'user2@gmail.com',
                'phone' => '089511223345',
                'gender' => 'female',
                'date' => null,
                'password' => Hash::make('password'),
                'role' => 'user'
            ],

        ];

        foreach ($users as $userData) {
            $user = User::create([
                'first_name' => $userData['first_name'],
                'last_name' => $userData['last_name'],
                'email' => $userData['email'],
                'phone' => $userData['phone'],
                'gender' => $userData['gender'],
                'date' => $userData['date'],
                'password' => $userData['password'],
            ]);

            // Assign role if Spatie Laravel Permission is used
            if (isset($userData['role'])) {
                $user->assignRole($userData['role']);
            }
        }
    }
}