<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('bookings')->insert([
            [
                'user_id' => 1, // Gantilah sesuai ID user yang ada
                'room_id' => 1, // Gantilah sesuai ID kamar yang ada
                'check_in' => Carbon::now()->addDays(2), // Check-in 2 hari lagi
                'check_out' => Carbon::now()->addDays(5), // Check-out 5 hari setelah check-in
                'status' => 'dipesan',
                'total_price' => 900000.00, // Sesuaikan dengan harga total
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'room_id' => 2,
                'check_in' => Carbon::now()->addDays(1),
                'check_out' => Carbon::now()->addDays(3),
                'status' => 'check-in',
                'total_price' => 1500000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'room_id' => 3,
                'check_in' => Carbon::now()->addDays(3),
                'check_out' => Carbon::now()->addDays(6),
                'status' => 'check-out',
                'total_price' => 2250000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 4,
                'room_id' => 4,
                'check_in' => Carbon::now()->addDays(4),
                'check_out' => Carbon::now()->addDays(7),
                'status' => 'dibatalkan',
                'total_price' => 1200000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
