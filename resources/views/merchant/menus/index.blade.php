@extends('layouts.user')

@section('content')
    <div class="container">
        <h1 class="my-4 text-light">Daftar Menu</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('merchant.menus.create') }}" class="btn btn-primary mb-3">Tambah Menu</a>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Deskripsi</th>
                    <th>Harga</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($menus as $menu)
                    <tr>
                        <td>{{ $menu->name }}</td>
                        <td>{{ $menu->description }}</td>
                        <td>Rp{{ number_format($menu->price, 0, ',', '.') }}</td>
                        <td>
                            @if ($menu->image_path)
                                <img src="{{ asset('storage/' . $menu->image_path) }}" alt="Foto Menu" style="width: 100px;">
                            @else
                                Tidak Ada
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('merchant.menus.edit', $menu->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('merchant.menus.destroy', $menu->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Hapus menu ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">Tidak ada menu.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
