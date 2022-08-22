<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersetujuanCuti extends Model
{
    use HasFactory;
    use \Znck\Eloquent\Traits\BelongsToThrough;

    protected $fillable = [
        'user_id',
        'pengajuan_cuti_id',
        'nomor_surat',
        'tanggal_surat',
        'keterangan',
        'tembusan',
        'alasan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function tembusan()
    {
        return $this->hasMany(Tembusan::class);
    }
    public function pengajuanCuti()
    {
        return $this->belongsTo(PengajuanCuti::class);
    }
}
