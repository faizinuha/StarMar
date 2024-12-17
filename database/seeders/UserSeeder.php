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
                'first_name' => 'Cahaya',
                'last_name' => 'Putri',
                'email' => 'cahaya@gmail.com',
                'phone' => null,
                'gender' => 'male',
                'date' => null,
                'password' => Hash::make('password'),
                'role' => 'admin',
                'email_verified_at' => now(),  // Tanggal hari ini
            ],
            [
                'first_name' => 'putri',
                'last_name' => 'Melani',
                'email' => 'putri@gmail.com',
                'phone' => '089511223344',
                'gender' => 'male',
                'date' => null,
                'password' => Hash::make('password'),
                'role' => 'user',
                'email_verified_at' => now()->subDay(),  // Tanggal kemarin
            ],
            [
                'first_name' => 'saskia',
                'last_name' => 'Putri',
                'email' => 'saskia@gmail.com',
                'phone' => '089511223345',
                'gender' => 'female',
                'date' => null,
                'password' => Hash::make('password'),
                'role' => 'user',
                'email_verified_at' => now(),  // Tanggal hari ini
            ],
            [
                'first_name' => 'admin',
                'last_name' => 'admin',
                'email' => 'admin@gmail.com',
                'phone' => '089511223346',
                'gender' => 'female',
                'date' => null,
                'password' => Hash::make('password'),
                'role' => 'user',
                'email_verified_at' => now(),  // Tanggal hari ini
            ],
            [
                'first_name' => 'user',
                'last_name' => 'user',
                'email' => 'user@gmail.com',
                'phone' => '089511223347',
                'gender' => 'female',
                'date' => null,
                'password' => Hash::make('password'),
                'role' => 'user',
                'email_verified_at' => now(),  // Tanggal hari ini
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