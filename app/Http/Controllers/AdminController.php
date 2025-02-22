<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Menghitung total keuangan dari semua transaksi
        $totalKeuangan = Booking::sum('total_price');

        // Menghitung total pesanan yang sedang berlangsung (status = 'ongoing')
        $totalPesanan = Booking::where('status', 'ongoing')->count();

        // Menghitung total customer, mengabaikan user dengan ID 1 karena ini admin
        $totalCustomer = User::where('id', '>', 1)->count();

        // Menghitung total kontak yang ada dari customer
        $totalContact = Contact::count();

        return view('partials-admin.layouts.dashboard', compact('totalKeuangan', 'totalPesanan', 'totalCustomer', 'totalContact'));
    }

    public function showBookingHistory()
    {
        // Mengambil data booking dengan urutan ID ascending dan menggunakan pagination sebanyak 10 data per halaman
        $bookings = Booking::orderBy('id', 'asc')->paginate(10); // Apply pagination directly to the query
        return view('partials-admin.layouts.transaksi', compact('bookings'));
    }

    public function topCustomersReport()
    {
        // Mengambil data top customers berdasarkan jumlah produk yang disewa dan total uang yang dihabiskan
        $topCustomers = Booking::select('user_id')
            ->selectRaw('COUNT(*) as total_products_rented')
            ->selectRaw('SUM(total_price) as total_spent')
            ->with('user') // Memuat relasi user untuk setiap booking
            ->groupBy('user_id')
            ->orderByDesc('total_spent') // Mengurutkan berdasarkan total pengeluaran (total_spent) secara descending
            ->paginate(10); // Mem-paginate hasil query

        return view('partials-admin.layouts.top-pelanggan', compact('topCustomers'));
    }

    public function financialReport()
    {
        // Mengambil data keuangan berdasarkan tanggal transaksi dan total pendapatan
        $financialData = Booking::selectRaw('DATE(created_at) as transaction_date, sum(total_price) as total_income')
            ->groupBy('transaction_date')
            ->orderBy('transaction_date', 'asc')
            ->get();

        return view('partials-admin.layouts.keuangan', compact('financialData'));
    }

    public function topTransactionsReport()
    {
        // Mengambil data transaksi teratas (top transactions) berdasarkan total harga secara descending
        $topTransactions = Booking::with(['user'])
            ->orderByDesc('total_price')
            ->limit(10)
            ->get();

        return view('partials-admin.layouts.top-transaksi', compact('topTransactions'));
    }
}
