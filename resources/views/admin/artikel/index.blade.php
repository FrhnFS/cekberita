@extends('layouts.app')

@section('title', 'Kelola Artikel Hoaks')

@section('content')
<div class="card" style="padding: 20px; margin-bottom: 16px;">
    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px;">
        <div>
            <p style="text-transform: uppercase; letter-spacing: 0.08em; color: var(--muted); margin: 0 0 6px;">
                Admin Panel
            </p>
            <h1 style="margin: 0;">Kelola Artikel Hoaks</h1>
        </div>
        <a class="btn-primary" href="{{ route('admin.artikel.create') }}">Tambah Artikel</a>
    </div>
</div>

@if (session('status'))
    <div class="card" style="padding: 12px; border-color: #c9e7d7; background: #f1fbf5; margin-bottom: 12px;">
        {{ session('status') }}
    </div>
@endif

@if ($artikels->isEmpty())
    <div class="card" style="padding: 16px;">
        <p style="margin: 0; color: var(--muted);">Belum ada artikel yang tersimpan.</p>
    </div>
@else
    <div class="card" style="overflow: hidden;">
        <table>
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Publikasi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($artikels as $artikel)
                    <tr>
                        <td>{{ $artikel->judul_klaim }}</td>
                        <td>{{ $artikel->kategori?->nama ?? '-' }}</td>
                        <td>{{ $artikel->published_at?->format('d M Y') }}</td>
                        <td>
                            <a href="{{ route('admin.artikel.edit', $artikel) }}">Edit</a>
                            <form method="post" action="{{ route('admin.artikel.destroy', $artikel) }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-secondary" style="padding: 6px 12px;" onclick="return confirm('Hapus artikel ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div style="margin-top: 16px;">
        {{ $artikels->links() }}
    </div>
@endif
@endsection
