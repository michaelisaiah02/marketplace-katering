@extends('layouts.user')

@section('title', 'Edit Menu')

@section('content')
    <div class="container">
        <h1 class="my-4">Edit Menu</h1>

        <form action="{{ route('merchant.menus.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="mb-3">
                <label for="name" class="form-label">Nama Menu</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name', $menu->name) }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror">{{ old('description', $menu->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Harga</label>
                <input type="number" name="price" id="price"
                    class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $menu->price) }}">
                @error('price')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="photo" class="form-label">Foto Menu</label>
                <input type="file" name="photo" id="photo"
                    class="form-control @error('photo') is-invalid @enderror">
                @if ($menu->photo)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $menu->photo) }}" alt="Foto Menu" style="width: 150px;">
                    </div>
                @endif
                @error('photo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('merchant.menus.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
