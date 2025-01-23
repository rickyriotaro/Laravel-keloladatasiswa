<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Nilai extends Model
{
    use HasFactory;
    protected $table = 'nilai'; // Nama tabel sesuai dengan migration
    protected $fillable = ['siswa_id', 'pelajaran_id', 'nilai','semester','prediket','nilai_2','prediket_2','deskripsi'];
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    public function pelajaran()
    {
        return $this->belongsTo(Pelajaran::class, 'pelajaran_id');
    }
}
