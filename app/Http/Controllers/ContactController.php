<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Testimoni;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ContactController extends Controller
{
    // Fungsi untuk menampilkan data testimoni
    public function index()
    {
        // Ambil daftar testimoni dari database, urutkan berdasarkan ID, dan batasi ke 5 per halaman
        $testimoni = Testimoni::orderBy('id', 'asc')->paginate(5);
        // Tampilkan halaman daftar testimoni dengan data testimoni
        return view('partials-admin.contact.testimoni', compact('testimoni'));
    }

    // Fungsi untuk menampilkan daftar pesan / kontak dari customer
    public function indexPesan()
    {
        // Ambil daftar pesan dari database, urutkan berdasarkan ID, dan batasi ke 5 per halaman
        $contacts = Contact::orderBy('id', 'asc')->paginate(5);
        // Tampilkan halaman daftar pesan dengan data pesan
        return view('partials-admin.contact.pesan', compact('contacts'));
    }

    // Fungsi untuk membuat menampilkan form tambah testimoni
    public function create()
    {
        // Tampilkan halaman form untuk membuat testimoni baru
        return view('partials-admin.contact.TT');
    }

    // Fungsi untuk menyimpan testimoni baru ke database
    public function store(Request $request)
    {
        // Validasi data yang diterima dari request
        $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nama' => 'required|string|max:255',
            'testimoni' => 'required|string|max:255'
        ]);

        // Simpan path gambar ke penyimpanan
        $path = $request->file('gambar')->store('assets/testimoni', 'public');

        // Buat entri baru di database
        $testimoni = new Testimoni();
        $testimoni->gambar = $path;
        $testimoni->nama = $request->nama;
        $testimoni->testimoni = $request->testimoni;
        $testimoni->save();

        // Redirect dengan pesan sukses
        return redirect()->route('admin/testimoni')->with([
            'message' => 'Data testimoni berhasil dibuat.',
            'alert-type' => 'success'
        ]);
    }

    // Fungsi untuk menampilkan form edit testimoni
    public function edit(string $id)
    {
        // Cari testimoni berdasarkan ID yang diberikan
        $testimoni = Testimoni::findOrFail($id);
        // Tampilkan halaman form untuk mengedit testimoni dengan data testimoni yang dipilih
        return view('partials-admin.contact.ET', compact('testimoni'));
    }

    // Fungsi untuk mengedit testimoni yang ada di database
    public function update(Request $request, string $id)
    {
        // Validasi data yang diterima dari request
        $request->validate([
            'nama' => 'required|string|max:255',
            'testimoni' => 'required|string|max:255'
        ]);

        // Cari testimoni berdasarkan ID yang diberikan
        $testimoni = Testimoni::findOrFail($id);

        // Periksa apakah ada gambar baru yang diunggah
        if ($request->hasFile('gambar')) {
            // Jika ada, lakukan validasi dan proses penyimpanan gambar baru
            $request->validate([
                'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $path = $request->file('gambar')->store('assets/testimoni', 'public');
            $testimoni->gambar = $path;
        }

        // Update data testimoni dengan data baru dari request
        $testimoni->nama = $request->nama;
        $testimoni->testimoni = $request->testimoni;
        $testimoni->save();

        // Redirect dengan pesan sukses
        return redirect()->route('admin/testimoni')->with([
            'message' => 'Data testimoni berhasil diupdate.',
            'alert-type' => 'success'
        ]);
    }

    // Fungsi untuk menghapus data testimoni dari database
    public function destroy(string $id)
    {
        // Cari testimoni berdasarkan ID yang diberikan
        $testimoni = Testimoni::findOrFail($id);
        // Hapus testimoni dari database
        $testimoni->delete();
        // Redirect dengan pesan sukses
        return redirect()->route('admin/testimoni')->with([
            'message' => 'Data testimoni berhasil dihapus.',
            'alert-type' => 'success'
        ]);
    }

    // Fungsi untuk menghpaus data pesan dari database
    public function destroyPesan(string $id)
    {
        // Cari pesan berdasarkan ID yang diberikan
        $contacts = Contact::findOrFail($id);
        // Hapus pesan dari database
        $contacts->delete();
        // Redirect dengan pesan sukses
        return redirect()->route('admin/pesan')->with([
            'message' => 'Data pesan berhasil dihapus.',
            'alert-type' => 'success'
        ]);
    }
}
