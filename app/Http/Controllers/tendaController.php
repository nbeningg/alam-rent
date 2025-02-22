<?php

namespace App\Http\Controllers;

use App\Models\Tenda;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class tendaController extends Controller
{
    public function index()
    {
        // Ambil semua data tenda dari database, urutkan berdasarkan ID secara menaik, dan batasi ke 5 per halaman
        $tenda = Tenda::orderBy('id', 'asc')->paginate(5);
        // Tampilkan halaman daftar tenda dengan data tenda yang diambil
        return view('partials-admin.layouts.tenda', compact('tenda'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Tampilkan halaman form untuk membuat tenda baru
        return view('partials-admin.kategori.tenda.TT');
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
        $path = $request->file('gambar')->store('assets/tenda', 'public');
        $slug = Str::slug($request->merk, '-');

        // Buat entri baru di database untuk tenda
        $tenda = new Tenda;
        $tenda->gambar = $path;
        $tenda->merk = $request->merk;
        $tenda->harga = $request->harga;
        $tenda->denda = $request->denda;
        $tenda->deskripsi = $request->deskripsi;
        $tenda->status = $request->status;
        $tenda->category = $request->category; 
        $tenda->slug = $slug; 
        $tenda->save();

        // Redirect dengan pesan sukses
        return redirect()->route('admin/tenda')->with([
            'message' => 'Data tenda berhasil dibuat.',
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
        // Cari data tenda berdasarkan ID yang diberikan
        $tenda = Tenda::findOrFail($id);
        // Tampilkan halaman form untuk mengedit data tenda dengan data tenda yang dipilih
        return view('partials-admin.kategori.tenda.ET', compact('tenda'));
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

        // Cari data tenda berdasarkan ID yang diberikan
        $tenda = Tenda::findOrFail($id);

        // Periksa apakah ada gambar baru yang diunggah
        if ($request->hasFile('gambar')) {
            // Simpan gambar baru 
            $path = $request->file('gambar')->store('assets/tenda', 'public');

            $tenda->gambar = $path;
        }

        // Perbarui data lainnya
        $tenda->merk = $request->merk;
        $tenda->harga = $request->harga;
        $tenda->denda = $request->denda;
        $tenda->deskripsi = $request->deskripsi;
        $tenda->status = $request->status;

        // Simpan perubahan ke database
        $tenda->save();

        // Redirect dengan pesan sukses
        return redirect()->route('admin/tenda')->with([
            'message' => 'Data tenda berhasil diupdate.',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Cari data tenda berdasarkan ID yang diberikan
        $tenda = Tenda::findOrFail($id);
        // Hapus data tenda dari database
        $tenda->delete();
        // Redirect dengan pesan sukses
        return redirect()->route('admin/tenda')->with([
            'message' => 'Data tenda berhasil dihapus.',
            'alert-type' => 'success'
        ]);
    }
}
