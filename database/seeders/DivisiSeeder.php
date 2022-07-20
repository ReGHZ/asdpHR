<?php

namespace Database\Seeders;

use App\Models\Divisi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DivisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Divisi::truncate();

        $divisi = [
            [
                'nama_divisi' => 'USAHA',
                'deskripsi' => 'Divisi usaha',
            ],
            [
                'nama_divisi' => 'SDM & UMUM',
                'deskripsi' => 'Divisi sdm dan umum',
            ],
            [
                'nama_divisi' => 'TEHNIK',
                'deskripsi' => 'Divisi tehnik',
            ],
            [
                'nama_divisi' => 'KEUANGAN',
                'deskripsi' => 'Divisi keuangan',
            ],
            [
                'nama_divisi' => 'GENERAL MANAGER',
                'deskripsi' => 'Divisi general manajer',
            ],
            [
                'nama_divisi' => 'PENGENDALI DOKUMEN',
                'deskripsi' => 'Divisi pengendali dokumen',
            ],
            [
                'nama_divisi' => 'PENANGGUNG JAWAB IT',
                'deskripsi' => 'Divisi penanggung jawab IT',
            ],
            [
                'nama_divisi' => 'REGU 1 GILIMANUK',
                'deskripsi' => 'Divisi regu 1 gilimanuk',
            ],
            [
                'nama_divisi' => 'REGU 2 GILIMANUK',
                'deskripsi' => 'Divisi regu 2 gilimanuk',
            ],
            [
                'nama_divisi' => 'REGU 3 GILIMANUK ',
                'deskripsi' => 'Divisi regu 3 gilimanuk',
            ],
            [
                'nama_divisi' => 'REGU 1 KETAPANG',
                'deskripsi' => 'Divisi 1 ketapang',
            ],
            [
                'nama_divisi' => 'REGU 2 KETAPANG',
                'deskripsi' => 'Divisi 2 ketapang',
            ],
            [
                'nama_divisi' => 'REGU 3 KETAPANG',
                'deskripsi' => 'Divisi 3 ketapang',
            ],
            [
                'nama_divisi' => 'KMP PRATHITA-IV',
                'deskripsi' => 'Divisi kmp prathita-iv',
            ],
        ];

        Divisi::insert($divisi);
    }
}
