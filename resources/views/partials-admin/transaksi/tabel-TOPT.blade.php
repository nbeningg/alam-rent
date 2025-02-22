<!-- Main Content -->
<div id="content">
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Top Transaksi</h1>
        </div>

        <!-- DataTables Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Top Transaksi</h6>
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
                                <th>Total Pengeluaran</th>
                                <th>Tanggal Transaksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($topTransactions as $index => $transaction)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $transaction->user->name }}</td>
                                    <td>{{ $transaction->user->phone }}</td>
                                    <td>
                                        @php
                                            $product = null;
                                            switch ($transaction->category) {
                                                case 'Ransel':
                                                    $product = \App\Models\Ransel::find($transaction->product_id);
                                                    break;
                                                case 'Tas':
                                                    $product = \App\Models\Tas::find($transaction->product_id);
                                                    break;
                                                case 'Sepatu':
                                                    $product = \App\Models\Sepatu::find($transaction->product_id);
                                                    break;
                                                case 'Pakaian':
                                                    $product = \App\Models\Pakaian::find($transaction->product_id);
                                                    break;
                                                case 'Tenda':
                                                    $product = \App\Models\Tenda::find($transaction->product_id);
                                                    break;
                                            }
                                        @endphp

                                        @if ($product)
                                            <img src="{{ Storage::url($product->gambar) }}" alt="{{ $product->merk }}"
                                                style="width: 100px;">
                                        @else
                                            <span>Gambar tidak tersedia</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($product)
                                            {{ $product->merk }}
                                        @else
                                            <span>Merk tidak tersedia</span>
                                        @endif
                                    </td>
                                    <td>Rp. {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                                    <td>{{ $transaction->created_at->format('d-m-Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
