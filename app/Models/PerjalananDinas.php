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
        'pengikut',
        'nomor_surat',
        'tanggal_surat',
        'perihal',
        'pembebanan_biaya',
        'tanggal_keberangkatan',
        'tanggal_kembali',
        'lama_hari',
        'keterangan',
        'jenis_kendaraan',
        'tujuan',
        'biaya_kas',
        'biaya_ybs',
        'disetujui_di',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pengikut()
    {
        return $this->belongsTo(User::class, 'pengikut', 'id',);
    }

    public function pegawai()
    {
        return $this->belongsToThrough(Pegawai::class, User::class);
    }

    public function tiketPerjalanan()
    {
        return $this->hasOne(TiketPerjalanan::class);
    }

    public function biayaHarian()
    {
        return $this->hasOne(BiayaHarian::class);
    }

    public function biayaPenginapan()
    {
        return $this->hasOne(BiayaPenginapan::class);
    }

    public function biayaLain()
    {
        return $this->hasOne(BiayaLain::class);
    }
}
