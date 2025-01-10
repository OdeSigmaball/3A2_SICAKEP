<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GdriveController;
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

Route::get('bidang/datalaporanpaud',function(){
    return view('bidang/datalaporanpaud',['judul'=>'Data Laporan PAUD']);
});

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
    Route::get('/bidang/datalaporangtk', [KegiatanController::class, 'index'])->name('laporan.create');
    Route::post('/bidang/datalaporangtk/store', [KegiatanController::class, 'storedok'])->name('laporan.store');
    Route::post('/bidang/datalaporangtk', [KegiatanController::class, 'store'])->name('datalaporangtk.store');
    Route::post('bidang/datalaporangtk/{kegiatan}/upload', [KegiatanController::class, 'uploadFile'])->name('datalaporangtk.upload');
    // Route::post('bidang/datalaporangtk/hapus/{id_kegiatan}', [KegiatanController::class, 'deleteKegiatan'])->name('deleteKegiatan');

    Route::post('bidang/datalaporangtk/hapus/{id_kegiatan}', [KegiatanController::class, 'deleteKegiatan'])->name('deleteKegiatan');

});

Route::middleware(['auth'])->group(function () {
    Route::get('/laporan/create', [LaporanController::class, 'create'])->name('laporan.create');
    Route::post('/laporan/store', [LaporanController::class, 'storedok'])->name('laporan.store');

});

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

Route::get('upload',[GdriveController::class, 'upload']);










require __DIR__.'/auth.php';
