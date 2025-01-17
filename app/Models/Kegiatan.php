<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_kegiatan';

    protected $fillable = ['nama_kegiatan','user_upload', 'lokasi_kegiatan', 'tanggal_kegiatan', 'bidang'];

    public function laporan()
{
    return $this->hasMany(Laporan::class, 'id_kegiatan');
}

}
