<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BiayaLain extends Model
{
    use HasFactory;
    protected $fillable = [
        'perjalanan_dinas_id',
        'qty',
        'jenis',
        'biaya',
        'jumlah',
    ];

    public function perjalananDinas()
    {
        return $this->belongsTo(PerjalananDinas::class);
    }
}
