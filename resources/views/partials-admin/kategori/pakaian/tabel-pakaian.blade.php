<!-- Main Content -->
<div id="content">


    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Pakaian</h1>
            <a href="{{ route('admin/pakaian/create') }}" class="btn btn-primary">
                <i class="bi bi-plus-square-fill"></i> Tambah Data
            </a>
        </div>

        <!-- DataTables Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Pakaian</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Gambar</th>
                                <th>Merk</th>
                                <th>Harga</th>
                                <th>Denda</th>
                                <th>Deskripsi</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($pakaian->count() > 0)
                                @foreach ($pakaian as $item)
                                    <tr>
                                        <td>{{ $loop->iteration + ($pakaian->currentPage() - 1) * $pakaian->perPage() }}
                                        </td>
                                        <td><img src="{{ Storage::url($item->gambar) }}" width="50"></td>
                                        <td>{{ $item->merk }}</td>
                                        <td>Rp. {{ number_format($item->harga, 0, ',', '.') }}</td>
                                        <td>Rp. {{ number_format($item->denda, 0, ',', '.') }}</td>
                                        <td>{{ $item->deskripsi }}</td>
                                        <td>
                                            @php
                                                // Dapatkan semua booking yang terkait dengan produk ini
                                                $bookings = \App\Models\Booking::where('category', 'Pakaian')
                                                    ->where('product_id', $item->id)
                                                    ->get();

                                                // Inisialisasi variabel status default
                                                $status = 'available';

                                                // Periksa apakah ada pemesanan yang berhubungan dengan produk ini
                                                if ($bookings->isNotEmpty()) {
                                                    // Ambil status pemesanan yang paling baru
                                                    $latestStatus = $bookings->last()->status;

                                                    // Atur status berdasarkan status pemesanan yang paling baru
                                                    switch ($latestStatus) {
                                                        case 'ongoing':
                                                            $status = 'not_available';
                                                            break;
                                                        case 'cancelled':
                                                        case 'returned_late':
                                                        case 'returned_on_time':
                                                            $status = 'available';
                                                            break;
                                                    }
                                                }
                                            @endphp
                                            <button
                                                class="btn btn-{{ $status == 'available' ? 'success' : 'danger' }} btn-sm">{{ $status == 'available' ? 'Tersedia' : 'Tidak Tersedia' }}</button>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin/pakaian/edit', $item->id) }}"
                                                class="btn btn-warning btn-sm">
                                                <i class="bi bi-pencil-square"></i> Edit
                                            </a>
                                            <form action="{{ route('admin/pakaian/destroy', $item->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')"
                                                style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="bi bi-trash3-fill"></i> Hapus
                                                </button>
                                            </form>
                                        </td>

                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="text-center" colspan="8">Data ransel tidak ditemukan</td>
                                </tr>
                            @endif

                        </tbody>
                    </table>
                </div>
                <!-- Tampilkan pagination links -->
                <div class="d-flex justify-content-center">
                    {{ $pakaian->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
    <!-- End of Main Content -->
</div>
<!-- End of Main Content -->
