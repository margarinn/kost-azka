<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\GaleriController;
use App\Models\Kamar;
use App\Http\Controllers\PublicKamarController;
use App\Models\Galeri;

Route::get('/', function () {
    // load latest gallery photos for the landing page carousel
    $fotos = Galeri::latest()->take(6)->get();
    return view('landing_page.landing', compact('fotos'));
});

Route::get('/admin/dashboard', function () {
    $totalKamar = Kamar::count();
    $kamarTerisi = Kamar::where('status', 'Terisi')->count();
    $kamarKosong = Kamar::where('status', 'Kosong')->count();
    $kamarPerbaikan = Kamar::where('status', 'Perbaikan')->count();
    $daftarKamarKosong = Kamar::where('status', 'Kosong')->orderBy('nomor_kamar', 'asc')->get();

    return view('dashboard', compact(
        'totalKamar',
        'kamarTerisi',
        'kamarKosong',
        'kamarPerbaikan',
        'daftarKamarKosong'
    ));

})->middleware(['auth', 'verified'])->name('admin.dashboard');

Route::name('admin.')->prefix('admin')->middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('kamar', KamarController::class);
    Route::resource('galeri', GaleriController::class);
});

Route::get('/tipekamar', [PublicKamarController::class, 'index'])->name('landing_page.tipekamar');
// Route::get('/tipe-kamar', function () {
//     // load latest gallery photos for the landing page carousel
//     $fotos = Galeri::latest()->take(6)->get();
//     return view('landing_page.tipekamar', compact('fotos'));
// });

require __DIR__.'/auth.php';
