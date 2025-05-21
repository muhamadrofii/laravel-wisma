<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DiklatParticipantSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('diklat_participants')->insert([
            [
                'user_id' => 1, // Pastikan user dengan ID ini ada
                'diklat_name' => 'Pelatihan Laravel Dasar',
                'institution' => 'PPSDM Teknologi',
                'start_date' => Carbon::parse('2025-01-10'),
                'end_date' => Carbon::parse('2025-01-15'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // [
            //     'user_id' => 2,
            //     'diklat_name' => 'Manajemen Proyek TI',
            //     'institution' => 'Kominfo Training Center',
            //     'start_date' => Carbon::parse('2025-02-01'),
            //     'end_date' => Carbon::parse('2025-02-05'),
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            // [
            //     'user_id' => 3,
            //     'diklat_name' => 'Pengantar Data Science',
            //     'institution' => 'BPSDM Informatika',
            //     'start_date' => Carbon::parse('2025-03-01'),
            //     'end_date' => Carbon::parse('2025-03-07'),
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
        ]);
    }
}
