<div id="content">

    <div class="container-fluid">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Data Pakaian</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin/pakaian/update', $pakaian->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <img src="{{ Storage::url($pakaian->gambar) }}" class="img-fluid" width="100">
                    </div>
                    <div class="form-group">
                        <label for="gambar">Gambar:</label>
                        <input type="file" class="form-control-file" id="gambar" name="gambar">
                    </div>
                    <div class="form-group">
                        <label for="merk">Merk:</label>
                        <input type="text" class="form-control" id="merk" name="merk"
                            value="{{ $pakaian->merk }}" required>
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga:</label>
                        <input type="text" class="form-control" id="harga" name="harga"
                            value="{{ $pakaian->harga }}" required>
                    </div>
                    <div class="form-group">
                        <label for="denda">Denda:</label>
                        <input type="text" class="form-control" id="denda" name="denda"
                            value="{{ $pakaian->denda }}" required>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi:</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" required>{{ $pakaian->deskripsi }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="status">Status:</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="0" {{ $pakaian->status === 0 ? 'selected' : '' }}>Tersedia</option>
                            <option value="1" {{ $pakaian->status === 1 ? 'selected' : '' }}>Tidak Tersedia
                            </option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Edit</button>
                    <a href="{{ route('admin/pakaian') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
