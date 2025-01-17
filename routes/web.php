<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GdriveController;
use App\Http\Controllers\DataAllController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\kategoriController;
use App\Http\Controllers\KegiatanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::get('bidang/datalaporanpaud',function(){
//     return view('bidang/datalaporanpaud',['judul'=>'Data Laporan PAUD']);
// });

Route::get('bidang/datalaporanpubkom',function(){
    return view('bidang/datalaporanpubkom',['judul'=>'Data Laporan PUBLIKASI DAN KOMUNIKASI']);
});

Route::get('bidang/datalaporansdsmp',function(){
    return view('bidang/datalaporansdsmp',['judul'=>'Data Laporan SD & SMP']);
});

Route::get('bidang/datalaporangtk',function(){
    return view('bidang/datalaporangtk',['judul'=>'Data Laporan GTK']);
});



Route::get('/',function(){
    return view('dashboard1',['judul'=>'Dashboard']);
})->middleware(['auth'])->name('dashboard');



Route::get('login',function(){
    return view('login',['judul'=>'Sign-In']);
})->name('login')->middleware('guest');

// Route::get('userdata',[UserController::class,'index'])->middleware(['auth']);
//user store
// Route::post('userdata',[UserController::class,'store'])->name('storeuser');
//user edit
// Route::get('edituser/{id}',[UserController::class,'editV'])->middleware('auth')->name('edituser');
//edit user
// Route::post('edituser/{id}',[UserController::class,'edit'])->name('updateuser');
//editpass defined
// Route::post('edituser/{id}',[UserController::class,'editpass'])->name('editpass');
//deleteuser defined
Route::post('edituser/{id}',[UserController::class,'deleteuser'])->name('deleteuser');

Route::middleware(['auth','bidang:admin'])->group(function () {
    Route::controller(UserController::class)->group(function() {
        Route::get('userdata', 'index');
        Route::post('store/user', 'store')->name('storeuser');
        Route::get('edit/user/{id}', 'editV' )->name('edituser');
        Route::post('update/user/{id}', 'edit')->name('updateuser');
        Route::post('update/pass/{id}', 'editpass')->name('updatepass');
        Route::post('delete/user/{id}', 'deleteuser')->name('deleteuser');
    })->middleware(['auth','bidang:admin']);


    Route::controller(KategoriController::class)->group(function(){
        Route::get('datakategori','index');
        Route::get('edit/kategori/{id_kategori}','editV')->name('editkategori');
        Route::post('store/kategori','store')->name('storekategori');
        Route::post('update/kategori{id_kategori}','edit')->name('editkategoris');
        Route::post('delete/kategori{id_kategori}','delete')->name('deletekategori');
    })->middleware('bidang:admin');
});

Route::middleware(['auth'])->group(function () {
    // Resource route untuk KegiatanController
    Route::get('/bidang/datalaporangtk', [KegiatanController::class, 'index'])->name('datalaporangtk.index');
    // Route::post('/bidang/datalaporangtk/store', [KegiatanController::class, 'storedok'])->name('laporan.store');
    Route::post('/bidang/datalaporangtk', [KegiatanController::class, 'store'])->name('datalaporangtk.store');
    Route::post('bidang/datalaporangtk/{kegiatan}/upload', [KegiatanController::class, 'uploadFile'])->name('datalaporangtk.upload');
    Route::post('bidang/datalaporangtk/hapus/{id_kegiatan}', [KegiatanController::class, 'deleteFolderByName'])->name('deleteFolderByName');

});

Route::middleware(['auth'])->group(function () {
    // Route untuk bidang PAUD
    Route::get('/bidang/datalaporanpaud', [KegiatanController::class, 'paudV'])->name('datalaporanpaud.index');
    Route::post('/bidang/datalaporanpaud', [KegiatanController::class, 'store'])->name('datalaporanpaud.store');
    Route::post('/bidang/datalaporanpaud/{kegiatan}/upload', 'KegiatanController@uploadFile')->name('datalaporanpaud.upload');
    Route::post('/bidang/datalaporanpaud/hapus/{id_kegiatan}', [KegiatanController::class, 'deleteFolderByName'])->name('datalaporanpaud.delete');
});
Route::middleware(['auth'])->group(function () {
    // Route untuk bidang SD & SMP
    Route::get('/bidang/datalaporansdsmp', [KegiatanController::class, 'sdsmpV'])->name('datalaporansdsmp.index');
    Route::post('/bidang/datalaporansdsmp/store', [KegiatanController::class, 'store'])->name('datalaporansdsmp.store');
    Route::post('/bidang/datalaporansdsmp/{kegiatan}/upload', [KegiatanController::class, 'uploadFile'])->name('datalaporansdsmp.upload');
    Route::post('/bidang/datalaporansdsmp/hapus/{id_kegiatan}', [KegiatanController::class, 'deleteFolderByName'])->name('datalaporansdsmp.delete');
});
Route::middleware(['auth'])->group(function () {
    // Route untuk bidang PUBLIKASI KOMUNIKASI
    Route::get('/bidang/datalaporanpubkom', [KegiatanController::class, 'pubkomV'])->name('datalaporanpubkom.index');
    Route::post('/bidang/datalaporanpubkom/store', [KegiatanController::class, 'store'])->name('datalaporanpubkom.store');
    Route::post('/bidang/datalaporanpubkom/{kegiatan}/upload', [KegiatanController::class, 'uploadFile'])->name('datalaporanpubkom.upload');
    Route::post('/bidang/datalaporanpubkom/hapus/{id_kegiatan}', [KegiatanController::class, 'deleteFolderByName'])->name('datalaporanpubkom.delete');
});
Route::middleware(['auth'])->group(function () {
    // Route untuk bidang Sekretariat Dinas
    Route::get('/bidang/datalaporansekdis', [KegiatanController::class, 'sekdisV'])->name('datalaporansekdis.index');
    Route::post('/bidang/datalaporansekdis/store', [KegiatanController::class, 'store'])->name('datalaporansekdis.store');
    Route::post('/bidang/datalaporansekdis/{kegiatan}/upload', [KegiatanController::class, 'uploadFile'])->name('datalaporansekdis.upload');
    Route::post('/bidang/datalaporansekdis/hapus/{id_kegiatan}', [KegiatanController::class, 'deleteFolderByName'])->name('datalaporansekdis.delete');
});
Route::middleware(['auth'])->group(function () {
    // Route untuk Data laporan
    Route::post('/bidang/datalaporansekdis/store', [KegiatanController::class, 'store'])->name('datalaporansekdis.store');
    Route::post('/bidang/datalaporansekdis/{kegiatan}/upload', [KegiatanController::class, 'uploadFile'])->name('datalaporansekdis.upload');
    Route::post('/bidang/datalaporansekdis/hapus/{id_kegiatan}', [KegiatanController::class, 'deleteFolderByName'])->name('datalaporansekdis.delete');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/laporan/create', [LaporanController::class, 'create'])->name('laporan.create');
    Route::post('/laporan/store', [LaporanController::class, 'storedok'])->name('laporan.store');

});

// Rute untuk mengunduh file laporan
// Route::get('/laporan/download/{id}', [LaporanController::class, 'downloadFile'])->name('downloadFile');

Route::middleware(['auth'])->group(function () {
    Route::get('/bidang/datalaporanall', [DataAllController::class, 'dataV'])->name('datalaporanall.index');
   // Route::post('/bidang/{id_kegiatan}/datalaporanallshow', [DataAllController::class, 'showlaporan'])->name('laporan.show');
   Route::post('/bidang/{id_kegiatan}/datalaporanallshow', [DataAllController::class, 'showlaporan'])->name('laporan.show');

    Route::any('/bidang/{laporan}/datalaporanallshow', [DataAllController::class, 'downloadFile'])->name('donlot');
    Route::post('/bidang/{id_laporan}/download', [DataAllController::class, 'downloadFile'])->name('laporan.download');
    Route::get('/bidang/download/{fileId}', [DataAllController::class, 'downloadFile'])->name('downloadFile');

});
// Route::get('/bidang/datalaporanpaud', [KegiatanController::class, 'paudV']);

// Route::middleware(['auth'])->group(function () {
//     // Resource route untuk KegiatanController
//     Route::get('/bidang/datalaporangtk', [KegiatanController::class, 'index'])->name('datalaporangtk.index');  // Mengganti nama route menjadi 'datalaporangtk.index'
//     Route::post('/bidang/datalaporangtk/store', [KegiatanController::class, 'storedok'])->name('datalaporangtk.store');
//     Route::post('/bidang/datalaporangtk', [KegiatanController::class, 'store'])->name('datalaporangtk.create'); // Mengganti nama route menjadi 'datalaporangtk.create'
//     Route::post('/bidang/datalaporangtk/{kegiatan}/upload', [KegiatanController::class, 'uploadFile'])->name('datalaporangtk.upload');
//     Route::post('/bidang/datalaporangtk/hapus/{id_kegiatan}', [KegiatanController::class, 'deleteKegiatan'])->name('datalaporangtk.delete');
// });

// Route::middleware(['auth'])->group(function () {
//     Route::get('/laporan/create', [LaporanController::class, 'create'])->name('laporan.create');
//     Route::post('/laporan/store', [LaporanController::class, 'storedok'])->name('laporan.store');
// });












require __DIR__.'/auth.php';
