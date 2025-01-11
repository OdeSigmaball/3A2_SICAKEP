<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Laporan;
use App\Models\Kategori;
use Illuminate\Http\Request;

class DataAllController extends Controller
{
    public function dataV()
    {
        $users = User::all();
        $laporans = Laporan::all();
        $kategoris = Kategori::all();

        return view('bidang.datalaporanall', compact('users', 'laporans', 'kategoris'), mergeData: ['judul' => 'Data Laporan GTK']);
    }
}
