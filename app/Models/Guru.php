<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $table = 'guru'; // Nama tabel sesuai dengan migration
    protected $fillable = ['nama_guru', 'email','nip'];
    public function walikelas()
    {
        return $this->hasMany(Walikelas::class, 'guru_id');
    }
}
