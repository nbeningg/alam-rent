<!-- Main Content -->
<div id="content">

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Testimoni</h1>
            <a href="{{ route('admin/testimoni/create') }}" class="btn btn-primary">
                <i class="bi bi-plus-square-fill"></i> Tambah Data
            </a>
        </div>

        <!-- DataTables Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Testimoni</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Gambar</th>
                                <th>Nama</th>
                                <th>Testimoni</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($testimoni->count() > 0)
                                @foreach ($testimoni as $data)
                                    <tr>
                                        <td>{{ $loop->iteration + ($testimoni->currentPage() - 1) * $testimoni->perPage() }}
                                        </td>
                                        <td><img src="{{ Storage::url($data->gambar) }}" width="50"></td>
                                        <td>{{ $data->nama }}</td>
                                        <td>{{ $data->testimoni }}</td>
                                        <td>
                                            <a href="{{ route('admin/testimoni/edit', $data->id) }}"
                                                class="btn btn-warning btn-sm">
                                                <i class="bi bi-pencil-square"></i> Edit
                                            </a>
                                            <form action="{{ route('admin/testimoni/destroy', $data->id) }}"
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
                                    <td class="text-center" colspan="8">Data testimoni tidak ditemukan</td>
                                </tr>
                            @endif

                        </tbody>
                    </table>
                </div>
                <!-- Tampilkan pagination links -->
                <div class="d-flex justify-content-center">
                    {{ $testimoni->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
    <!-- End of Main Content -->
</div>
<!-- End of Main Content -->
