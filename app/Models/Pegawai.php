<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'jabatan_id',
        'divisi_id',
        'nik',
        'tempat_lahir',
        'tanggal_lahir',
        'usia',
        'jenis_kelamin',
        'no_hp',
        'alamat',
        'tanggal_masuk_kerja',
        'masa_kerja',
        'tanggal_pilih_jabatan',
        'masa_jabatan',
    ];

    use HasFactory;
    public function divisi()
    {
        return $this->belongsTo(Divisi::class);
    }
    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function personal()
    {
        return $this->hasOne(Personal::class);
    }
}
