@extends('layouts.app')

@section('title', $artikel->judul_klaim)

@section('content')
<article>
    <div class="page-header">
        <p style="text-transform: uppercase; letter-spacing: 0.08em; color: var(--muted); margin: 0 0 6px;">
            Klarifikasi Hoaks
        </p>
        <h1>{{ $artikel->judul_klaim }}</h1>
        <p>{{ $artikel->kategori?->nama ?? '-' }} • {{ $artikel->published_at?->format('d M Y') }}</p>
    </div>

    @if ($artikel->gambar_path)
        <div class="card" style="overflow: hidden; margin-bottom: 20px;">
            <img src="{{ asset('storage/' . $artikel->gambar_path) }}" alt="{{ $artikel->judul_klaim }}" style="width: 100%; height: 320px; object-fit: cover;">
        </div>
    @endif

    <div>
        <section class="card" style="padding: 22px; margin-bottom: 18px;">
            <h3 style="margin-top: 0;">Isi Klarifikasi</h3>
            <p style="color: var(--muted);">{!! nl2br(e($artikel->isi_klarifikasi)) !!}</p>
        </section>
        <aside class="card" style="padding: 22px;">
            <h3 style="margin-top: 0;">Rujukan</h3>
            @if ($artikel->sumber_rujukan)
                <p style="color: var(--muted);">{!! nl2br(e($artikel->sumber_rujukan)) !!}</p>
            @else
                <p style="color: var(--muted);">Sumber rujukan belum ditambahkan.</p>
            @endif
        </aside>
    </div>
</article>
@endsection
