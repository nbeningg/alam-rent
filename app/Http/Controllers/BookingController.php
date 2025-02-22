<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Pakaian;
use App\Models\Ransel;
use App\Models\Sepatu;
use App\Models\Tenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class BookingController extends Controller
{
    // Fungsi getProduct() untuk mendapatkan produk berdasarkan kategori dan ID produk
    private function getProduct($category, $productId)
    {
        // Log info untuk pencarian produk
        Log::info('Fetching product with category and productId:', ['category' => $category, 'product_id' => $productId]);

        // Normalisasi kategori
        $normalizedCategory = strtolower($category);

        // Gunakan switch case untuk mencari produk berdasarkan kategori
        switch ($normalizedCategory) {
            case 'ransel':
                return Ransel::find($productId);
            case 'pakaian':
                return Pakaian::find($productId);
            case 'sepatu':
                return Sepatu::find($productId);
            case 'tenda':
                return Tenda::find($productId);
            default:
                return null;
        }
    }

    // Fungsi untuk membuat booking baru
    public function store(Request $request)
    {
        try {
            // Log info untuk permintaan penyimpanan booking
            Log::info('Booking Store Request:', $request->all());

            // Validasi permintaan
            $request->validate([
                'product_id' => 'required|integer',
                'category' => 'required|string|in:Ransel,Pakaian,Sepatu,Tenda',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after:start_date',
            ]);

            // Dapatkan produk berdasarkan kategori dan ID produk
            $product = $this->getProduct($request->category, $request->product_id);

            // Jika produk tidak ditemukan, kirim respons dengan pesan error
            if (!$product) {
                Log::error('Product not found.', ['category' => $request->category, 'product_id' => $request->product_id]);
                return response()->json(['message' => 'Product not found.'], 404);
            }

            // Log info jika produk ditemukan
            Log::info('Product found:', $product->toArray());

            // Hitung total harga booking
            $totalPrice = $this->calculateTotalPrice($request->start_date, $request->end_date, $product->harga);

            // Buat booking baru
            $booking = Booking::create([
                'user_id' => auth()->id(),
                'category' => $request->category,
                'product_id' => $product->id,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'total_price' => $totalPrice,
                'status' => 'ongoing',
            ]);

            // Log info jika booking berhasil dibuat
            Log::info('Booking created successfully:', $booking->toArray());

            // Kirim respons dengan pesan berhasil
            return response()->json(['message' => 'Booking berhasil ditambahkan. Pembayaran berhasil.'], 200);
        } catch (\Exception $e) {
            // Tangani kesalahan dan kirim respons dengan pesan error
            Log::error('Error during booking:', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Terjadi kesalahan. Silakan coba lagi.'], 500);
        }
    }

    // Fungsi calculateTotalPrice() untuk menghitung total harga berdasarkan tanggal mulai dan selesai serta harga per hari
    private function calculateTotalPrice($startDate, $endDate, $hargaPerHari)
    {
        $start = Carbon::parse($startDate);
        $end = Carbon::parse($endDate);
        $totalDays = $end->diffInDays($start) + 1;
        return $totalDays * $hargaPerHari;
    }

    // Fungsi untuk membatalkan booking
    public function cancelBooking($id)
    {
        // Cari booking berdasarkan ID
        $booking = Booking::findOrFail($id);
        // Ubah status booking menjadi 'cancelled'
        $booking->status = 'cancelled';
        $booking->save();

        // Uang tetap masuk database dan status berubah menjadi cancel
        return response()->json(['message' => 'Pemesanan berhasil dibatalkan.', 'status' => 'cancelled'], 200);
    }

    // Metode untuk mengkonfirmasi pengembalian
    public function confirmReturn(Request $request, $category, $id)
    {
        // Cari booking berdasarkan ID
        $booking = Booking::findOrFail($id);
        // Ambil tanggal pengembalian dari booking
        $endDate = Carbon::parse($booking->end_date);
        // Ambil waktu saat ini
        $now = Carbon::now();

        // Hitung jumlah hari terlambat
        $jumlahHariTerlambat = $now->diffInDays($endDate);

        // Inisialisasi total denda
        $totalDenda = 0;

        if ($jumlahHariTerlambat > 0) {
            // Ambil denda per hari dari request
            $dendaPerHari = $request->denda_per_hari;

            // Hitung total denda
            $totalDenda = $jumlahHariTerlambat * $dendaPerHari;
        }

        // Perbarui tanggal pengembalian dan status booking
        $booking->return_date = $now;

        if ($jumlahHariTerlambat > 0) {
            $booking->status = 'returned_late';
            // Tambahkan denda ke total harga asli
            $booking->total_price += $totalDenda;
        } else {
            $booking->status = 'returned_on_time';
        }

        $booking->save();

        // Kirim notifikasi ke client dengan pesan yang diperbarui
        return response()->json([
            'message' => "Pengembalian barang berhasil."
        ], 200);
    }

    // Metode untuk menampilkan halaman peminjaman (my-booking)
    public function index()
    {
        // Ambil semua booking oleh user yang sedang login
        $bookings = Booking::where('user_id', auth()->user()->id)->get();
        // Tampilkan halaman peminjaman dengan daftar booking
        return view('layouts.peminjaman', compact('bookings'));
    }
}
