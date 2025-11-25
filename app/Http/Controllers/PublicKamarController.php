<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PublicKamarController extends Controller
{
    public function index()
    {
        // --- FUNGSI HELPER: MENGHITUNG DATA RIIL DARI DB ADMIN ---
        // Fungsi ini tidak membuat data baru, melainkan menghitung data yang sudah ada.
        $hitungKetersediaan = function($jenisMandi) {
            // 1. Cari tahu dulu gedung mana saja yang punya jenis kamar ini di database
            $semuaGedung = Kamar::where('jenis_kamar_mandi', $jenisMandi)
                                ->distinct()
                                ->pluck('gedung') // Mengambil data kolom 'gedung' riil
                                ->toArray();
            
            // 2. Hitung jumlah kamar yang statusnya 'Kosong' (tersedia) per gedung
            // Ini mengambil data status riil yang diinput admin
            $gedungKosong = Kamar::where('jenis_kamar_mandi', $jenisMandi)
                                 ->where('status', 'Kosong') 
                                 ->select('gedung', DB::raw('count(*) as total'))
                                 ->groupBy('gedung')
                                 ->pluck('total', 'gedung')
                                 ->toArray();

            // 3. Rapikan datanya agar siap ditampilkan
            $hasilAkhir = [];
            foreach ($semuaGedung as $gedung) {
                // Jika ada hitungan kosong, pakai data DB. Jika tidak ada, berarti 0.
                $hasilAkhir[$gedung] = $gedungKosong[$gedung] ?? 0;
            }
            ksort($hasilAkhir); // Urutkan nama gedung
            return $hasilAkhir;
        };

        // --- 1. SIAPKAN DATA RIIL TIPE PREMIUM (KM DALAM) ---
        // Variabel ini akan berisi array seperti: ['Gedung 1' => 3, 'Gedung 2' => 0]
        // Angka 3 dan 0 ini adalah data ASLI dari database.
        $ketersediaanDalam = $hitungKetersediaan('Dalam');

        // Ambil harga terendah riil dari DB
        $hargaDalamTerendah = Kamar::where('jenis_kamar_mandi', 'Dalam')
                                ->min('harga_sewa');

        // --- 2. SIAPKAN DATA RIIL TIPE STANDARD (KM LUAR) ---
        $ketersediaanLuar = $hitungKetersediaan('Luar');

        // Ambil harga terendah riil dari DB
        $hargaLuarTerendah = Kamar::where('jenis_kamar_mandi', 'Luar')
                                ->min('harga_sewa');


        // --- 3. FOTO GALERI (Data Riil dari Galeri Admin) ---
        $fotoDalam = Galeri::where('kategori', 'like', '%Dalam%')->pluck('foto_path')->toArray();
        $fotoLuar = Galeri::where('kategori', 'like', '%Luar%')->pluck('foto_path')->toArray();

        // Kirim semua data riil ini ke tampilan (view)
        return view('landing_page.tipekamar', compact(
            'ketersediaanDalam', 'hargaDalamTerendah', 'fotoDalam',
            'ketersediaanLuar', 'hargaLuarTerendah', 'fotoLuar'
        ));
    }
}