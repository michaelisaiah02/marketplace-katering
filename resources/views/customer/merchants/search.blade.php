@extends('layouts.customer')

@section('content')
    <div class="container">
        <h1>Pencarian Katering</h1>

        <form action="{{ route('customer.merchants.search') }}" method="GET" class="mb-4">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <input type="text" name="name" class="form-control" placeholder="Nama Katering"
                        value="{{ request('name') }}">
                </div>
                <div class="col-md-4 mb-3">
                    <input type="text" name="location" class="form-control" placeholder="Lokasi"
                        value="{{ request('location') }}">
                </div>
                <div class="col-md-4 mb-3">
                    <input type="text" name="food_type" class="form-control" placeholder="Jenis Makanan"
                        value="{{ request('food_type') }}">
                </div>
                <div class="col-md-10">
                    <input type="text" name="address" class="form-control" placeholder="Alamat"
                        value="{{ request('address') }}">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Cari</button>
                </div>
            </div>
        </form>

        @if ($merchants->count())
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama Katering</th>
                        <th>Lokasi</th>
                        <th>Jenis Makanan</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($merchants as $merchant)
                        <tr>
                            <td>{{ $merchant->name }}</td>
                            <td>{{ $merchant->location }}</td>
                            <td>{{ $merchant->food_type }}</td>
                            <td><a href="{{ route('customer.merchant.show', $merchant->id) }}"
                                    class="btn btn-info btn-sm">Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div>
                {{ $merchants->links() }}
            </div>
        @else
            <p class="text-center">Tidak ada katering yang ditemukan.</p>
        @endif
    </div>
@endsection
