@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4">Dashboard Merchant</h1>

        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Pesanan Baru</h5>
                        <p class="card-text">{{ $newOrdersCount }}</p>
                        <a href="{{ route('merchant.orders.index') }}" class="btn btn-primary">Lihat Pesanan</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Pesanan Selesai</h5>
                        <p class="card-text">{{ $completedOrdersCount }}</p>
                        <a href="{{ route('merchant.orders.index') }}" class="btn btn-primary">Lihat Pesanan</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Pendapatan</h5>
                        <p class="card-text">Rp{{ number_format($totalRevenue, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <a href="{{ route('merchant.menus.index') }}" class="btn btn-success btn-lg w-100 mb-3">Kelola Menu</a>
            </div>
            <div class="col-md-6">
                <a href="{{ route('merchant.orders.index') }}" class="btn btn-info btn-lg w-100">Lihat Daftar Pesanan</a>
            </div>
        </div>
    </div>
@endsection
