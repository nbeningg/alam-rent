<div id="content">

    <div class="container-fluid">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Data Testimoni</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin/testimoni/update', $testimoni->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <img src="{{ Storage::url($testimoni->gambar) }}" class="img-fluid" width="100">
                    </div>
                    <div class="form-group">
                        <label for="gambar">Gambar:</label>
                        <input type="file" class="form-control-file" id="gambar" name="gambar">
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama:</label>
                        <input type="text" class="form-control" id="nama" name="nama"
                            value="{{ $testimoni->nama }}" required>
                    </div>
                    <div class="form-group">
                        <label for="testimoni">Testimoni:</label>
                        <input type="text" class="form-control" id="testimoni" name="testimoni"
                            value="{{ $testimoni->testimoni }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Edit</button>
                    <a href="{{ route('admin/testimoni') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
