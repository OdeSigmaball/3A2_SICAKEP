<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Laporan;
use App\Models\Kategori;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use illuminate\support\Facades\Log;
use App\Services\GoogleDriveService;
use Illuminate\Support\Facades\Auth;
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
        $kegiatans = Kegiatan::where('bidang', 'GTK')->get();
        $kategoris = Kategori::all();

        return view('bidang/datalaporangtk', compact('users', 'kegiatans', 'kategoris'), ['judul' => 'Data Laporan GTK']);
    }

    // public function paudV()
    // {
    //     $users = User::all();
    //     $kegiatans = Kegiatan::all();
    //     $kategoris = Kategori::all();

    //     return view('bidang/datalaporanpaud', compact('users', 'kegiatans', 'kategoris'), ['judul' => 'Data Laporan GTK']);
    // }
        public function paudV()
    {
        $users = User::all();
        $kegiatans = Kegiatan::where('bidang', 'PAUD')->get(); // Hanya kegiatan bidang PAUD
        $kategoris = Kategori::all();

        return view('bidang.datalaporanpaud', compact('users', 'kegiatans', 'kategoris'), ['judul' => 'Data Laporan PAUD']);
    }
        public function sdsmpV()
    {
        $users = User::all();
        $kegiatans = Kegiatan::where('bidang', operator: 'SD_SMP')->get(); // Hanya kegiatan bidang SD & SMP
        $kategoris = Kategori::all();

        return view('bidang.datalaporansdsmp', compact('users', 'kegiatans', 'kategoris'), ['judul' => 'Data Laporan SD & SMP']);
    }
        public function pubkomV()
    {
        $users = User::all();
        $kegiatans = Kegiatan::where('bidang', operator: 'PUBKOM')->get(); // Hanya kegiatan bidang SD & SMP
        $kategoris = Kategori::all();

        return view('bidang.datalaporanpubkom', compact('users', 'kegiatans', 'kategoris'), ['judul' => 'Data Laporan SD & SMP']);
    }
        public function sekdisV()
    {
        $users = User::all();
        $kegiatans = Kegiatan::where('bidang', operator: 'SEKDIS')->get(); // Hanya kegiatan bidang Sekretariat Dinas
        $kategoris = Kategori::all();

        return view('bidang.datalaporansekdis', compact('users', 'kegiatans', 'kategoris'), ['judul' => 'Data Laporan Sekretariat Dinas']);
    }


    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'nama_kegiatan' => 'required|string|max:255|unique:kegiatans',
    //         'tanggal_kegiatan' => 'required|date',
    //         'lokasi_kegiatan' => 'required|string|max:255',
    //         'bidang' => 'required|string|max:255',

    //     ]);

    //     $folderBidangMapping = [
    //         'GTK' => env('GOOGLE_DRIVE_FOLDER_GTK'),
    //         'PAUD' => env('GOOGLE_DRIVE_FOLDER_PAUD'),
    //         'PUBLIKASI' => env('GOOGLE_DRIVE_FOLDER_PUBLIKASI'),
    //         'SD_SMP' => env('GOOGLE_DRIVE_FOLDER_SD_SMP'),
    //     ];

    //     $parentFolderId = $folderBidangMapping[$request->bidang] ?? null;

    //     if (!$parentFolderId) {
    //         return redirect()->back()->withErrors(['error' => 'Bidang tidak valid atau folder induk tidak ditemukan.']);
    //     }

    //     try {
    //         $folder = $this->googleDriveService->createFolder($request->nama_kegiatan, $parentFolderId);
    //     } catch (\Exception $e) {
    //         return redirect()->back()->withErrors(['error' => 'Gagal membuat folder di Google Drive: ' . $e->getMessage()]);
    //     }


    //     Kegiatan::create([
    //         'nama_kegiatan' => $request->nama_kegiatan,
    //         'tanggal_kegiatan' => $request->tanggal_kegiatan,
    //         'lokasi_kegiatan' => $request->lokasi_kegiatan,
    //         'bidang' => $request->bidang,
    //         'user_upload' => Auth::user()->username,
    //         'linkgdrive' => $folder->id,

    //     ]);

    //     return redirect()->route('laporan.create')->with('success', 'Kegiatan berhasil ditambahkan.');
    // }
    public function store(Request $request)
{
    $request->validate([
        'nama_kegiatan' => 'required|string|max:255|unique:kegiatans',
        'tanggal_kegiatan' => 'required|date',
        'lokasi_kegiatan' => 'required|string|max:255',
        'bidang' => 'required|string|max:255',
    ]);

    $folderBidangMapping = [
        'GTK' => env('GOOGLE_DRIVE_FOLDER_GTK'),
        'PAUD' => env('GOOGLE_DRIVE_FOLDER_PAUD'),
        'PUBKOM' => env('GOOGLE_DRIVE_FOLDER_PUBKOM'),
        'SEKDIS' => env('GOOGLE_DRIVE_FOLDER_SEKDIS'),
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
        'user_upload' => Auth::user()->username,
        'linkgdrive' => $folder->id,
    ]);

    switch ($request->bidang) {
        case 'GTK':
            return redirect()->route('datalaporangtk.index')->with('success', 'Kegiatan berhasil ditambahkan.');
        case 'PAUD':
            return redirect()->route('datalaporanpaud.index')->with('success', 'Kegiatan berhasil ditambahkan.');
        case 'SEKDIS':
            return redirect()->route('datalaporansekdis.index')->with('success', 'Kegiatan berhasil ditambahkan.');
        case 'SD_SMP':
            return redirect()->route('datalaporansdsmp.index')->with('success', 'Kegiatan berhasil ditambahkan.');
        case 'PUBKOM':
            return redirect()->route('datalaporanpubkom.index')->with('success', 'Kegiatan berhasil ditambahkan.');
        default:
            return redirect()->back()->withErrors(['error' => 'Bidang tidak valid.']);
    }
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
            'user_upload' => Auth::user()->username,
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

     public function deleteFolderByName($folderName,Request $request)
             {

        try {


            // Cari folder berdasarkan nama
            $folders = $this->googleDriveService->listFiles([
                'q' => "mimeType='application/vnd.google-apps.folder' and name='$folderName' and trashed=false",
                'fields' => 'files(id, name)',
            ]);

            // Jika folder ditemukan
            if (count($folders->getFiles()) > 0) {
                $folderId = $folders->getFiles()[0]->id;

                // Hapus folder berdasarkan ID
                $this->googleDriveService->deleteFile($folderId);

                DB::table('kegiatans')->where('nama_kegiatan', $folderName)->delete();

                $bidang = $request->input(key: 'bidang');
                 switch ($bidang) {
                    case 'GTK':
                        return redirect()->route('datalaporangtk.index')->with('success', 'Kegiatan Berhasil Dihapus.');
                    case 'PAUD':
                        return redirect()->route('datalaporanpaud.index')->with('success', 'Kegiatan Berhasil Dihapus.');
                    case 'PUBKOM':
                        return redirect()->route('datalaporanpubkom.index')->with('success', 'Kegiatan Berhasil Dihapus.');
                    case 'SD_SMP':
                        return redirect()->route('datalaporansdsmp.index')->with('success', 'Kegiatan Berhasil Dihapus.');
                    case 'SEKRE':
                        return redirect()->route('datalaporansekdis.index')->with('success', 'Kegiatan Berhasil Dihapus.');
                    default:
                        return redirect()->back()->withErrors(['error' => 'Bidang tidak valid.']);
                }
            }




            // Jika folder tidak ditemukan

        } catch (\Exception $e) {
            throw new \Exception("Gagal menghapus folder: " . $e->getMessage());
        }


    }
            //     public function deleteFolderByName($folderName)
            //     {

            // try {


            //    // Cari folder berdasarkan nama
            //    $folders = $this->googleDriveService->listFiles([
            //        'q' => "mimeType='application/vnd.google-apps.folder' and name='$folderName' and trashed=false",
            //        'fields' => 'files(id, name)',
            //    ]);

            //    // Jika folder ditemukan
            //    if (count($folders->getFiles()) > 0) {
            //        $folderId = $folders->getFiles()[0]->id;

            //        // Hapus folder berdasarkan ID
            //        $this->googleDriveService->deleteFile($folderId);


            //        return true; // Berhasil dihapus
            //    }

            //    // Jika folder tidak ditemukan
            //    throw new \Exception("Folder dengan nama '$folderName' tidak ditemukan.");
            // } catch (\Exception $e) {
            //    throw new \Exception("Gagal menghapus folder: " . $e->getMessage());
            // }


            // }





}
