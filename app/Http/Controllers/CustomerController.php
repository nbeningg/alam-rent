<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    // Menampilkan semua data customer
    public function index()
    {
        // Ambil semua data customer dari database dengan ID lebih besar dari 1 karena itu admin
        $customers = User::where('id', '>', 1)->paginate(5);
         // Tampilkan halaman daftar customer dengan data customer yang diambil
        return view('partials-admin.customer.customer', compact('customers'));
    }

    // Fungsi untuk manampilkan form edit customer
    public function edit(string $id)
    {
        // Cari data customer berdasarkan ID yang diberikan
        $customers = User::findOrFail($id);
        // Tampilkan halaman form untuk mengedit data customer dengan data customer yang dipilih
        return view('partials-admin.customer.EC', compact('customers'));
    }

    // Fungsi untuk update data customer
    public function update(Request $request, string $id)
    {
        // Validasi data yang diterima dari request
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|',
            'phone' => 'required|string|max:20',
        ]);

        // Cari data customer berdasarkan ID yang diberikan
        $customers = User::findOrFail($id);

        // Perbarui data customer dengan data baru dari request
        $customers->name = $request->name;
        $customers->email = $request->email;
        $customers->phone = $request->phone;

        // Simpan perubahan ke database
        $customers->save();

        // Redirect dengan pesan sukses
        return redirect()->route('admin/customer')->with([
            'message' => 'Data customer berhasil diupdate.',
            'alert-type' => 'success'
        ]);
    }

    // Fungsi untuk hapus data customer
    public function destroy(string $id)
    {
        // Cari data customer berdasarkan ID yang diberikan
        $customers = User::findOrFail($id);
        // Hapus data customer dari database
        $customers->delete();
        // Redirect dengan pesan sukses
        return redirect()->route('admin/customer')->with([
            'message' => 'Data customer berhasil dihapus.',
            'alert-type' => 'success'
        ]);
    }
}
