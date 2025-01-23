<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Pelajaran extends Model
{
    use HasFactory;
    protected $table = 'pelajaran'; // Nama tabel sesuai dengan migration
    protected $fillable = ['nama_pelajaran','guru_id','kelas_id'];
    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }
}
