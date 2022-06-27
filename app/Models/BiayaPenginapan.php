<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BiayaPenginapan extends Model
{
    use HasFactory;
    protected $fillable = [
        'perjalanan_dinas_id',
        'jumlah',
        'biaya',
        'total',
    ];

    public function perjalananDinas()
    {
        return $this->belongsTo(PerjalananDinas::class);
    }
}
