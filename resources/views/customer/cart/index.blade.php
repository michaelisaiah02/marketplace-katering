@extends('layouts.user')

@section('title', 'Keranjang')

@section('content')
    <div class="container my-4">
        <h2 class="text-light">Keranjang Pesanan</h2>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if ($carts->isEmpty())
            <p class="text-light">Keranjang kosong.</p>
        @else
            <form action="{{ route('customer.orders.store') }}" method="POST">
                @csrf
                <table class="table table-striped table-responsive">
                    <thead>
                        <tr>
                            <th>Menu</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($carts as $cart)
                            <tr>
                                <td>{{ $cart->menu->name }}</td>
                                <td>Rp{{ number_format($cart->menu->price, 0, ',', '.') }}</td>
                                <td class="d-flex justify-content-start column-gap-2 align-items-center">
                                    <form></form>
                                    <form action="{{ route('customer.cart.store', $cart->menu->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" value="-" name="operator">
                                        <button class="btn btn-lg m-0 p-0" type="submit">
                                            <i class="bi bi-dash-square"></i>
                                        </button>
                                    </form>
                                    <input type="number" name="quantities[{{ $cart->id }}]"
                                        value="{{ $cart->quantity }}" min="1" class="form-control"
                                        style="width: 80px;" hidden>
                                    <span>{{ $cart->quantity }}</span>
                                    <form action="{{ route('customer.cart.store', $cart->menu->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" value="+" name="operator">
                                        <button class="btn btn-lg m-0 p-0" type="submit">
                                            <i class="bi bi-plus-square"></i>
                                        </button>
                                    </form>
                                </td>
                                <td>Rp{{ number_format($cart->menu->price * $cart->quantity, 0, ',', '.') }}</td>
                                <td>
                                    <form action="{{ route('customer.cart.destroy', $cart->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <h3 class="text-end">Total:
                    Rp{{ number_format(
                        $carts->sum(function ($cart) {
                            return $cart->menu->price * $cart->quantity;
                        }),
                        0,
                        ',',
                        '.',
                    ) }}
                </h3>

                <div class="row justify-content-end text-end">
                    <div class="col-auto">
                        <div class="mb-3">
                            <label for="delivery_date" class="form-label">Tanggal Pengiriman</label>
                            <input type="date" name="delivery_date" id="delivery_date"
                                class="form-control @error('delivery_date') is-invalid @enderror"
                                value="{{ old('delivery_date') }}" required>
                            @error('delivery_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('customer.dashboard') }}" class="btn btn-secondary">Lanjutkan Memilih Menu</a>
                    <button type="submit" class="btn btn-primary">Pesan</button>
                    @csrf
                </div>
            </form>
        @endif
    </div>
@endsection
