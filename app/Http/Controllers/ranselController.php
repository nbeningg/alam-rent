<?php

namespace App\Http\Controllers;


use App\Models\Ransel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ranselController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua data ransel dari database, urutkan berdasarkan ID, dan batasi ke 5 per halaman
        $ransel = Ransel::orderBy('id', 'asc')->paginate(5);
        // Tampilkan halaman daftar ransel dengan data ransel yang diambil
        return view('partials-admin.layouts.ransel', compact('ransel'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Tampilkan halaman form untuk membuat ransel baru
        return view('partials-admin.kategori.ransel.TR');
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
        $path = $request->file('gambar')->store('assets/ransel', 'public');
        $slug = Str::slug($request->merk, '-');

        // Buat entri baru di database untuk ransel
        $ransel = new Ransel;
        $ransel->gambar = $path;
        $ransel->merk = $request->merk;
        $ransel->harga = $request->harga;
        $ransel->denda = $request->denda;
        $ransel->deskripsi = $request->deskripsi;
        $ransel->status = $request->status;
        $ransel->category = $request->category;
        $ransel->slug = $slug;
        $ransel->save();

        // Redirect dengan pesan sukses
        return redirect()->route('admin/ransel')->with([
            'message' => 'Data ransel berhasil dibuat.',
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
        // Cari data ransel berdasarkan ID yang diberikan
        $ransel = Ransel::findOrFail($id);
        // Tampilkan halaman form untuk mengedit data ransel dengan data ransel yang dipilih
        return view('partials-admin.kategori.ransel.ER', compact('ransel'));
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

        // Cari data ransel berdasarkan ID yang diberikan
        $ransel = Ransel::findOrFail($id);

        // Periksa apakah ada gambar baru yang diunggah
        if ($request->hasFile('gambar')) {
            // Simpan gambar baru
            $path = $request->file('gambar')->store('assets/ransel', 'public');

            $ransel->gambar = $path;
        }

        // Perbarui data lainnya
        $ransel->merk = $request->merk;
        $ransel->harga = $request->harga;
        $ransel->denda = $request->denda;
        $ransel->deskripsi = $request->deskripsi;
        $ransel->status = $request->status;

        // Simpan perubahan ke database
        $ransel->save();

        // Redirect dengan pesan sukses
        return redirect()->route('admin/ransel')->with([
            'message' => 'Data ransel berhasil diupdate.',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Cari data ransel berdasarkan ID yang diberikan
        $ransel = Ransel::findOrFail($id);
        // Hapus data ransel dari database
        $ransel->delete();
        // Redirect dengan pesan sukses
        return redirect()->route('admin/ransel')->with([
            'message' => 'Data ransel berhasil dihapus.',
            'alert-type' => 'success'
        ]);
    }
}
