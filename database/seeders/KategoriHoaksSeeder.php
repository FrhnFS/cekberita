<?php

namespace Database\Seeders;

use App\Models\KategoriHoaks;
use Illuminate\Database\Seeder;

class KategoriHoaksSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            'Kesehatan',
            'Bencana',
            'Pemerintahan',
            'Pendidikan',
            'Ekonomi',
        ];

        foreach ($items as $nama) {
            KategoriHoaks::updateOrCreate(['nama' => $nama]);
        }
    }
}
