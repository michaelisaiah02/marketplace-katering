@extends('layouts.user')

@section('title', 'Menu Merchant')

@section('content')
    <div class="container my-4">
        <h2>Menu dari {{ $merchant->name }}</h2>

        @if ($menus->isEmpty())
            <p>Merchant ini belum memiliki menu.</p>
        @else
            <div class="row">
                @foreach ($menus as $menu)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            @if ($menu->image_path)
                                <img src="{{ asset('storage/' . $menu->image_path) }}" class="card-img-top"
                                    alt="{{ $menu->name }}" style="height: 250px; object-fit: cover;">
                            @else
                                <img src="{{ asset('images/default-menu.png') }}" class="card-img-top"
                                    alt="{{ $menu->name }}" style="height: 250px; object-fit: cover;">
                            @endif
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $menu->name }}</h5>
                                <p class="card-text">Harga: {{ number_format($menu->price, 0, ',', '.') }} IDR</p>
                                <div class="mt-auto">
                                    <form action="{{ route('customer.cart.store', $menu->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary w-100">Tambah ke Keranjang</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
