<!-- Page Content -->

<!-- DataTables Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4 class="m-0 font-weight-bold text-center">Data Peminjaman Barang</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Gambar</th>
                        <th>Merk</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Awal Sewa</th>
                        <th>Akhir Sewa</th>
                        <th>Cancel</th>
                        <th>Pengembalian</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($bookings->isEmpty())
                        <tr>
                            <td colspan="9" class="text-center">Data tidak ada, booking sekarang!</td>
                        </tr>
                    @else
                        @foreach ($bookings as $booking)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @if ($booking->product)
                                        <img src="{{ Storage::url($booking->product->gambar) }}"
                                            alt="{{ $booking->product->merk }}" style="width: 100px;">
                                    @else
                                        <span>Gambar tidak tersedia</span>
                                    @endif
                                </td>
                                <td>{{ $booking->product ? $booking->product->merk : 'Merk tidak tersedia' }}</td>
                                <td>{{ $booking->category }}</td>
                                <td>Rp.{{ number_format($booking->total_price, 0, ',', '.') }}</td>
                                <td>{{ $booking->start_date }}</td>
                                <td>{{ $booking->end_date }}</td>
                                <td>
                                    @if ($booking->status == 'ongoing')
                                        <button class="btn btn-danger btn-sm"
                                            onclick="cancelBooking('{{ $booking->category }}', {{ $booking->id }})">
                                            <i class="bi bi-trash3"></i> Batalkan
                                        </button>
                                    @else
                                        <button class="btn btn-secondary btn-sm" disabled>
                                            Batalkan
                                        </button>
                                    @endif
                                </td>
                                <td>
                                    @if ($booking->status == 'ongoing')
                                        <button class="btn btn-success btn-sm"
                                            onclick="confirmReturn('{{ $booking->category }}', {{ $booking->id }}, '{{ $booking->end_date }}', {{ $booking->product->denda }})">
                                            <i class="bi bi-check-square-fill"></i> Konfirmasi Pengembalian
                                        </button>
                                    @else
                                        <button class="btn btn-secondary btn-sm" disabled>
                                            Sudah Dikembalikan
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    // Fungsi ini dipanggil ketika pengguna ingin membatalkan pemesanan barang.
    function cancelBooking(category, bookingId) {
        console.log("Tombol cancel ditekan");
        // Menampilkan pop-up konfirmasi pembatalan
        Swal.fire({
            title: 'Anda yakin?',
            text: "Anda yakin ingin membatalkan pemesanan ini?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, batalkan!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Kirim permintaan fetch ke server
                fetch(`/bookings/cancel/${bookingId}`, {
                        method: 'PUT',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        }
                    })
                    .then(response => {
                        // Periksa apakah respons dari server adalah 200 OK
                        if (!response.ok) {
                            throw new Error('Failed to cancel booking');
                        }
                        // Tampilkan pesan sukses jika berhasil
                        Swal.fire(
                            'Dibatalkan!',
                            'Pemesanan Anda telah dibatalkan.',
                            'success'
                        );
                        // Muat ulang halaman setelah pembatalan berhasil
                        location.reload();
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire(
                            'Error!',
                            'Gagal membatalkan pemesanan. Silakan coba lagi nanti.',
                            'error'
                        );
                    });

            }
        });
    }

    // Fungsi untuk menghitung jumlah hari terlambat
    function daysDifference(endDate, returnDate) {
        // Set kedua tanggal ke tengah malam untuk hanya membandingkan tanggal, tanpa waktu
        endDate.setHours(0, 0, 0, 0);
        returnDate.setHours(0, 0, 0, 0);

        const oneDay = 24 * 60 * 60 * 1000; // Satu hari dalam milidetik
        const differenceInTime = returnDate.getTime() - endDate
    .getTime(); // Selisih waktu antara tanggal pengembalian dan akhir sewa dalam milidetik
        if (differenceInTime <= 0) {
            return 0; // Tidak terlambat jika returnDate <= endDate
        }
        const daysLate = Math.ceil(differenceInTime / oneDay); // Pembulatan ke atas untuk memastikan hasil positif
        return daysLate; // Jumlah hari terlambat
    }

    // Fungsi ini digunakan ketika pengguna ingin mengonfirmasi pengembalian barang.
    function confirmReturn(category, bookingId, endDateString, dendaPerHari) {
        Swal.fire({
            title: 'Anda yakin?',
            text: "Anda yakin ingin mengonfirmasi pengembalian?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, konfirmasi!'
        }).then((result) => {
            if (result.isConfirmed) {
                const endDate = new Date(endDateString);
                const now = new Date();

                const daysLate = daysDifference(endDate, now);
                // Jika pengembalian tepat waktu, fungsi confirmReturnSuccess() langsung dipanggil untuk mengonfirmasi pengembalian tanpa denda tambahan
                if (daysLate === 0) {
                    confirmReturnSuccess(category, bookingId, now);
                } else {
                    const totalFine = calculateTotalWithFine(daysLate, dendaPerHari);
                    Swal.fire({
                        // Jika pengembalian terlambat, dialog konfirmasi akan menampilkan informasi mengenai jumlah hari keterlambatan dan total denda yang harus dibayarkan
                        title: 'Pengembalian Terlambat',
                        html: `Pengembalian terlambat ${daysLate} hari. Total yang harus dibayarkan: Rp.${totalFine}. Masukkan jumlah denda:`,
                        input: 'text',
                        inputAttributes: {
                            autocapitalize: 'off'
                        },
                        // Pengguna diminta untuk memasukkan jumlah denda yang sesuai dan melakukan validasi input.
                        showCancelButton: true,
                        confirmButtonText: 'Konfirmasi',
                        cancelButtonText: 'Batal',
                        showLoaderOnConfirm: true,
                        // Jika jumlah denda yang dimasukkan sesuai, maka fungsi confirmReturnSuccess() akan dipanggil untuk 
                        // mengirim permintaan ke server dengan mengirimkan data tanggal pengembalian dan denda.
                        preConfirm: (uang) => {
                            if (!isValidAmount(uang)) {
                                Swal.showValidationMessage(
                                    'Jumlah uang tidak valid. Harap masukkan angka yang benar.'
                                );
                                return false;
                            }
                            if (parseFloat(uang) !== totalFine) {
                                Swal.showValidationMessage(
                                    'Jumlah uang yang dimasukkan tidak sesuai dengan total harga!'
                                );
                                return false;
                            }
                            return true;
                        },
                        allowOutsideClick: () => !Swal.isLoading()
                    }).then((result) => {
                        if (result.isConfirmed) {
                            confirmReturnSuccess(category, bookingId, now,
                            totalFine); // Pengembalian terlambat
                        }
                    });
                }
            }
        });
    }

    // Fungsi untuk memeriksa apakah jumlah yang dimasukkan valid
    function isValidAmount(amount) {
        return !isNaN(parseFloat(amount)) && isFinite(amount) && amount >= 0;
    }

    // Fungsi untuk menghitung total denda
    function calculateTotalWithFine(daysLate, dendaPerHari) {
        return daysLate * dendaPerHari;
    }

    // Fungsi untuk mengirimkan permintaan konfirmasi pengembalian ke server
    function confirmReturnSuccess(category, bookingId, returnDate, denda = 0) {
        fetch(`/bookings/return/${category}/${bookingId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    return_date: returnDate,
                    denda_per_hari: denda
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to confirm return');
                }
                return response.json();
            })
            .then(data => {
                Swal.fire(
                    'Berhasil!',
                    data.message,
                    'success'
                ).then(() => {
                    location.reload(); // Reload halaman setelah pengembalian berhasil
                });
            })
            .catch(error => {
                console

                console.error('Error:', error);
                Swal.fire(
                    'Error!',
                    'Gagal melakukan konfirmasi pengembalian. Silakan coba lagi nanti.',
                    'error'
                );
            });
    }
</script>
