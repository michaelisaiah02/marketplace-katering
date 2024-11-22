@extends('layouts.user')

@section('title', 'Cari Merchant')

@section('content')
    <div class="container my-4">
        <h2>Cari Merchant</h2>

        <form action="{{ route('customer.merchants.search') }}" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" name="query" class="form-control" placeholder="Cari merchant berdasarkan nama..."
                    value="{{ $query }}">
                <button class="btn btn-primary" type="submit">Cari</button>
            </div>
        </form>

        @if ($merchants->isEmpty())
            <p>Tidak ada merchant ditemukan.</p>
        @else
            <div class="row">
                @foreach ($merchants as $merchant)
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $merchant->name }}</h5>
                                <p class="card-text"><strong>Kontak:</strong> {{ $merchant->contact }}</p>
                                <a href="{{ route('customer.merchants.show', $merchant->id) }}"
                                    class="btn btn-success">Lihat Menu</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="d-flex justify-content-center">
                {{ $merchants->appends(['query' => $query])->links() }}
            </div>
        @endif
    </div>
@endsection
