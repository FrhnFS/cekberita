@extends('layouts.app')

@section('title', 'Layanan Cek Hoaks')

@section('content')
<section class="hero">
    <div class="container">
        <h1>Tolak hoaks, <span class="highlight">cek</span> dulu benar atau tidak.</h1>
        <p class="subtitle">Layanan cek hoaks Diskominfo Jawa Barat yang bersifat informatif dan telah diverifikasi manual.</p>
        <a href="https://t.me/CekBeritabot" class="btn-primary hero-btn" target="_blank" rel="noopener">Cek via Chatbot Telegram</a>
    </div>
</section>

<section class="how-it-works">
    <div class="container">
        <h2>Cara Kerja Layanan</h2>
        <p class="section-subtitle">Langkah sederhana untuk mengecek klaim.</p>

        <div class="steps">
            <div class="step">
                <div class="step-icon">1</div>
                <h3>Kirim pesan</h3>
                <p>Kirimkan klaim atau tautan ke chatbot Telegram.</p>
            </div>
            <div class="step">
                <div class="step-icon">2</div>
                <h3>Baca klarifikasi</h3>
                <p>Temukan ringkasan fakta dan sumber rujukan.</p>
            </div>
            <div class="step">
                <div class="step-icon">3</div>
                <h3>Bagikan info benar</h3>
                <p>Bantu meluruskan informasi di lingkunganmu.</p>
            </div>
        </div>
    </div>
</section>

<section class="info">
    <div class="container">
        <div class="page-header" style="display: flex; justify-content: space-between; align-items: center; gap: 16px; flex-wrap: wrap;">
            <div>
                <h1>Artikel Terbaru</h1>
                <p>Artikel hoaks terbaru yang sudah diverifikasi manual.</p>
            </div>
            <a class="btn-secondary" href="{{ route('artikel.index') }}">Selengkapnya</a>
        </div>

        @if ($artikels->isEmpty())
            <div class="card" style="padding: 16px;">
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
        @endif
    </div>
</section>

<section class="chatbot">
    <div class="container">
        <div class="feature-tag">Cek Awal via Telegram</div>
        <div class="chatbot-content">
            <div class="chatbot-text">
                <h2>Cek dulu lewat chatbot Telegram.</h2>
                <p>Kirimkan klaim atau tautan ke chatbot. Kamu akan diarahkan ke artikel klarifikasi yang sudah diverifikasi oleh tim.</p>
                <div class="cta-row">
                    <a href="https://t.me/CekBeritabot" class="btn-primary" target="_blank" rel="noopener">Buka Chatbot Telegram</a>
                    <a href="{{ route('artikel.index') }}" class="btn-secondary">Lihat Artikel</a>
                </div>
            </div>
            <div class="chatbot-image">
                <img src="https://images.unsplash.com/photo-1520607162513-77705c0f0d4a?q=80&w=1200&auto=format&fit=crop" alt="Contoh chatbot Telegram">
            </div>
        </div>
    </div>
</section>

<footer>
    <div class="container">
        <div class="footer-content">
            <div class="footer-logo">
                <div class="logo">cekhoaks</div>
            </div>
            <div class="copyright">
                <p>(c) CekHoaks Jabar 2024</p>
            </div>
        </div>
    </div>
</footer>
@endsection
