@extends('partials-admin.layouts.admin')

@section('content')
    <div id="content">
        <div class="container-fluid">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            </div>
            <div class="row">
                <!-- Keuangan Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <a href="{{ route('admin/keuangan') }}" class="card-link">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Keuangan
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Rp.
                                            {{ number_format($totalKeuangan, 0, ',', '.') }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-currency-dollar fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Pesanan Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <a href="{{ route('admin/riwayat-transaksi') }}" class="card-link">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            Pesanan
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalPesanan }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-cart-check-fill fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Customer Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <a href="{{ route('admin/customer') }}" class="card-link">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Customer
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalCustomer }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-person-hearts fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Contact Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <a href="{{ route('admin/pesan') }}" class="card-link">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                            Contact
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalContact }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-envelope-plus-fill fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
