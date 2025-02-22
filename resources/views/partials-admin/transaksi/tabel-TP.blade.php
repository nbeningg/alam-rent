<!-- Main Content -->
<div id="content">
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Top Pelanggan</h1>

        </div>

        <!-- DataTables Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Top Pelanggan</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Penyewa</th>
                                <th>No. Telepon</th>
                                <th>Total Barang Disewa</th>
                                <th>Total Pengeluaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($topCustomers as $index => $customer)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $customer->user->name }}</td>
                                    <td>{{ $customer->user->phone }}</td>
                                    <td>{{ $customer->total_products_rented }}</td>
                                    <td>Rp. {{ number_format($customer->total_spent, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
