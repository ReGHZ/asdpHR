<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanCuti extends Model
{
    use HasFactory;

    protected $fillable = [
        'usercuti_id',
        'jenis_cuti',
        'lama_hari',
        'tanggal_mulai',
        'tanggal_surat',
        'nomor_surat',
        'keterangan',
        'status',
    ];

    public function usercuti()
    {
        return $this->belongsTo(User::class, 'usercuti_id', 'id');
    }
}
