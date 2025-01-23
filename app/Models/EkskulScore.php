<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EkskulScore extends Model
{
    use HasFactory;

    protected $fillable = ['siswa_id', 'ekskul_id', 'score', 'description','semester'];
    protected $table = 'ekskul_scores';
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function ekskul()
    {
        return $this->belongsTo(Ekskul::class);
    }
}
