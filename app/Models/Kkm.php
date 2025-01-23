<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kkm extends Model
{
    use HasFactory;
    protected $table = 'kkm';
    protected $fillable = ['kelas_id', 'kkm_value'];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}
