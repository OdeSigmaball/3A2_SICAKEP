<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $guarded = ['id'];

    protected $primaryKey ='id_kategori';


    use HasFactory;
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori'); // Sesuaikan nama foreign key jika berbeda
    }
}
