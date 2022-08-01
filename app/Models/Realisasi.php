<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Realisasi extends Model
{
    use HasFactory;
    use \Znck\Eloquent\Traits\BelongsToThrough;

    protected $fillable = [
        //id
        'rab_id',
        //tiket perjalanan dinas
        'maskapai',
        'harga_tiket',
        'tempat_berangkat',
        'tempat_tujuan',
        'charge',
        'jumlah_harga_tiket',
        //biaya harian
        'lama_hari',
        'biaya_harian',
        'jumlah_biaya_harian',
        //biaya penginapan
        'lama_hari_penginap',
        'biaya_penginapan',
        'jumlah_biaya_penginapan',
        //total
        'total',
        'jumlah_biaya_lain',
        //kas
        'biaya_kas',
        'biaya_ybs',
        'uang_muka',
        'tanggal_uang_muka',
    ];

    public function rab()
    {
        return $this->belongsTo(Rab::class);
    }

    public function realisasiBLain()
    {
        return $this->hasMany(RealisasiBLain::class);
    }
}
