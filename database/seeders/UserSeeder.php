<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'id' => Str::uuid(),
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'role' => 'admin',
            'password' => Hash::make('password'), // atau bcrypt('password')
            'no_telp' => '081234567890',
            'alamat' => 'Jl. Admin No.1',
            'nik' => '3201020405060001',
            'sertifikasi' => null, // admin tidak perlu sertifikasi
            'nama_sertifikasi' => null,
        ]);

        User::create([
            'id' => Str::uuid(),
            'name' => 'Peserta User',
            'email' => 'peserta@example.com',
            'email_verified_at' => now(),
            'role' => 'peserta',
            'password' => Hash::make('password'),
            'nik' => '3275011708980013',
            'no_telp' => '081234567891',
            'alamat' => 'Jl. Peserta No.2',
            'sertifikasi' => 'ya', // peserta wajib ada sertifikasi
            'nama_sertifikasi' => 'Scaffolding',
        ]);

        User::create([
            'id' => Str::uuid(),
            'name' => 'Umum User',
            'email' => 'umum@example.com',
            'email_verified_at' => now(),
            'role' => 'umum',
            'password' => Hash::make('password'),
            'nik' => '3275011778980013',
            'no_telp' => '081234567892',
            'alamat' => 'Jl. Umum No.3',
            'sertifikasi' => null, // umum tidak perlu sertifikasi
            'nama_sertifikasi' => null,
        ]);
    }
}
