<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use Illuminate\Http\Request;

class KamarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Kamar::query();

        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('nomor_kamar', 'like', '%' . $searchTerm . '%')
                  ->orWhere('gedung', 'like', '%' . $searchTerm . '%')
                  ->orWhere('status', 'like', '%' . $searchTerm . '%');
            });
        }


        if ($request->has('status') && $request->status != '' && $request->status != 'Semua') {
            $query->where('status', $request->status);
        }
        
        $kamars = $query->orderBy('gedung', 'asc')
                        ->orderBy('nomor_kamar', 'asc')
                        ->paginate(10);

        return view('kamar.index', compact('kamars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kamar.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi Input
        $validatedData = $request->validate([
            'nomor_kamar' => 'required|unique:kamars,nomor_kamar|max:10',
            'gedung' => 'required|string',             
            'jenis_kamar_mandi' => 'required|string', 
            'harga_sewa' => 'required|numeric|min:0',
            'status' => 'required|in:Kosong,Terisi,Perbaikan',
            'deskripsi' => 'nullable|string',
        ], [
            // Pesan Error Kustom (Opsional, agar lebih ramah pengguna)
            'nomor_kamar.required' => 'Nomor kamar wajib diisi.',
            'nomor_kamar.unique' => 'Nomor kamar ini sudah ada.',
            'gedung.required' => 'Lokasi gedung wajib dipilih.',
            'jenis_kamar_mandi.required' => 'Jenis kamar mandi wajib dipilih.',
            'harga_sewa.required' => 'Harga sewa wajib diisi.',
            'harga_sewa.numeric' => 'Harga sewa harus berupa angka.',
            'status.required' => 'Status kamar wajib dipilih.',
        ]);

        // 2. Simpan Data ke Database
        Kamar::create($validatedData);

        // 3. Redirect kembali dengan pesan sukses
        return redirect()->route('admin.kamar.index')
                         ->with('success', 'Kamar baru berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kamar $kamar)
    {
        return view('kamar.edit', compact('kamar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kamar $kamar)
    {
        // 1. Validasi Input
        $validatedData = $request->validate([
            'nomor_kamar' => 'required|max:10|unique:kamars,nomor_kamar,' . $kamar->id,
            'gedung' => 'required|string',
            'jenis_kamar_mandi' => 'required|string',
            'harga_sewa' => 'required|numeric|min:0',
            'status' => 'required|in:Kosong,Terisi,Perbaikan',
            'deskripsi' => 'nullable|string',
        ]);

        // 2. Update Data di Database
        $kamar->update($validatedData);

        // 3. Redirect kembali dengan pesan sukses
        return redirect()->route('admin.kamar.index')
                         ->with('success', 'Data kamar berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kamar $kamar)
    {
        // Hapus data kamar dari database
        $kamar->delete();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('admin.kamar.index')
                         ->with('success', 'Kamar berhasil dihapus!');
    }
}