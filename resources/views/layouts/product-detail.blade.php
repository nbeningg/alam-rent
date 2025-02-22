<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head')

    <link rel="stylesheet" href="{{ asset('css-single/styles.css') }}">

    <!-- Tambahkan SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    @include('partials.header')

    <header class="main-header">
        <h1 class="gallery_taital">Detail Barang</h1>
    </header>

    <div class="container">
        <div class="row product-detail">
            <div class="col-md-6">
                <img src="{{ Storage::url($product->gambar) }}" alt="{{ $product->merk }}">
            </div>
            <div class="col-md-6 product-info">
                <h1>{{ $product->merk }}</h1>
                <h4>Harga: Rp.{{ number_format($product->harga, 0, ',', '.') }} per hari</h4>
                <h4>Denda: Rp.{{ number_format($product->denda, 0, ',', '.') }} per hari</h4>
                <h4>Deskripsi:</h4>
                <p>{{ $product->deskripsi }}</p>
                <div class="booking-form">
                    <form id="booking-form"
                        action="{{ route('booking.store', ['category' => $product->category, 'id' => $product->id]) }}"
                        method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="category" value="{{ $product->category }}">
                        <div class="form-group">
                            <label for="start-date">Start Date:</label>
                            <input type="date" id="start-date" name="start_date" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="end-date">End Date:</label>
                            <input type="date" id="end-date" name="end_date" class="form-control" required>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="showPopup()">Booking</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('partials.footer')
    <script src="{{ asset('template/scripts.js') }}"></script>

    {{-- // SweetAlert merupakan sebuah library JavaScript  --}}
    <script>
        function showPopup() { // Fungsi ini dipanggil ketika pengguna mengklik tombol "Booking".
            // Mengambil nilai tanggal mulai (startDate) dan tanggal selesai (endDate) dari elemen input yang di product detail
            const startDate = document.getElementById("start-date").value;
            const endDate = document.getElementById("end-date").value;
            // Menghitung jumlah hari (totalDays) antara startDate dan endDate menggunakan fungsi calculateTotalPrice(startDate, endDate).
            const hargaPerHari = {{ $product->harga }};
            const totalDays = calculateTotalPrice(startDate, endDate);
            const totalHarga = totalDays * hargaPerHari;

            // Menampilkan popup SweetAlert (Swal.fire) dengan judul berisi total harga dan input untuk memasukkan jumlah uang.
            Swal.fire({
                // Menerapkan validasi menggunakan preConfirm untuk memastikan jumlah uang yang dimasukkan sesuai dengan totalHarga.
                title: 'Total Harga: Rp.' + totalHarga.toLocaleString('id-ID'),
                text: 'Silakan bayar di sini. Masukkan jumlah uang yang sesuai.',
                input: 'text',
                inputAttributes: {
                    'aria-label': 'Masukkan jumlah uang'
                },
                // Jika pengguna mengkonfirmasi (klik OK), maka memanggil fungsi submitBookingForm(form) untuk mengirimkan formulir pemesanan.
                showCancelButton: true,
                confirmButtonText: 'Ok',
                cancelButtonText: 'Batal',
                preConfirm: (uang) => {
                    if (uang !== totalHarga.toString()) {
                        Swal.showValidationMessage(
                            'Jumlah uang yang dimasukkan tidak sesuai dengan total harga!'
                        );
                    } else {
                        return uang;
                    }
                }
            }).then((result) => {
                // Jika pengguna membatalkan (klik Batal), pesan "Pengguna membatalkan aksi" ditampilkan di console.
                if (result.isConfirmed) {
                    const form = document.getElementById('booking-form');
                    submitBookingForm(form);
                } else {
                    console.log('Pengguna membatalkan aksi');
                }
            });
        }

        // Fungsi ini menghitung jumlah hari antara dua tanggal, termasuk hari terakhir.
        function calculateTotalPrice(startDate, endDate) {
            // Menerima startDate dan endDate sebagai parameter.
            const start = new Date(startDate);
            const end = new Date(endDate);
            // Menghitung selisih waktu dalam milidetik antara startDate dan endDate.
            const oneDay = 24 * 60 * 60 * 1000;
            const diffDays = Math.round(Math.abs((end - start) / oneDay));
            // Mengembalikan hasil jumlah hari (diffDays), ditambah satu untuk memasukkan hari terakhir.
            return diffDays + 1;
        }

        // Fungsi ini mengirimkan data formulir pemesanan ke server menggunakan Fetch API.
        function submitBookingForm(form) {
            const formData = new FormData(form);

            // Menerima form sebagai parameter.
            // Membuat objek FormData dari form untuk mengirim data.
            fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    }
                })
                /* Menangani respons dari server: jika respons OK, maka tampilkan pesan sukses dengan SweetAlert; 
                jika ada kesalahan, tampilkan pesan kesalahan. */
                .then(response => {
                    console.log('Response:', response);
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Data:', data);
                    if (data.message === 'Booking berhasil ditambahkan. Pembayaran berhasil.') {
                        Swal.fire({
                            title: 'Pembayaran Berhasil!',
                            text: 'Booking Anda telah berhasil ditambahkan.',
                            icon: 'success',
                            confirmButtonText: 'Ok'
                        }).then(() => {
                            // Redirect ke halaman "My Booking"
                            window.location.href =
                            '{{ route('bookings.index') }}'; // Sesuaikan dengan nama rute yang benar
                        });
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: data.message,
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Terjadi kesalahan. Silakan coba lagi.',
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    });
                    console.error('Error:', error);
                });
        }
    </script>
</body>

</html>
