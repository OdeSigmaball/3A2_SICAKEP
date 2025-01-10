<?php

namespace App\Http\Controllers;

use illuminate\support\Facades\Log;
use App\Models\User;
use App\Models\Laporan;
use App\Models\Kategori;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use App\Services\GoogleDriveService;
use Illuminate\Support\Facades\Storage;

class KegiatanController extends Controller
{
    private $googleDriveService;

    public function __construct(GoogleDriveService $googleDriveService)
    {
        $this->googleDriveService = $googleDriveService;
    }

    public function index()
    {
        $users = User::all();
        $kegiatans = Kegiatan::all();
        $kategoris = Kategori::all();

        return view('bidang/datalaporangtk', compact('users', 'kegiatans', 'kategoris'), ['judul' => 'Data Laporan GTK']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'tanggal_kegiatan' => 'required|date',
            'lokasi_kegiatan' => 'required|string|max:255',
            'bidang' => 'required|string|max:255',
        ]);

        $folderBidangMapping = [
            'GTK' => env('GOOGLE_DRIVE_FOLDER_GTK'),
            'PAUD' => env('GOOGLE_DRIVE_FOLDER_PAUD'),
            'PUBLIKASI' => env('GOOGLE_DRIVE_FOLDER_PUBLIKASI'),
            'SD_SMP' => env('GOOGLE_DRIVE_FOLDER_SD_SMP'),
        ];

        $parentFolderId = $folderBidangMapping[$request->bidang] ?? null;

        if (!$parentFolderId) {
            return redirect()->back()->withErrors(['error' => 'Bidang tidak valid atau folder induk tidak ditemukan.']);
        }

        try {
            $folder = $this->googleDriveService->createFolder($request->nama_kegiatan, $parentFolderId);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Gagal membuat folder di Google Drive: ' . $e->getMessage()]);
        }


        Kegiatan::create([
            'nama_kegiatan' => $request->nama_kegiatan,
            'tanggal_kegiatan' => $request->tanggal_kegiatan,
            'lokasi_kegiatan' => $request->lokasi_kegiatan,
            'bidang' => $request->bidang,
            'linkdrive' => $folder->id,
        ]);

        return redirect()->route('laporan.create')->with('success', 'Kegiatan berhasil ditambahkan.');
    }

    public function uploadFile(Request $request, Kegiatan $kegiatan)
    {
        $validated = $request->validate([
            'nama_laporan' => 'required|string|max:255',
            'dokumen' => 'required|file|mimes:pdf,doc,docx',
        ]);

        $file = $request->file('dokumen');
        $filePath = "{$kegiatan->nama_kegiatan}/" . $file->getClientOriginalName();
        $uploadedPath = Storage::disk('google')->put($filePath, file_get_contents($file));

        $laporan = Laporan::create([
            'nama_laporan' => $validated['nama_laporan'],
            'dokumen' => $uploadedPath,
            'id_kegiatan' => $kegiatan->id_kegiatan,
            'id_user' => auth()->id(),
            'id_kategori' => $request->input('id_kategori'), // Pastikan id_kategori ada di form
        ]);

        return redirect()->back()->with('success', 'Laporan berhasil diunggah!');
    }

    // public function deleteKegiatan(string $id)
    // {
    //     $kegiatan = Kegiatan::find($id);

    //     if (!$kegiatan) {
    //         return redirect()->back()->withErrors(['error' => 'Kegiatan tidak ditemukan.']);
    //     }

    //     try {
    //         $this->googleDriveService->deleteFile($kegiatan->linkdrive);
    //     } catch (\Exception $e) {
    //         return redirect()->back()->withErrors(['error' => 'Gagal menghapus folder dari Google Drive: ' . $e->getMessage()]);
    //     }

    //     $kegiatan->delete();

    //     return redirect('bidang/datalaporangtk')->with('success', 'Data berhasil dihapus.');
    // }







}
