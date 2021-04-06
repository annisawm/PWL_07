<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model; // Model Eloquent

class Mahasiswa extends Model // Definisi Model
{
    protected $table="mahasiswa"; //Eloquent akan membuat model mahasiswa, menyimpan record di tabel mahasiswas
    public $timestamps = false;
    protected $primaryKey = 'nim'; //Memanggil isi DB dg PK
    protected $fillable = [
        'nim',
        'nama',
        'kelas',
        'jurusan',
        'no_tlp',
    ];
}
