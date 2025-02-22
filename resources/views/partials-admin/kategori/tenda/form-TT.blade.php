<!-- Main Content -->
<div id="content">

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Tambah Data Form -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tambah Data Tenda</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin/tenda/store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="gambar">Gambar:</label>
                        <input type="file" class="form-control-file" id="gambar" name="gambar" required>
                    </div>
                    <div class="form-group">
                        <label for="merk">Merk:</label>
                        <input type="text" class="form-control" id="merk" name="merk" required>
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga:</label>
                        <input type="text" class="form-control" id="harga" name="harga" required>
                    </div>
                    <div class="form-group">
                        <label for="denda">Denda:</label>
                        <input type="text" class="form-control" id="denda" name="denda" required>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi:</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="status">Status:</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="0">Tersedia</option> <!-- Nilai 0 untuk 'Tersedia' -->
                            <option value="1">Tidak Tersedia</option> <!-- Nilai 1 untuk 'Tidak Tersedia' -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="category">Kategori:</label>
                        <select class="form-control" id="category" name="category" required>
                            <option value="">Pilih Kategori</option>
                            <option value="Ransel">Ransel</option>
                            <option value="Pakaian">Pakaian</option>
                            <option value="Sepatu">Sepatu</option>
                            <option value="Tenda">Tenda</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('admin/tenda') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
