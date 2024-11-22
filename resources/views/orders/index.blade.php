@extends('layouts.user')

@section('title', 'Daftar Pesanan')

@section('content')
    <div class="container mt-4">
        <h1>Daftar Pesanan</h1>

        @if ($orders->isEmpty())
            @if (auth()->user()->isCustomer())
                <p class="text-muted">Belum pernah memesan.</p>
            @else
                <p class="text-muted">Belum ada pesanan.</p>
            @endif
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID Pesanan</th>
                        @if (auth()->user()->isMerchant())
                            <th>Pelanggan</th>
                        @else
                            <th>Merchant</th>
                        @endif
                        <th>Status</th>
                        <th>Total Harga</th>
                        <th>Tanggal Pengiriman</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            @if (auth()->user()->isMerchant())
                                <td>{{ $order->customer->name }}</td>
                            @else
                                <td>{{ $order->merchant->name }}</td>
                            @endif
                            <td>{{ $order->getStatusLabel() }}</td>
                            <td>Rp{{ number_format($order->total_price, 0, ',', '.') }}</td>
                            <td>{{ $order->delivery_date }}</td>
                            <td class="d-flex justify-content-evenly">
                                <!-- Tombol Invoice -->
                                <a href="{{ route('orders.invoice', $order->id) }}" class="btn btn-primary btn">Invoice</a>

                                <!-- Tombol Ubah Status -->
                                @if (auth()->user()->isMerchant())
                                    @if ($order->status === 'pending')
                                        <form method="POST" action="{{ route('orders.updateStatus', $order) }}">
                                            @csrf
                                            <input type="hidden" name="status" value="confirmed">
                                            <button type="submit" class="btn btn-success">Konfirmasi</button>
                                        </form>
                                        <form method="POST" action="{{ route('orders.updateStatus', $order) }}">
                                            @csrf
                                            <input type="hidden" name="status" value="cancelled">
                                            <button type="submit" class="btn btn-danger">Batalkan</button>
                                        </form>
                                    @elseif ($order->status === 'confirmed')
                                        <form method="POST" action="{{ route('orders.updateStatus', $order) }}">
                                            @csrf
                                            <input type="hidden" name="status" value="in_progress">
                                            <button type="submit" class="btn btn-primary">Proses</button>
                                        </form>
                                    @endif
                                @endif

                                @if (auth()->user()->isCustomer())
                                    @if ($order->status === 'pending')
                                        <form method="POST" action="{{ route('orders.updateStatus', $order->id) }}"
                                            class="d-inline">
                                            @csrf
                                            <input type="hidden" name="status" value="cancelled">
                                            <button type="submit" class="btn btn-danger btn-sm">Batalkan</button>
                                        </form>
                                    @elseif ($order->status === 'in_progress')
                                        <form method="POST" action="{{ route('orders.updateStatus', $order) }}">
                                            @csrf
                                            <input type="hidden" name="status" value="completed">
                                            <button type="submit" class="btn btn-success">Selesaikan</button>
                                        </form>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
