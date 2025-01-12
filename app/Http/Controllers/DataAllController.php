<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Laporan;
use App\Models\Kategori;
use App\Models\Kegiatan;
use Illuminate\Http\Request;

class DataAllController extends Controller
{
    public function dataV(request $request)
    {
        $users = User::all();
        $laporans = Laporan::all();


        // Ambil nilai filter dari request
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');
        $tanggal = $request->input('tanggal');
        $bidang = $request->input('bidang');

        // Query awal untuk mengambil kegiatan
        $query = Kegiatan::query();

        // Tambahkan filter berdasarkan bulan
        if ($bulan) {
            $query->whereMonth('created_at', $bulan);
        }

        // Tambahkan filter berdasarkan tahun
        if ($tahun) {
            $query->whereYear('created_at', $tahun);
        }

        // Tambahkan filter berdasarkan tanggal
        if ($tanggal) {
            $query->whereDay('created_at', $tanggal);
        }

        // Tambahkan filter berdasarkan bidang
        if ($bidang) {
            $query->where('bidang', $bidang);
        }

        // Ambil data kegiatan yang difilter
        $kegiatan = $query->paginate(5);

        // Kirim data filter dan kegiatan ke view



        return view('bidang.datalaporanall', compact('users', 'laporans', 'kegiatan','bulan', 'tahun', 'tanggal', 'bidang'),  ['judul' => 'Data Laporan GTK']);
    }

    public function showlaporan($id)
    {
        $kegiatan = Kegiatan::with('laporan')->findOrFail($id);

        return view('bidang/datalaporanallshow', compact('kegiatan'),['judul' => 'Data Laporan GTK']);
    }
}
