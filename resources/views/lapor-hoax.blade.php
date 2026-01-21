@extends('layouts.app')

@section('title', 'Lapor Hoax')

@section('content')
<section class="report-section">
    <div class="container">
        <h1>Lapor Hoax</h1>
        <div class="report-grid" style="margin-top: 16px;">
            <div class="report-media">
                <img src="https://images.unsplash.com/photo-1453873531674-2151bcd01707?q=80&w=1200&auto=format&fit=crop" alt="Ilustrasi laporan hoax">
            </div>
            <div class="report-card">
                <h3>Saluran Pelaporan</h3>
                <p style="color: var(--muted); margin-top: 8px;">
                    Laporkan hoax yang Anda temukan melalui kanal resmi berikut:
                </p>
                <div class="report-links">
                    <a href="mailto:lapor@turnbackhoax.id">lapor@turnbackhoax.id</a>
                    <a href="https://wa.me/6285921600500" target="_blank" rel="noopener">WhatsApp +62-859-21-600-500</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="report-section">
    <div class="container">
        <div class="report-grid">
            <div>
                <h2>Panduan Melapor</h2>
                <p style="color: var(--muted);">
                    Laporkan hanya informasi yang menurut Anda merupakan berita bohong/hoax.
                    Hoax adalah informasi yang keliru secara fakta.
                </p>
                <div style="margin-top: 16px;">
                    <strong>Contoh:</strong>
                    <ul class="report-list">
                        <li><strong>Laporkan:</strong> "Hidung Donald ada tiga" = salah secara fakta.</li>
                        <li><strong>Bukan hoax:</strong> "Muka Fulan jelek sekali" = opini/pendapat.</li>
                    </ul>
                </div>
                <p style="margin-top: 12px;">
                    Semua laporan yang masuk bisa <a href="#" class="link">dipantau di sini</a>.
                </p>
            </div>
            <div class="report-media">
                <img src="https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?q=80&w=1000&auto=format&fit=crop" alt="Ilustrasi panduan melapor">
            </div>
        </div>
    </div>
</section>
@endsection
