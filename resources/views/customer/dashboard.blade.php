@extends('layouts.user')

@section('title', 'Dashboard Customer')

@section('content')
    <h1 class="text-light">Dashboard Customer</h1>

    <div class="row my-4">
        <div class="col-lg-6 mb-3">
            <a href="{{ route('orders.index') }}" class="btn btn-primary w-100">Lihat Riwayat Pesanan</a>
        </div>
        <div class="col-lg-6 mb-3">
            <a href="{{ route('customer.merchants.search') }}" class="btn btn-success w-100">Cari Merchant</a>
        </div>
    </div>

    <!-- Hasil Pencarian -->
    @if ($query)
        <h2 class="text-light">Hasil Pencarian untuk "{{ $query }}"</h2>
        @if ($menus->isEmpty())
            <p class="text-light">Tidak ada menu ditemukan.</p>
        @endif
    @else
        <h2 class="text-light">Daftar Menu</h2>
    @endif

    <!-- List Menu -->
    <div class="row">
        @foreach ($menus as $menu)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ $menu->image_path ? asset('storage/' . $menu->image_path) : asset('images/default-menu.png') }}"
                        class="card-img-top" style="height: 250px; object-fit: cover" alt="Menu Image">
                    <div class="card-body">
                        <h5 class="card-title">{{ $menu->name }}</h5>
                        <p class="card-text">Rp{{ number_format($menu->price, 0, ',', '.') }}</p>
                        <p class="card-text"><small class="text-muted">Merchant: {{ $menu->merchant->name }}</small></p>
                        <form action="{{ route('customer.cart.store', $menu->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary w-100">Tambah ke Keranjang</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
