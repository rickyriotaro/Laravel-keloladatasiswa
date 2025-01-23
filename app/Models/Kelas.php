<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $fillable = ['nama_kelas'];

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'kelas_id');
    }

    public function walikelas()
    {
        return $this->hasOne(Walikelas::class, 'kelas_id'); // Changed from hasMany to hasOne
    }

    public function kkm()
    {
        return $this->hasOne(Kkm::class);
    }
    public function pelajaran()
    {
        return $this->hasMany(Pelajaran::class, 'kelas_id', 'id'); // Adjust if pelajaran is directly linked to kelas
    }


}
