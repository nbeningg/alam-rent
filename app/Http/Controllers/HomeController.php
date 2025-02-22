<?php

namespace App\Http\Controllers;


use App\Models\Ransel;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Contact;
use App\Models\Pakaian;
use App\Models\Sepatu;
use App\Models\Tenda;
use App\Models\Testimoni;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index()
    {
        // Mengambil semua testimoni dari database
        $testimonies = Testimoni::all();

        // Menampilkan halaman utama dengan data testimoni
        return view('layouts.home', ['testimonies' => $testimonies]);
    }

    public function about()
    {
        // Menampilkan halaman "about us"
        return view('layouts.about');
    }

    public function services()
    {
        // Menampilkan halaman layanan
        return view('layouts.services');
    }

    public function booking()
    {
        // Menampilkan halaman booking
        return view('layouts.booking');
    }

    public function search(Request $request)
    {
        // Ambil nilai kategori dari permintaan
        $category = $request->input('category');

        // Inisialisasi variabel produk
        $products = [];

        // Jika tidak ada kategori yang dipilih, tampilkan beberapa produk acak dari setiap kategori
        if (!$category) {
            $products['ransel'] = Ransel::inRandomOrder()->limit(3)->get();
            $products['pakaian'] = Pakaian::inRandomOrder()->limit(3)->get();
            $products['sepatu'] = Sepatu::inRandomOrder()->limit(3)->get();
            $products['tenda'] = Tenda::inRandomOrder()->limit(3)->get();
        } else {
            // Sesuaikan query berdasarkan kategori yang dipilih
            switch ($category) {
                case '1':
                    $products['ransel'] = Ransel::all();
                    break;
                case '2':
                    $products['pakaian'] = Pakaian::all();
                    break;
                case '3':
                    $products['sepatu'] = Sepatu::all();
                    break;
                case '4':
                    $products['tenda'] = Tenda::all();
                    break;
                default:
                    // Jika kategori tidak valid, tampilkan beberapa produk acak dari setiap kategori
                    $products['ransel'] = Ransel::inRandomOrder()->limit(3)->get();
                    $products['pakaian'] = Pakaian::inRandomOrder()->limit(3)->get();
                    $products['sepatu'] = Sepatu::inRandomOrder()->limit(3)->get();
                    $products['tenda'] = Tenda::inRandomOrder()->limit(3)->get();
                    break;
            }
        }

        // Kirimkan produk yang ditemukan ke view
        return view('layouts.booking', compact('products', 'category'));
    }

    public function single($category, $id)
    {
        // Tampilkan produk single sesuai dengan permintaan user dari kategorinya
        switch ($category) {
            case 'ransel':
                $product = Ransel::find($id);
                break;
            case 'pakaian':
                $product = Pakaian::find($id);
                break;
            case 'sepatu':
                $product = Sepatu::find($id);
                break;
            case 'tenda':
                $product = Tenda::find($id);
                break;
            default:
                return redirect()->route('home')->with('error', 'Product not found');
        }

        // Periksa apakah produk ditemukan
        if (!$product) {
            return redirect()->route('home')->with('error', 'Product not found');
        }

        return view('layouts.product-detail', compact('product'));
    }

    public function client()
    {
        // Mendapatkan data testimoni dari database
        $testimonies = Testimoni::all();

        // Mengirimkan data testimoni ke view
        return view('layouts.client', ['testimonies' => $testimonies]);
    }

    public function contact()
    {
         // Menampilkan halaman contact
        return view('layouts.contact');
    }

    public function contactStore(Request $request)
    {
        // Validasi data yang diterima dari form contact
        $data = $request->validate([
            'nama' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'pesan' => 'required'
        ]);

        // Membuat instance baru dari model Contact dan menyimpan data yang divalidasi
        $contact = new Contact();
        $contact->nama = $data['nama'];
        $contact->email = $data['email'];
        $contact->phone = $data['phone'];
        $contact->pesan = $data['pesan'];
        $contact->save();

        // Redirect kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with([
            'message' => 'Pesan anda berhasil dikirim',
            'alert-type' => 'success'
        ]);
    }

    public function peminjaman()
    {
        // Menampilkan halaman peminjaman
        return view('layouts.peminjaman');
    }

    public function adminHome()
    {
        // Menghitung total keuangan dari semua booking yang telah dibuat
        $totalKeuangan = Booking::sum('total_price');
        // Menghitung total pesanan yang sedang berlangsung
        $totalPesanan = Booking::where('status', 'ongoing')->count();
        // Menghitung total customer yang terdaftar, mengabaikan user dengan ID 1 (admin default)
        $totalCustomer = User::where('id', '>', 1)->count();
        // Menghitung total pesan yang telah diterima melalui form contact
        $totalContact = Contact::count();

        // Menampilkan halaman dashboard admin dengan data yang diperoleh
        return view('partials-admin.layouts.dashboard', compact('totalKeuangan', 'totalPesanan', 'totalCustomer', 'totalContact'));
    }
}
