<?php

namespace App\Http\Controllers;

use App\Models\Pakaian;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PakaianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua data pakaian dari database, urutkan berdasarkan ID, dan batasi ke 5 per halaman
        $pakaian = Pakaian::orderBy('id', 'asc')->paginate(5);
        // Tampilkan halaman daftar pakaian dengan data pakaian yang diambil
        return view('partials-admin.layouts.pakaian', compact('pakaian'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         // Tampilkan halaman form untuk membuat pakaian baru
        return view('partials-admin.kategori.pakaian.TP');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima dari request
        $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'merk' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'denda' => 'required|numeric',
            'deskripsi' => 'required|string',
            'status' => 'required|boolean'
        ]);

        // Simpan path gambar ke penyimpanan
        $path = $request->file('gambar')->store('assets/pakaian', 'public');
        // Buat slug dari merk untuk digunakan dalam URL
        $slug = Str::slug($request->merk, '-');

        // Buat entri baru di database untuk pakaian
        $pakaian = new Pakaian;
        $pakaian->gambar = $path;
        $pakaian->merk = $request->merk;
        $pakaian->harga = $request->harga;
        $pakaian->denda = $request->denda;
        $pakaian->deskripsi = $request->deskripsi;
        $pakaian->status = $request->status;
        $pakaian->category = $request->category; 
        $pakaian->slug = $slug;

        // Simpan data yang sudah masuk
        $pakaian->save();

        // Redirect dengan pesan sukses
        return redirect()->route('admin/pakaian')->with([
            'message' => 'Data pakaian berhasil dibuat.',
            'alert-type' => 'success'
        ]);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Cari data pakaian berdasarkan ID yang diberikan
        $pakaian = Pakaian::findOrFail($id);
        // Tampilkan halaman form untuk mengedit data pakaian dengan data pakaian yang dipilih
        return view('partials-admin.kategori.pakaian.EP', compact('pakaian'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       // Validasi data yang diterima dari request
        $request->validate([
            'gambar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'merk' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'denda' => 'required|numeric',
            'deskripsi' => 'required|string',
            'status' => 'required|boolean'
        ]);

        // Cari data pakaian berdasarkan ID yang diberikan
        $pakaian = Pakaian::findOrFail($id);

        // Periksa apakah ada gambar baru yang diunggah
        if ($request->hasFile('gambar')) {
            // Simpan gambar baru
            $path = $request->file('gambar')->store('assets/pakaian', 'public');

            $pakaian->gambar = $path;
        }

        // Perbarui data lainnya
        $pakaian->merk = $request->merk;
        $pakaian->harga = $request->harga;
        $pakaian->denda = $request->denda;
        $pakaian->deskripsi = $request->deskripsi;
        $pakaian->status = $request->status;

        // Simpan perubahan ke database
        $pakaian->save();

        // Redirect dengan pesan sukses
        return redirect()->route('admin/pakaian')->with([
            'message' => 'Data pakaian berhasil diupdate.',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Cari data pakaian berdasarkan ID yang diberikan
        $pakaian = Pakaian::findOrFail($id);
        // Hapus data pakaian dari database
        $pakaian->delete();
        // Redirect dengan pesan sukses
        return redirect()->route('admin/pakaian')->with([
            'message' => 'Data pakaian berhasil dihapus.',
            'alert-type' => 'success'
        ]);
    }
}
