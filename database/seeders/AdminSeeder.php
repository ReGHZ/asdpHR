<?php

namespace Database\Seeders;

use App\Models\Divisi;
use App\Models\Jabatan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //calculate umur
        $tanggal_lahir = Carbon::parse('2000-01-01');
        $usia = $tanggal_lahir->age;

        //calculate masa kerja
        $tanggal_masuk_kerja = Carbon::parse('2000-01-01');
        $masa_kerja = $tanggal_masuk_kerja->diff(\Carbon\Carbon::now())->format('%y Tahun, %m Bulan');
        //calculate masa jabatan
        $tanggal_pilih_jabatan = Carbon::parse('2000-01-01');
        $masa_jabatan = $tanggal_pilih_jabatan->diff(\Carbon\Carbon::now())->format('%y Tahun, %m Bulan');

        $user = User::updateOrCreate(
            ['id' => 1], // cek berdasarkan id
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('123456'),
                'divisi_id' => 2,
                'jabatan_id' => 4,
                'nik' => '123',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '2000-01-01',
                'usia' => $usia,
                'jenis_kelamin' => 'Laki-laki',
                'no_hp' => '081234567890',
                'alamat' => 'Jl. Kebon Jeruk No. 1',
                'tanggal_masuk_kerja' => '2000-01-01',
                'masa_kerja' => $masa_kerja,
                'tanggal_pilih_jabatan' => '2000-01-01',
                'masa_jabatan' => $masa_jabatan,
            ]
        );

        if (!$user->pegawai) {
            $user->pegawai()->create(['user_id' => $user->id, 'kuota_cuti' => 100]);
        }

        $user->roles()->syncWithoutDetaching([1]);
    }
}
