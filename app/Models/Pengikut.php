<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengikut extends Model
{
    use HasFactory;
    use \Znck\Eloquent\Traits\BelongsToThrough;

    protected $fillable = [
        'user_id',
        'perjalanan_dinas_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function perjalanan_dinas()
    {
        return $this->belongsTo(PerjalananDinas::class);
    }

    public function tiketPerjalanan()
    {
        return $this->HasManyThrough(TiketPerjalanan::class, PerjalananDinas::class);
    }

    public function biayaHarian()
    {
        return $this->hasManyThrough(BiayaHarian::class, PerjalananDinas::class);
    }

    public function biayaPenginapan()
    {
        return $this->hasManyThrough(BiayaPenginapan::class, PerjalananDinas::class);
    }

    public function biayaLain()
    {
        return $this->hasManyThrough(BiayaLain::class, PerjalananDinas::class);
    }
}
