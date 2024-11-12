@extends('layouts.merchant')

@section('content')
    <div class="container">
        <h2>Daftar Order</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Customer</th>
                    <th>Menu</th>
                    <th>Jumlah Porsi</th>
                    <th>Tanggal Pengiriman</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th>Invoice</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->customer->name }}</td>
                        <td>{{ $order->menu->name }}</td>
                        <td>{{ $order->quantity }}</td>
                        <td>{{ $order->delivery_date }}</td>
                        <td>{{ $order->total_price }}</td>
                        <td>{{ $order->status }}</td>
                        @if ($order->status == 'Menunggu Konfirmasi')
                            <td>
                                <form action="{{ route('merchant.order.updateStatus', $order->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="status" value="Terkonfirmasi">
                                    <button type="submit" class="btn btn-primary btn-sm">Konfirmasi</button>
                                </form>
                            </td>
                        @elseif($order->status == 'Terkonfirmasi')
                            <td>
                                <form action="{{ route('merchant.order.updateStatus', $order->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="status" value="Sedang Persiapan">
                                    <button type="submit" class="btn btn-primary btn-sm">Mulai Persiapan</button>
                                </form>
                            </td>
                        @elseif($order->status == 'Sedang Persiapan')
                            <td>
                                <form action="{{ route('merchant.order.updateStatus', $order->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="status" value="Dalam Pengiriman">
                                    <button type="submit" class="btn btn-primary btn-sm">Kirim</button>
                                </form>
                            </td>
                        @endif
                        <td>
                            <a href="{{ route('merchant.orders.invoice', $order->id) }}" class="btn btn-primary btn-sm">
                                Lihat Invoice
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
