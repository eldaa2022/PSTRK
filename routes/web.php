<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\EnsureTokenIsValid;

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

Route::get('/', function () {
    return view('admin.login.login');
})->name('login');
Route::get('/register', function () {
    return view('admin.login.register');
})->name('register');


Route::get('/user', [App\Http\Controllers\UserController::class, 'index']);
Route::get('/logout', [App\Http\Controllers\UserController::class, 'destroy']);


//pengunjung->
Route::get('/pengunjung', [App\Http\Controllers\DashboardController::class, 'pengunjung']);
Route::get('/akreditasiPengunjung', [App\Http\Controllers\KontenController::class, 'akreditasiPengunjung']);
Route::get('/fasilitasPengunjung', [App\Http\Controllers\KontenController::class, 'fasilitasPengunjung']);
Route::get('/kurikulumPengunjung', [App\Http\Controllers\KurikulumController::class, 'kurikulumPengunjung']);
Route::get('/faqPengunjung', [App\Http\Controllers\FaqController::class, 'faqPengunjung']);
Route::get('/profilPengunjung', [App\Http\Controllers\KontenController::class, 'profilPengunjung']);
Route::get('/prestasiDosen', [App\Http\Controllers\KontenController::class, 'prestasiDosen']);
Route::get('/prestasiMhs', [App\Http\Controllers\KontenController::class, 'prestasiMhs']);
Route::get('/beritaDosen', [App\Http\Controllers\KontenController::class, 'beritaDosen']);
Route::get('/beritaMhs', [App\Http\Controllers\KontenController::class, 'beritaMhs']);
Route::get('/kegiatanDosen', [App\Http\Controllers\KontenController::class, 'kegiatanDosen']);
Route::get('/kegiatanMhs', [App\Http\Controllers\KontenController::class, 'kegiatanMhs']);
Route::get('/fotoPengunjung', [App\Http\Controllers\KontenController::class, 'fotoPengunjung']);
Route::get('/videoPengunjung', [App\Http\Controllers\KontenController::class, 'videoPengunjung']);
Route::get('/dosenPengunjung', [App\Http\Controllers\DosenController::class, 'dosenPengunjung']);
Route::get('/alumniPengunjung', [App\Http\Controllers\AlumniController::class, 'alumniPengunjung']);
Route::get('/pesanPengunjung', [App\Http\Controllers\PesanController::class, 'pesanPengunjung']);
Route::get('/himaPengunjung', [App\Http\Controllers\HimaController::class, 'himaPengunjung']);

Route::get('/detail-berita/{id}', [App\Http\Controllers\KontenController::class, 'beritaDetail'])->name('detail-berita');
Route::get('/detail-prestasi/{id}', [App\Http\Controllers\KontenController::class, 'prestasiDetail'])->name('detail-prestasi');
Route::get('/detail-kegiatan/{id}', [App\Http\Controllers\KontenController::class, 'kegiatanDetail'])->name('detail-kegiatan');




//admin->
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index']);
    Route::get('/dashboard/search', [App\Http\Controllers\DashboardController::class, 'search']);

    Route::get('/dosen', [App\Http\Controllers\DosenController::class, 'index']);
    Route::get('/arsipdosen', [App\Http\Controllers\DosenController::class, 'arsip']);
    Route::get('/dosen/search', [App\Http\Controllers\DosenController::class, 'search']);

    Route::get('/kurikulum', [App\Http\Controllers\KurikulumController::class, 'index']);
    Route::get('/kurikulum/search', [App\Http\Controllers\KurikulumController::class, 'search']);

    Route::get('/agenda', [App\Http\Controllers\AgendaController::class, 'index']);
    Route::get('/agenda/search', [App\Http\Controllers\AgendaController::class, 'search']);

    Route::get('/kontak', [App\Http\Controllers\KontakController::class, 'index']);
    Route::get('/kontak/search', [App\Http\Controllers\KontakController::class, 'search']);

    Route::get('/pesan', [App\Http\Controllers\PesanController::class, 'index']);
    Route::get('/pesan/search', [App\Http\Controllers\PesanController::class, 'search']);
     // web.php
     Route::get('/count-new-messages', [App\Http\Controllers\PesanController::class, 'countNewMessages']);


    Route::get('/faq', [App\Http\Controllers\FaqController::class, 'index']);
    Route::get('/faq/search', [App\Http\Controllers\FaqController::class, 'search']);

    Route::get('/kabinet', [App\Http\Controllers\KabinetController::class, 'index']);
    Route::get('/kabinet/search', [App\Http\Controllers\KabinetController::class, 'search']);

    Route::get('/hima', [App\Http\Controllers\HimaController::class, 'index']);
    Route::get('/hima/search', [App\Http\Controllers\HimaController::class, 'search']);

    Route::get('/jenis_konten', [App\Http\Controllers\JenisKontenController::class, 'index']);
    Route::get('/jenis_konten/search', [App\Http\Controllers\JenisKontenController::class, 'search']);

    Route::get('/prestasi', [App\Http\Controllers\KontenController::class, 'index']);
    Route::get('/prestasi/search', [App\Http\Controllers\KontenController::class, 'search']);

    Route::get('/berita', [App\Http\Controllers\KontenController::class, 'berita']);
    Route::get('/berita/search', [App\Http\Controllers\KontenController::class, 'search']);

    Route::get('/prestasi', [App\Http\Controllers\KontenController::class, 'prestasi']);
    Route::get('/prestasi/search', [App\Http\Controllers\KontenController::class, 'prestasi']);

    Route::get('/kegiatan', [App\Http\Controllers\KontenController::class, 'kegiatan']);
    Route::get('/kegiatan/search', [App\Http\Controllers\KontenController::class, 'search']);

    Route::get('/akreditasi', [App\Http\Controllers\KontenController::class, 'akreditasi']);
    Route::get('/akreditasi/search', [App\Http\Controllers\KontenController::class, 'search']);

    Route::get('/fasilitas', [App\Http\Controllers\KontenController::class, 'fasilitas']);
    Route::get('/fasilitas/search', [App\Http\Controllers\KontenController::class, 'search']);

    Route::get('/profil', [App\Http\Controllers\KontenController::class, 'profil']);
    Route::get('/profil/search', [App\Http\Controllers\KontenController::class, 'search']);

    Route::get('/photo', [App\Http\Controllers\KontenController::class, 'photo']);
    Route::get('/photo/search', [App\Http\Controllers\KontenController::class, 'search']);

    Route::get('/video', [App\Http\Controllers\KontenController::class, 'video']);
    Route::get('/video/search', [App\Http\Controllers\KontenController::class, 'search']);

    Route::get('/alumni', [App\Http\Controllers\AlumniController::class, 'index']);
    Route::get('/alumni/search', [App\Http\Controllers\AlumniController::class, 'index']);

    Route::get('/arsipkonten', [App\Http\Controllers\KontenController::class, 'arsip']);
    Route::get('/arsipkonten/search', [App\Http\Controllers\KontenController::class, 'search']);



});



