<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('rooms')->insert([
            [
                'room_number' => '101',
                'type' => 'standar',
                'capacity' => 2,
                'price_per_night' => 300000.00,
                'status' => 'tersedia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'room_number' => '102',
                'type' => 'deluxe',
                'capacity' => 3,
                'price_per_night' => 500000.00,
                'status' => 'dipesan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'room_number' => '103',
                'type' => 'suite',
                'capacity' => 4,
                'price_per_night' => 750000.00,
                'status' => 'dibersihkan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'room_number' => '104',
                'type' => 'standar',
                'capacity' => 2,
                'price_per_night' => 300000.00,
                'status' => 'perawatan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
