@extends('layouts.user')

@section('title', 'Invoice')

@section('content')
    <div class="container mt-4">
        <h1 class="text-light">Invoice</h1>
        <p><strong>ID Pesanan:</strong> {{ $order->id }}</p>
        <p><strong>Pelanggan:</strong> {{ $order->customer->name }}</p>
        <p><strong>Merchant:</strong> {{ $order->merchant->name }}</p>
        <p><strong>Tanggal Pengiriman:</strong> {{ $order->delivery_date }}</p>
        <p><strong>Status:</strong> {{ $order->getStatusLabel() }}</p>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Menu</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->items as $item)
                    <tr>
                        <td>{{ $item->menu->name }}</td>
                        <td>Rp{{ number_format($item->menu->price, 0, ',', '.') }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>Rp{{ number_format($item->menu->price * $item->quantity, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p><strong>Total Harga:</strong> Rp{{ number_format($order->total_price, 0, ',', '.') }}</p>

        <a href="{{ route('orders.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
@endsection
