<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konten extends Model
{
    use HasFactory;
    protected $fillable = [
        'judul',
        'deskripsi',
        'tgl_publish',
        'tags',
        'status',
        'lampiran',
        'admin_id',
        'jenis_id',
    ];

    public function admin()
    {
        return $this->hasMany(User::class);
    }
    public function jenis()
    {
        return $this->hasMany(Jenis_konten::class);
    }
}
