@extends('layouts.user')

@section('title', 'Detail Katering')

@section('content')
    <div class="container">
        <h1>Detail Katering: {{ $merchant->name }}</h1>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Informasi Katering</h5>
                <p><strong>Nama Katering:</strong> {{ $merchant->name }}</p>
                <p><strong>Lokasi:</strong> {{ $merchant->location }}</p>
                <p><strong>Jenis Makanan:</strong> {{ $merchant->food_type }}</p>
                <p><strong>Deskripsi:</strong> {{ $merchant->description }}</p>
            </div>
        </div>

        <h2 class="mt-4">Menu Katering</h2>
        @if ($merchant->menus->count())
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Menu</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($merchant->menus as $menu)
                        <tr>
                            <td>{{ $menu->name }}</td>
                            <td>{{ $menu->price }}</td>
                            <td><a href="{{ route('customer.orders.create', ['merchant' => $merchant->id, 'menu' => $menu->id]) }}"
                                    class="btn btn-primary btn-sm">Pesan</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-center">Tidak ada menu yang tersedia.</p>
        @endif
    </div>
@endsection
