@extends('layouts.customer')

@section('content')
    <div class="container">
        <h1>Daftar Pesanan Anda</h1>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Menu</th>
                    <th>Jumlah</th>
                    <th>Tanggal Pengiriman</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                    <tr>
                        <td>{{ $order->menu->name }}</td>
                        <td>{{ $order->quantity }}</td>
                        <td>{{ $order->delivery_date }}</td>
                        <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                        <td>{{ ucfirst($order->status) }}</td>
                        @if ($order->status == 'Dalam Pengiriman')
                            <td>
                                <form action="{{ route('customer.order.updateStatus', $order->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="status" value="Diterima">
                                    <button type="submit" class="btn btn-success btn-sm">Terima Pesanan</button>
                                </form>
                            </td>
                        @endif
                        <td>
                            <a href="{{ route('merchant.orders.invoice', $order->id) }}" class="btn btn-primary btn-sm">
                                Lihat Invoice
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Belum ada pesanan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
