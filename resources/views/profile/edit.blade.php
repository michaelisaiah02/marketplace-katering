@extends('layouts.user')

@section('content')
    <div class="container">
        <h1 class="text-light">Ubah Profil</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nama
                    {{ auth()->user()->isMerchant() ? 'Katering' : 'Perusahaan' }}</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    value="{{ old('name', $user->name) }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                    name="email" value="{{ old('email', $user->email) }}" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Alamat</label>
                <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                    name="address" value="{{ old('address', $user->address) }}">
                @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="contact" class="form-label">Kontak</label>
                <input type="tel" class="form-control @error('contact') is-invalid @enderror" id="contact"
                    name="contact" value="{{ old('contact', $user->contact) }}" pattern="[0-9]{12,13}"
                    placeholder="08xxxxxxxxxx">
                @error('contact')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            @if (auth()->user()->isMerchant())
                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                        rows="3">{{ old('description', $user->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            @endif

            <div class="d-flex justify-content-between">
                <a href="{{ route('dashboard') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
@endsection
