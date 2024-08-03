<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'deskripsi',
        'tgl_mulai',
        'tgl_selesai',
        'tags', // ini agenda dosen atau mahasiswa atau kampus
        'lokasi',
        'penyelenggara',
        'admin_id'
    ];

    public function admin()
    {
        return $this->belongsTo(User::class);
    }
}
