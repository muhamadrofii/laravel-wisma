<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PenginapanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('penginapans')->insert([
            [
                // 'id' => 1,
                // 'nama' => 'BU KRIS',
                // 'alamat' => 'Jl. TERMINAL',
                'gambar_url' => 'https://res.cloudinary.com/dbctexmxa/image/upload/v1745839891/wisma/php9565_ggiygt.jpg',
            ],
            [
                // 'nama' => 'PAK RUDI',
                // 'alamat' => 'Jl. MERDEKA',
                'gambar_url' => 'https://ik.imagekit.io/eskopi/wisma/wisma/gambar_wisma.jpeg',
            ],
        ]);
    }
}
