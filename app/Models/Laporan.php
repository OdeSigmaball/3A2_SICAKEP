<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    // Gunakan primary key custom jika tidak menggunakan 'id'
    protected $primaryKey = 'id_laporan';

    // Mass assignment: kolom yang diizinkan untuk diisi secara massal
    protected $fillable = [
        'nama_laporan',
        'dokumen',
        'file_name',
        'id_kegiatan',
        'user_upload',
        'id_media',
        'id_kategori'
    ];

    // Relasi ke model Kegiatan
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class, 'id_kegiatan');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    public function laporan()
    {
        return $this->hasMany(Laporan::class, 'id_kategori'); // Sesuaikan nama foreign key jika berbeda
    }
}
