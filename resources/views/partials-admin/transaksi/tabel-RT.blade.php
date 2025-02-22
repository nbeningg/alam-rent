<!-- Main Content -->
<div id="content">
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Riwayat Transaksi</h1>
        </div>

        <!-- DataTables Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Riwayat Transaksi</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Penyewa</th>
                                <th>No. Telepon</th>
                                <th>Gambar</th>
                                <th>Merk</th>
                                <th>Tanggal Sewa</th>
                                <th>Tanggal Kembali</th>
                                <th>Harga</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bookings as $index => $booking)
                                <tr>
                                    <td>{{ $loop->iteration + ($bookings->currentPage() - 1) * $bookings->perPage() }}
                                    </td>
                                    <td>{{ $booking->user->name }}</td>
                                    <td>{{ $booking->user->phone }}</td>
                                    <td>
                                        @if ($booking->product)
                                            <img src="{{ Storage::url($booking->product->gambar) }}"
                                                alt="{{ $booking->product->merk }}" style="width: 100px;">
                                        @else
                                            <span>Gambar tidak tersedia</span>
                                        @endif
                                    </td>
                                    <td>{{ $booking->product ? $booking->product->merk : 'Merk tidak tersedia' }}</td>
                                    <td>{{ $booking->start_date }}</td>
                                    <td>{{ $booking->return_date }}</td>
                                    <td>Rp. {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                                    <td>{{ $booking->status }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Tampilkan pagination links -->
                <div class="d-flex justify-content-center">
                    {{ $bookings->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>
