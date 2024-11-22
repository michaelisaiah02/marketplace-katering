@extends('layouts.user')

@section('title', 'Dashboard Merchant')

@section('content')
    <div class="container">
        <h1 class="my-4 text-light">Dashboard Merchant</h1>

        <div class="row mb-4">
            <div class="col-md-4 mb-3">
                <div class="card text-bg-warning">
                    <div class="card-body">
                        <h5 class="card-title">Pesanan Baru</h5>
                        <p class="card-text">{{ $newOrders }}</p>
                        <a href="{{ route('merchant.orders.index') }}" class="btn btn-light">Lihat Pesanan</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card text-bg-success">
                    <div class="card-body">
                        <h5 class="card-title">Pesanan Selesai</h5>
                        <p class="card-text">{{ $completedOrders }}</p>
                        <a href="{{ route('merchant.orders.index') }}" class="btn btn-light">Lihat Pesanan</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card text-bg-primary">
                    <div class="card-body">
                        <h5 class="card-title">Total Pendapatan</h5>
                        <p class="card-text">Rp{{ number_format($totalRevenue, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <a href="{{ route('merchant.menus.index') }}" class="btn btn-success w-100">Kelola Menu</a>
            </div>
            <div class="col-md-6 mb-3">
                <a href="{{ route('merchant.orders.index') }}" class="btn btn-info w-100">Kelola Pesanan</a>
            </div>
        </div>
    </div>
@endsection
