<div id="content">

    <div class="container-fluid">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Data Customer</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin/customer/update', $customers->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Nama:</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ $customers->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="text" class="form-control" id="email" name="email"
                            value="{{ $customers->email }}" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">No.Telepon:</label>
                        <input type="text" class="form-control" id="phone" name="phone"
                            value="{{ $customers->phone }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Edit</button>
                    <a href="{{ route('admin/customer') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
