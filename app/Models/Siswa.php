<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa'; // Nama tabel sesuai dengan migration
    protected $fillable = ['nama_siswa', 'nis', 'kelas_id'];

    // Relasi ke tabel kelas
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    // Relasi ke tabel nilai
    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'siswa_id');
    }
    public function attendanceRecords()
{
    return $this->hasMany(AttendanceRecord::class);
}
public function ekskulScores()
{
    return $this->hasMany(EkskulScore::class);
}
public function sikap()
{
    return $this->hasOne(Sikap::class, 'siswa_id');
}
public function nextKelas()
{
    return $this->belongsTo(Kelas::class, 'next_kelas_id');
}

}
