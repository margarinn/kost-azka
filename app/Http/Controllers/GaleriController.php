<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class GaleriController extends Controller
{
    /**
     * Menampilkan semua foto di galeri.
     */
    public function index(Request $request)
    {

        $kategoris = Galeri::select('kategori')
                            ->whereNotNull('kategori')
                            ->where('kategori', '!=', '')
                            ->distinct()
                            ->pluck('kategori');


        $query = Galeri::query();

        if ($request->has('kategori') && $request->kategori) {
            $query->where('kategori', $request->kategori);
        }

        $fotos = $query->latest()->get();

        return view('galeri.index', compact('fotos', 'kategoris'));
    }

    /**
     * Menampilkan form untuk upload foto baru.
     */
    public function create()
    {
        return view('galeri.create');
    }

    /**
     * Menyimpan foto baru ke storage dan database.
     */
    public function store(Request $request)
    {
        // 1. Validasi file dan data
        $validatedData = $request->validate([
            // Validasi file: harus gambar, tipe tertentu, max 2MB (2048 KB)
            'foto' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'kategori' => 'nullable|string|max:255',
        ]);

        // 2. Simpan file ke storage
        // Ini akan menyimpan file di 'storage/app/public/galeri-kost'
        // dan mengembalikan path-nya, misal: "galeri-kost/namafile.jpg"
        $path = $request->file('foto')->store('galeri-kost', 'public');

        // 3. Buat data di database
        // Kita gabungkan path file dengan data kategori yang sudah divalidasi
        Galeri::create([
            'foto_path' => $path,
            'kategori'  => $validatedData['kategori'],
        ]);

        // 4. Redirect kembali dengan pesan sukses
        return redirect()->route('galeri.index')
                         ->with('success', 'Foto baru berhasil di-upload.');
    }

    /**
     * Menghapus foto dari storage dan database.
     */
   public function destroy(Galeri $galeri)
    {
        try {
            // Cek apakah foto_path ada dan file fisik memang ada di storage
            if ($galeri->foto_path && Storage::disk('public')->exists($galeri->foto_path)) {
                Storage::disk('public')->delete($galeri->foto_path);
                Log::info('Foto berhasil dihapus dari storage: ' . $galeri->foto_path); // Log sukses hapus file
            } else {
                Log::warning('Gagal menghapus file dari storage. Path tidak ditemukan atau kosong: ' . $galeri->foto_path); // Log jika file tidak ada
            }

            // Hapus data dari database
            $galeri->delete();
            Log::info('Entri galeri berhasil dihapus dari database untuk ID: ' . $galeri->id); // Log sukses hapus DB

            return redirect()->route('galeri.index')
                             ->with('success', 'Foto berhasil dihapus.');

        } catch (\Exception $e) {
            // Log error secara detail
            Log::error('Error saat menghapus foto ID ' . $galeri->id . ': ' . $e->getMessage(), ['exception' => $e]);

            return redirect()->route('galeri.index')
                             ->with('error', 'Gagal menghapus foto. Silakan coba lagi. (Error detail ada di log server)');
        }
    }

}