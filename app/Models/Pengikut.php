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
    public function perjalananDinas()
    {
        return $this->belongsTo(PerjalananDinas::class);
    }
}
