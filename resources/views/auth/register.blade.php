@extends('layouts.auth')

@section('title', 'Register')

@section('content')
    <h2 class="text-center mb-4">Register</h2>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama Perusahaan</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>
        @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>
        @error('password')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
        </div>
        @error('password_confirmation')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="mb-3">
            <label for="address" class="form-label">Alamat</label>
            <textarea id="address" name="address" class="form-control" required></textarea>
        </div>
        @error('address')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="mb-3">
            <label for="contact" class="form-label">Nomor Telepon</label>
            <input type="text" id="contact" name="contact" class="form-control" required>
        </div>
        @error('contact')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="mb-3">
            <label for="role" class="form-label">Daftar Sebagai</label>
            <select id="role" name="role" class="form-select" required>
                <option value="customer">Customer</option>
                <option value="merchant">Merchant</option>
            </select>
        </div>
        <div class="mb-3" id="form-description">
            <label for="description">Deskripsi Katering</label>
            <textarea id="description" name="description" class="form-control"></textarea>
        </div>
        @error('description')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <button type="submit" class="btn btn-primary w-100">Daftar</button>
    </form>
    <div class="text-center mt-3">
        <p class="mb-0">Sudah punya akun? <a href="{{ route('login') }}" class="text-decoration-none">Login di sini</a>
        </p>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#form-description').hide();
            $('#role').change(function() {
                if ($(this).val() === 'customer') {
                    $('#form-description').hide();
                    $('#description').removeAttr('required');
                } else {
                    $('#form-description').show();
                    $('#description').attr('required', 'required');
                }
            });
        });
    </script>
@endsection
