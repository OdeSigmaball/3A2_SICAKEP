<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Laporan;
use App\Models\Kategori;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use App\Services\GoogleDriveService;
use Google\Service\CloudDebugger\Resource\Controller;

class LaporanController extends Controller
{
    private $googleDriveService;

    public function __construct(GoogleDriveService $googleDriveService)
    {
        $this->googleDriveService = $googleDriveService;
    }

    public function create()
    {
        $users = User::all();
        $kegiatans = Kegiatan::all();
        $kategoris = Kategori::all();

        return view('bidang.datalaporangtk', compact('users', 'kegiatans', 'kategoris'), ['judul' => 'Data Laporan GTK']);
    }

    public function storedok(Request $request)
{
    $request->validate([
        'id_user' => 'required|exists:users,id',
        'id_kegiatan' => 'required|exists:kegiatans,id_kegiatan',
        'id_kategori' => 'required|exists:kategoris,id_kategori',
        'nama_laporan' => 'required|string|max:255',
        'uploadFile' => 'required|file|mimes:pdf,doc,docx|max:10240',
    ]);

    $kegiatan = Kegiatan::findOrFail($request->id_kegiatan);

    try {
        // Gunakan folder kegiatan yang sudah ada
        $folderId = $this->getOrCreateFolder($kegiatan->nama_kegiatan);

        $file = $request->file('uploadFile');
        $uploadedFile = $this->googleDriveService->uploadFile($file, $folderId);

        // Simpan informasi laporan ke database
        Laporan::create([
            'id_user' => $request->id_user,
            'id_kegiatan' => $request->id_kegiatan,
            'id_kategori' => $request->id_kategori,
            'nama_laporan' => $request->nama_laporan,
            'dokumen' => $uploadedFile->id, // Simpan ID file dari Google Drive
        ]);

        return redirect()->route('laporan.create')->with('success', 'Laporan berhasil diunggah.');
    } catch (\Exception $e) {
        return redirect()->back()->withErrors(['error' => 'Gagal mengunggah file ke Google Drive: ' . $e->getMessage()]);
    }
}


    public function listFiles($idKegiatan)
    {
        $kegiatan = Kegiatan::find($idKegiatan);

        if (!$kegiatan) {
            return redirect()->back()->withErrors(['error' => 'Kegiatan tidak ditemukan.']);
        }

        try {
            $files = $this->googleDriveService->listFiles([
                'q' => "'{$kegiatan->linkdrive}' in parents and trashed=false",
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Gagal mengambil daftar file: ' . $e->getMessage()]);
        }

        return view('laporan.list', ['files' => $files->getFiles(), 'kegiatan' => $kegiatan]);
    }

    private function getOrCreateFolder($folderName)
{
    try {
        // Cari folder berdasarkan nama
        $folders = $this->googleDriveService->listFiles([
            'q' => "mimeType='application/vnd.google-apps.folder' and name='$folderName' and trashed=false",
            'fields' => 'files(id, name)',
        ]);

        // Jika folder ditemukan, gunakan ID folder yang sudah ada
        if (count($folders->getFiles()) > 0) {
            return $folders->getFiles()[0]->id;
        }

        // Jika folder tidak ditemukan, buat folder baru
        $createdFolder = $this->googleDriveService->createFolder($folderName);
        return $createdFolder->id;
    } catch (\Exception $e) {
        throw new \Exception("Gagal mendapatkan atau membuat folder: " . $e->getMessage());
    }
}


}
