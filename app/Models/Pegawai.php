<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'nik_ktp',
        'no_bpjs_kesehatan',
        'no_bpjs_ketenagakerjaan',
        'npwp',
        'status_keluarga',
        'pendidikan',
        'sk',
        'jurusan',
        'darat_laut_lokasi',
        'segmen',
        'gol_skala_tht',
        'skala_tht',
        'gol_phdp',
        'gol_skala_phdp',
        'gol_gaji',
        'gol_skala_gaji',
        'no_inhealth',
        'no_rek',
        'ukuran_sepatu',
        'ukuran_baju',
        'kuota_cuti',
    ];

    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
