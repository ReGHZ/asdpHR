<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TiketPerjalanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'perjalanan_dinas_id',
        'maskapai',
        'harga_tiket',
        'tempat_berangkat',
        'tempat_tujuan',
        'charge',
        'total',
    ];

    public function perjalananDinas()
    {
        return $this->belongsTo(PerjalananDinas::class);
    }
}
