<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
class kartuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kartu__peminjamen')->insert([
            [
                'no_kartu' => '1010',
                'nama' => 'fara',
                'alamat' => 'jalan raya',
                'no_hp' => '123998483',
            ],
            [
                'no_kartu' => '2020',
                'nama' => 'rasya',
                'alamat' => 'jalan raya',
                'no_hp' => '402848208',
            ]
        ]);
    }
}
