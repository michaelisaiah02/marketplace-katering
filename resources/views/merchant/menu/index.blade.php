@extends('layouts.merchant')

@section('content')
    <h1>Daftar Menu</h1>
    <a href="{{ route('merchant.menus.create') }}" class="btn btn-primary">Tambah Menu</a>

    <table class="table">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($menus as $menu)
                <tr>
                    <td><img src="{{ asset('storage/' . $menu->photo) }}" alt="{{ $menu->name }}" width="100"></td>
                    <td>{{ $menu->name }}</td>
                    <td>{{ $menu->description }}</td>
                    <td>{{ $menu->price }}</td>
                    <td>
                        <a href="{{ route('merchant.menus.edit', $menu->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('merchant.menus.destroy', $menu->id) }}" method="POST"
                            style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
