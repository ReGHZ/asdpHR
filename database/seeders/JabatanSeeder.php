<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Jabatan::truncate();

        $jabatan = [
            [
                'nama_jabatan' => 'MANAGER USAHA',
                'deskripsi' => 'Jabatan manager usaha',
            ],
            [
                'nama_jabatan' => 'STAF USAHA',
                'deskripsi' => 'Jabatan staf usaha',
            ],
            [
                'nama_jabatan' => 'MANAGER SDM & UMUM',
                'deskripsi' => 'Jabatan manager sdm dan umum',
            ],
            [
                'nama_jabatan' => 'STAF SDM & UMUM',
                'deskripsi' => 'Jabatan staf sdm dan umum',
            ],
            [
                'nama_jabatan' => 'MANAGER TEHNIK',
                'deskripsi' => 'Jabatan manager tehnik',
            ],
            [
                'nama_jabatan' => 'STAF TEHNIK',
                'deskripsi' => 'Jabatan staf tehnik',
            ],
            [
                'nama_jabatan' => 'MANAGER KEUANGAN',
                'deskripsi' => 'Jabatan manager keuangan',
            ],
            [
                'nama_jabatan' => 'STAF KEUANGAN',
                'deskripsi' => 'Jabatan staf keuangan',
            ],
            [
                'nama_jabatan' => 'GENERAL MANAGER',
                'deskripsi' => 'Jabatan general manager',
            ],
            [
                'nama_jabatan' => 'PENGENDALI DOKUMEN',
                'deskripsi' => 'Jabatan pengendali dokumen',
            ],
            [
                'nama_jabatan' => 'PENANGGUNG JAWAB IT',
                'deskripsi' => 'Jabatan penanggung jawab it',
            ],
            [
                'nama_jabatan' => 'KASIR',
                'deskripsi' => 'Jabatan kasir',
            ],
            [
                'nama_jabatan' => 'SUPERVISOR REGU 1 GILIMANUK',
                'deskripsi' => 'Jabatan supervisor regu 1 gilimanuk',
            ],
            [
                'nama_jabatan' => 'STAF REGU 1 GILIMANUK',
                'deskripsi' => 'Jabatan staf regu 1 gilimanuk',
            ],
            [
                'nama_jabatan' => 'SUPERVISOR REGU 2 GILIMANUK',
                'deskripsi' => 'Jabatan supervisor regu 2 gilimanuk',
            ],
            [
                'nama_jabatan' => 'STAF REGU 2 GILIMANUK',
                'deskripsi' => 'Jabatan staf regu 2 gilimanuk',
            ],
            [
                'nama_jabatan' => 'SUPERVISOR REGU 3 GILIMANUK',
                'deskripsi' => 'Jabatan supervisor regu 3 gilimanuk',
            ],
            [
                'nama_jabatan' => 'STAF REGU 3 GILIMANUK',
                'deskripsi' => 'Jabatan staf regu 3 gilimanuk',
            ],
            [
                'nama_jabatan' => 'SUPERVISOR REGU 1 KETAPANG',
                'deskripsi' => 'Jabatan supervisor regu 1 ketapang',
            ],
            [
                'nama_jabatan' => 'STAF REGU 1 KETAPANG',
                'deskripsi' => 'Jabatan staf regu 1 ketapang',
            ],
            [
                'nama_jabatan' => 'SUPERVISOR REGU 2 KETAPANG',
                'deskripsi' => 'Jabatan supervisor regu 2 ketapang',
            ],
            [
                'nama_jabatan' => 'STAF REGU 2 KETAPANG',
                'deskripsi' => 'Jabatan staf regu 2 ketapang',
            ],
            [
                'nama_jabatan' => 'SUPERVISOR REGU 3 KETAPANG',
                'deskripsi' => 'Jabatan supervisor regu 3 ketapang',
            ],
            [
                'nama_jabatan' => 'STAF REGU 3 KETAPANG',
                'deskripsi' => 'Jabatan staf regu 3 ketapang',
            ],
            [
                'nama_jabatan' => 'NAKHODA',
                'deskripsi' => 'Jabatan nakhoda',
            ],
            [
                'nama_jabatan' => 'KKM/MASINIS I',
                'deskripsi' => 'Jabatan kkm/masinis 1',
            ],
            [
                'nama_jabatan' => 'MASINIS I',
                'deskripsi' => 'Jabatan masinis 1',
            ],
            [
                'nama_jabatan' => 'MASINIS II',
                'deskripsi' => 'Jabatan masinis 2',
            ],
            [
                'nama_jabatan' => 'MASINIS III',
                'deskripsi' => 'Jabatan masinis 3',
            ],
            [
                'nama_jabatan' => 'MASINIS IV',
                'deskripsi' => 'Jabatan masinis 4',
            ],
            [
                'nama_jabatan' => 'MUALIM I',
                'deskripsi' => 'Jabatan mualim 1',
            ],
            [
                'nama_jabatan' => 'MUALIM II',
                'deskripsi' => 'Jabatan mualim 2',
            ],
            [
                'nama_jabatan' => 'MUALIM III',
                'deskripsi' => 'Jabatan mualim 3',
            ],
            [
                'nama_jabatan' => 'MUALIM IV',
                'deskripsi' => 'Jabatan mualim 4',
            ],
            [
                'nama_jabatan' => 'SERANG',
                'deskripsi' => 'Jabatan serang',
            ],
            [
                'nama_jabatan' => 'MANDOR MESIN',
                'deskripsi' => 'Jabatan mandor mesin',
            ],
            [
                'nama_jabatan' => 'JURU MUDI',
                'deskripsi' => 'Jabatan juru mudi',
            ],
            [
                'nama_jabatan' => 'JURU MINYAK',
                'deskripsi' => 'Jabatan juru minyak',
            ],
            [
                'nama_jabatan' => 'JURU MASAK',
                'deskripsi' => 'Jabatan juru masak',
            ],
            [
                'nama_jabatan' => 'KELASI',
                'deskripsi' => 'Jabatan kelasi',
            ],
            [
                'nama_jabatan' => 'STAF',
                'deskripsi' => 'Jabatan staf',
            ],
            [
                'nama_jabatan' => 'STRUKTURAL',
                'deskripsi' => 'Jabatan struktural',
            ],
            [
                'nama_jabatan' => 'FUNGSIONAL',
                'deskripsi' => 'Jabatan fungsional',
            ],
            [
                'nama_jabatan' => 'PERWIRA',
                'deskripsi' => 'Jabatan perwira',
            ],
            [
                'nama_jabatan' => 'ABK',
                'deskripsi' => 'Jabatan abk',
            ],
            [
                'nama_jabatan' => 'admin apl',
                'deskripsi' => 'Jabatan admin apl',
            ],
        ];

        Jabatan::insert($jabatan);
    }
}
