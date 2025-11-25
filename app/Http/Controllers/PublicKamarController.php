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
        // --- FUNGSI HELPER BARU: MENGHITUNG KETERSEDIAAN & HARGA PER GEDUNG ---
        $getDataPerGedung = function($jenisMandi) {
            // 1. Ambil semua gedung yang memiliki jenis kamar ini
            $semuaGedung = Kamar::where('jenis_kamar_mandi', $jenisMandi)
                                ->distinct()
                                ->pluck('gedung')
                                ->toArray();
            
            // 2. Hitung jumlah kamar KOSONG per gedung
            $gedungKosong = Kamar::where('jenis_kamar_mandi', $jenisMandi)
                                 ->where('status', 'Kosong') 
                                 ->select('gedung', DB::raw('count(*) as total'))
                                 ->groupBy('gedung')
                                 ->pluck('total', 'gedung')
                                 ->toArray();

            // 3. Ambil HARGA TERENDAH per gedung (tidak peduli statusnya kosong/terisi, yang penting ada kamarnya)
            $hargaPerGedung = Kamar::where('jenis_kamar_mandi', $jenisMandi)
                                   ->select('gedung', DB::raw('MIN(harga_sewa) as harga_min'))
                                   ->groupBy('gedung')
                                   ->pluck('harga_min', 'gedung')
                                   ->toArray();

            // 4. Gabungkan data menjadi struktur array baru
            $hasilAkhir = [];
            foreach ($semuaGedung as $gedung) {
                $hasilAkhir[$gedung] = [
                    // Jumlah kamar kosong (riil)
                    'tersedia' => $gedungKosong[$gedung] ?? 0, 
                    // Harga terendah di gedung tsb (riil)
                    'harga_mulai' => $hargaPerGedung[$gedung] ?? 0 
                ];
            }
            ksort($hasilAkhir); // Urutkan nama gedung
            return $hasilAkhir;
        };

        // --- 1. DATA RIIL TIPE PREMIUM (KM DALAM) ---
        // Variabel ini sekarang berisi array multidimensi (lihat contoh struktur di atas)
        $dataDalam = $getDataPerGedung('Dalam');

        // --- 2. DATA RIIL TIPE STANDARD (KM LUAR) ---
        $dataLuar = $getDataPerGedung('Luar');

        // --- 3. FOTO GALERI (Sama seperti sebelumnya) ---
        $fotoDalam = Galeri::where('kategori', 'like', '%Dalam%')->pluck('foto_path')->toArray();
        $fotoLuar = Galeri::where('kategori', 'like', '%Luar%')->pluck('foto_path')->toArray();

        // Kirim data yang sudah terstruktur baru ini ke view
        return view('landing_page.tipekamar', compact(
            'dataDalam', 'fotoDalam',
            'dataLuar', 'fotoLuar'
        ));
    }
}