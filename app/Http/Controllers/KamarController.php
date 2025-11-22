<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use Illuminate\Http\Request;

class KamarController extends Controller
{
    /**
     * Menampilkan daftar semua kamar.
     */
    public function index()
    {
        $kamars = Kamar::orderBy('nomor_kamar', 'asc')->get();
        return view('kamar.index', compact('kamars'));
    }

    /**
     * Menampilkan form untuk menambah kamar baru.
     */
    public function create()
    {
        return view('kamar.create');
    }

    /**
     * Menyimpan kamar baru ke database.
     */
    public function store(Request $request)
    {
        // 1. Validasi data yang masuk dari form
        $validatedData = $request->validate([
            'nomor_kamar' => 'required|string|max:10|unique:kamars,nomor_kamar',
            'tipe_kamar'  => 'required|string|max:255',
            'harga_sewa'  => 'required|integer|min:0',
            'status'      => 'required|in:Kosong,Terisi,Perbaikan',
            'deskripsi'   => 'nullable|string',
        ]);

        // 2. Buat kamar baru menggunakan data yang SUDAH divalidasi
        // Ini akan bekerja karena $fillable di Model sudah diatur
        Kamar::create($validatedData);

        // 3. Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('admin.kamar.index')
                         ->with('success', 'Kamar baru berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit kamar.
     */
    public function edit(Kamar $kamar)
    {
        // $kamar sudah otomatis di-fetch oleh Laravel (Route Model Binding)
        return view('kamar.edit', compact('kamar'));
    }

    /**
     * Mengupdate data kamar di database.
     */
    public function update(Request $request, Kamar $kamar)
    {
        // 1. Validasi data yang masuk
        $validatedData = $request->validate([
            // Tambahkan rule 'ignore' untuk unique agar tidak error saat mengedit
            'nomor_kamar' => 'required|string|max:10|unique:kamars,nomor_kamar,' . $kamar->id,
            'tipe_kamar'  => 'required|string|max:255',
            'harga_sewa'  => 'required|integer|min:0',
            'status'      => 'required|in:Kosong,Terisi,Perbaikan',
            'deskripsi'   => 'nullable|string',
        ]);

        // 2. Update data kamar menggunakan data yang SUDAH divalidasi
        $kamar->update($validatedData);

        // 3. Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('admin.kamar.index')
                         ->with('success', 'Data kamar berhasil diperbarui.');
    }

    /**
     * Menghapus kamar dari database.
     */
    public function destroy(Kamar $kamar)
    {
        // Hapus data kamar
        $kamar->delete();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('admin.kamar.index')
                         ->with('success', 'Data kamar berhasil dihapus.');
    }
}