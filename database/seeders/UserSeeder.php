<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Akun Mahasiswa
        User::create([
            'name' => 'Ahmad Mahasiswa',
            'identifier' => '2021001',
            'password' => Hash::make('password123'),
            'role' => 'student',
            'department' => 'Teknik Informatika',
        ]);

        // Akun Satpam
        User::create([
            'name' => 'Bapak Satpam',
            'identifier' => 'SATPAM001',
            'password' => Hash::make('password123'),
            'role' => 'guard',
            'department' => 'Keamanan Kampus',
        ]);

        // Akun Admin (untuk login dashboard web)
        User::create([
            'name' => 'Administrator',
            'identifier' => 'admin',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'department' => null,
        ]);
    }
}