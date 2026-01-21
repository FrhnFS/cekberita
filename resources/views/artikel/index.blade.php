@extends('layouts.app')

@section('title', 'Daftar Artikel Hoaks')

@section('content')
<div class="page-header">
    <h1>Artikel Terbaru</h1>
    <p>Ringkasan klaim dan klarifikasinya. Klik judul untuk membaca detail dan rujukan resmi.</p>
</div>

@if ($artikels->isEmpty())
    <div class="card" style="padding: 20px;">
        <p style="margin: 0; color: var(--muted);">Belum ada artikel yang dipublikasikan.</p>
    </div>
@else
    <div class="article-grid">
        @foreach ($artikels as $artikel)
            <article class="article-card">
                <a href="{{ route('artikel.show', $artikel) }}" aria-label="Buka detail: {{ $artikel->judul_klaim }}">
                    @if ($artikel->gambar_path)
                        <img class="article-thumb" src="{{ asset('storage/' . $artikel->gambar_path) }}" alt="{{ $artikel->judul_klaim }}">
                    @else
                        <div class="article-thumb"></div>
                    @endif
                    <div class="article-body">
                    <div class="article-meta">
                        <span>{{ $artikel->kategori?->nama ?? '-' }}</span>
                        <span>{{ $artikel->published_at?->format('d M Y') }}</span>
                    </div>
                        <div class="article-title">{{ $artikel->judul_klaim }}</div>
                        <p class="article-excerpt">{{ $artikel->ringkasan_klarifikasi }}</p>
                    </div>
                </a>
            </article>
        @endforeach
    </div>

    <div style="margin-top: 20px;">
        {{ $artikels->links() }}
    </div>
@endif
@endsection
