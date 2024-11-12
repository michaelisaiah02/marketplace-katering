@extends('layouts.merchant')

@section('content')
    <div class="container">
        <h2>Invoice #{{ $order->id }}</h2>
        <p><strong>Customer:</strong> {{ $order->customer->name }}</p>
        <p><strong>Menu:</strong> {{ $order->menu->name }}</p>
        <p><strong>Jumlah Porsi:</strong> {{ $order->quantity }}</p>
        <p><strong>Tanggal Pengiriman:</strong> {{ $order->delivery_date }}</p>
        <p><strong>Total Harga:</strong> {{ $order->total_price }}</p>
        <p><strong>Status:</strong> {{ $order->status }}</p>
    </div>
@endsection
