<?php

namespace App\Http\Controllers;

use App\Models\Sepatu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SepatuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua data sepatu dari database, urutkan berdasarkan ID secara menaik, dan batasi ke 5 per halaman
        $sepatu = Sepatu::orderBy('id', 'asc')->paginate(5);
        // Tampilkan halaman daftar sepatu dengan data sepatu yang diambil
        return view('partials-admin.layouts.sepatu', compact('sepatu'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Tampilkan halaman form untuk membuat sepatu baru
        return view('partials-admin.kategori.sepatu.TS');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi permintaan
        $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'merk' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'denda' => 'required|numeric',
            'deskripsi' => 'required|string',
            'status' => 'required|boolean'
        ]);

        // Simpan path gambar ke penyimpanan
        $path = $request->file('gambar')->store('assets/sepatu', 'public');
        $slug = Str::slug($request->merk, '-');

        // Buat entri baru di database untuk sepatu
        $sepatu = new Sepatu;
        $sepatu->gambar = $path;
        $sepatu->merk = $request->merk;
        $sepatu->harga = $request->harga;
        $sepatu->denda = $request->denda;
        $sepatu->deskripsi = $request->deskripsi;
        $sepatu->status = $request->status;
        $sepatu->category = $request->category;
        $sepatu->slug = $slug;
        $sepatu->save();

        // Redirect dengan pesan sukses
        return redirect()->route('admin/sepatu')->with([
            'message' => 'Data sepatu berhasil dibuat.',
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
        // Cari data sepatu berdasarkan ID yang diberikan
        $sepatu = Sepatu::findOrFail($id);
        // Tampilkan halaman form untuk mengedit data sepatu dengan data sepatu yang dipilih
        return view('partials-admin.kategori.sepatu.ES', compact('sepatu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi permintaan
        $request->validate([
            'gambar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'merk' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'denda' => 'required|numeric',
            'deskripsi' => 'required|string',
            'status' => 'required|boolean'
        ]);

        // Cari data sepatu berdasarkan ID yang diberikan
        $sepatu = Sepatu::findOrFail($id);

        // Periksa apakah ada gambar baru yang diunggah
        if ($request->hasFile('gambar')) {
            // Simpan gambar baru
            $path = $request->file('gambar')->store('assets/sepatu', 'public');

            $sepatu->gambar = $path;
        }

        // Perbarui data lainnya
        $sepatu->merk = $request->merk;
        $sepatu->harga = $request->harga;
        $sepatu->denda = $request->denda;
        $sepatu->deskripsi = $request->deskripsi;
        $sepatu->status = $request->status;

        // Simpan perubahan ke database
        $sepatu->save();

        // Redirect dengan pesan sukses
        return redirect()->route('admin/sepatu')->with([
            'message' => 'Data sepatu berhasil diupdate.',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Cari data sepatu berdasarkan ID yang diberikan
        $sepatu = Sepatu::findOrFail($id);
        // Hapus data sepatu dari database
        $sepatu->delete();
        // Redirect dengan pesan sukses
        return redirect()->route('admin/sepatu')->with([
            'message' => 'Data sepatu berhasil dihapus.',
            'alert-type' => 'success'
        ]);
    }
}
