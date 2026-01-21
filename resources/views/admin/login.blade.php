@extends('layouts.app')

@section('title', 'Login Admin')

@section('content')
<div style="min-height: 60vh; display: flex; align-items: center; justify-content: center;">
    <div class="card" style="padding: 26px; max-width: 460px; width: 100%;">
        <p style="text-transform: uppercase; letter-spacing: 0.08em; color: var(--muted); margin: 0 0 6px;">
            Admin Panel
        </p>
        <h1 style="margin: 0 0 6px;">Login Admin</h1>
        <p style="margin: 0 0 16px; color: var(--muted);">
            Akses khusus untuk tim pengelola klarifikasi.
        </p>

        @if ($errors->any())
            <div class="card" style="padding: 12px; border-color: #f3d4d4; background: #fff5f5; margin-bottom: 12px;">
                <ul style="margin: 0; padding-left: 18px; color: #a33434;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="post" action="{{ route('admin.login.submit') }}" style="margin-top: 6px;">
            @csrf
            <label>Email
                <input type="email" name="email" value="{{ old('email') }}" required>
            </label>
            <label>Password
                <input type="password" name="password" required>
            </label>
            <button class="btn-primary" type="submit" style="width: 100%;">Masuk</button>
        </form>
    </div>
</div>
@endsection
