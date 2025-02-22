<!-- Main Content -->
<div id="content">

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Pesan</h1>
        </div>

        <!-- DataTables Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Pesan</h6>
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
                                <th>Pesan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contacts as $key => $contact)
                                <tr>
                                    <td>{{ $loop->iteration + ($contacts->currentPage() - 1) * $contacts->perPage() }}
                                    </td>
                                    <td>{{ $contact->nama }}</td>
                                    <td>{{ $contact->email }}</td>
                                    <td>{{ $contact->phone }}</td>
                                    <td>{{ $contact->pesan }}</td>
                                    <td>
                                        <form action="{{ route('admin/pesan/destroy', $contact->id) }}" method="POST"
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
                    {{ $contacts->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
