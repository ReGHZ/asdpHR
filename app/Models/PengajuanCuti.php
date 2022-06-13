<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanCuti extends Model
{
    use HasFactory;
    use \Znck\Eloquent\Traits\BelongsToThrough;

    protected $fillable = [
        'user_id',
        'jenis_cuti',
        'lama_hari',
        'tanggal_mulai',
        'tanggal_selesai',
        'tanggal_surat',
        'nomor_surat',
        'keterangan',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pegawai()
    {
        return $this->belongsToThrough(Pegawai::class, User::class);
    }

    public function jabatan()
    {
        return $this->belongsToThrough(Jabatan::class, User::class);
    }

    public function divisi()
    {
        return $this->belongsToThrough(Divisi::class, User::class);
    }
    public function persetujuanCuti()
    {
        return $this->hasOne(PersetujuanCuti::class);
    }
}
