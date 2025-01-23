<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceRecord extends Model
{
    use HasFactory;

    protected $fillable = ['siswa_id', 'semester', 'sakit', 'alpha', 'izin'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
