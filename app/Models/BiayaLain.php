<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BiayaLain extends Model
{
    use HasFactory;
    use \Znck\Eloquent\Traits\BelongsToThrough;

    protected $fillable = [
        //id
        'rab_id',
        //biaya lain
        'qty',
        'jenis',
        'biaya_lain',
    ];

    public function rab()
    {
        return $this->belongsTo(Rab::class);
    }
}
