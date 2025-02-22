<!-- Main Content -->
<div id="content">

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Tambah Data Form -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tambah Data Testimoni</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin/testimoni/store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="gambar">Gambar:</label>
                        <input type="file" class="form-control-file" id="gambar" name="gambar" required>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama:</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="testimoni">Testimoni</label>
                        <input type="text" class="form-control" id="testimoni" name="testimoni" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('admin/testimoni') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
