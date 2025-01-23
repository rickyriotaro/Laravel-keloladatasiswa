<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sikap extends Model
{
    use HasFactory;
    protected $table = 'sikap'; // Nama tabel sesuai dengan migration

    protected $fillable = ['siswa_id', 'spiritual', 'spiritual_desc', 'social', 'social_desc'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
