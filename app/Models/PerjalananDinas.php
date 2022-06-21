<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerjalananDinas extends Model
{
    use HasFactory;
    use \Znck\Eloquent\Traits\BelongsToThrough;

    protected $fillable = [
        'user_id',
        'nomor_surat',
        'tanggal_surat',
        'perihal',
        'tanggal_keberangkatan',
        'tanggal_kembali',
        'keterangan',
        'jenis_kendaraan',
        'tujuan',
        'biaya_kas',
        'biaya_ybs',
        'disetujui_di',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pegawai()
    {
        return $this->belongsToThrough(Pegawai::class, User::class);
    }
}
