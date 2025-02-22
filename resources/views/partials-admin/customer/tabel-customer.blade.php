<!-- Main Content -->
<div id="content">

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Customer</h1>
        </div>

        <!-- DataTables Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Customer</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>No. Telepon</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $key => $customer)
                                <tr>
                                    <td>{{ $loop->iteration + ($customers->currentPage() - 1) * $customers->perPage() }}
                                    </td>
                                    <td>{{ $customer->name }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>{{ $customer->phone }}</td>
                                    <td>
                                        <a href="{{ route('admin/customer/edit', $customer->id) }}"
                                            class="btn btn-warning btn-sm">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>
                                        <form action="{{ route('admin/customer/destroy', $customer->id) }}"
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
                        </tbody>
                    </table>
                </div>
                <!-- Tampilkan pagination links -->
                <div class="d-flex justify-content-center">
                    {{ $customers->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
