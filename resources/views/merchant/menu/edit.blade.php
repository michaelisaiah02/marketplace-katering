@extends('layouts.merchant')

@section('content')
    <div class="container">
        <h1>Edit Menu</h1>

        <form action="{{ route('merchant.menus.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Nama Menu</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $menu->name) }}"
                    required>
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea name="description" id="description" class="form-control" rows="3" required>{{ old('description', $menu->description) }}</textarea>
                @error('description')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="photo" class="form-label">Foto</label>
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $menu->photo) }}" alt="{{ $menu->name }}" width="150">
                </div>
                <input type="file" name="photo" id="photo" class="form-control">
                @error('photo')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Harga</label>
                <input type="number" name="price" id="price" class="form-control"
                    value="{{ old('price', $menu->price) }}" required>
                @error('price')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Perbarui</button>
            <a href="{{ route('merchant.menus.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
