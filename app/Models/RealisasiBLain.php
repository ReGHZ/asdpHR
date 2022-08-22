<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RealisasiBLain extends Model
{
    use HasFactory;
    use \Znck\Eloquent\Traits\BelongsToThrough;

    protected $fillable = [
        //id
        'realisasi_id',
        //biaya lain
        'qty',
        'jenis',
        'biaya',
    ];

    public function realisasi()
    {
        return $this->belongsTo(Realisasi::class);
    }
}
