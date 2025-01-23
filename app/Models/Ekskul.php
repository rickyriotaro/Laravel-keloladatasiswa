<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ekskul extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    protected $table = 'ekskul';
    public function scores()
    {
        return $this->hasMany(EkskulScore::class);
    }
}
