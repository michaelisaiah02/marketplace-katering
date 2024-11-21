@extends('layouts.user')

@section('title', 'Pesan Menu')

@section('content')
    <div class="container">
        <h1>Pesan Menu: {{ $menu->name }}</h1>

        <form action="{{ route('customer.orders.store', $menu->id) }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="quantity" class="form-label">Jumlah Porsi</label>
                <input type="number" name="quantity" id="quantity" class="form-control" min="1"
                    value="{{ old('quantity') }}" required>
                @error('quantity')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="delivery_date" class="form-label">Tanggal Pengiriman</label>
                <input type="date" name="delivery_date" id="delivery_date" class="form-control" required>
                @error('delivery_date')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Pesan</button>
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
