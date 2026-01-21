<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Cek Hoaks')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --ink: #1f2933;
            --muted: #5f6b7a;
            --brand: #27a7e7;
            --brand-dark: #1a91d1;
            --surface: #ffffff;
            --surface-soft: #f5f7fa;
            --line: #e4e7ec;
            --shadow: 0 6px 20px rgba(15, 23, 42, 0.08);
            --radius: 12px;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: "Inter", system-ui, sans-serif;
            color: var(--ink);
            background: #fff;
        }
        a { color: inherit; text-decoration: none; }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        main.container { padding: 20px 20px 80px; }
        .card {
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
        }
        .btn-primary,
        .btn-secondary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px 20px;
            border-radius: 999px;
            font-weight: 600;
            transition: all 0.2s ease;
            border: 1px solid transparent;
        }
        .btn-primary {
            background: var(--brand);
            color: #fff;
            border-color: var(--brand);
        }
        .btn-primary:hover { background: var(--brand-dark); border-color: var(--brand-dark); transform: translateY(-1px); box-shadow: 0 10px 18px rgba(39, 167, 231, 0.25); }
        .btn-secondary {
            background: transparent;
            color: var(--ink);
            border-color: #d7dde5;
        }
        .btn-secondary:hover { background: #f5f7fa; }
        .grid { display: grid; gap: 24px; }
        .page-header {
            padding: 24px 0 10px;
        }
        .page-header h1 { margin: 0 0 8px; font-size: 2rem; }
        .page-header p { margin: 0; color: var(--muted); }
        label {
            display: block;
            font-weight: 600;
            margin-bottom: 12px;
        }
        input, select, textarea {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid var(--line);
            border-radius: 10px;
            background: #fff;
            font-family: inherit;
            font-size: 0.95rem;
        }
        textarea { resize: vertical; }
        button { cursor: pointer; }
        table { width: 100%; border-collapse: collapse; }
        th, td { text-align: left; padding: 12px; border-bottom: 1px solid var(--line); }
        th { background: var(--surface-soft); }
        header { padding: 20px 0; }
        nav { display: flex; justify-content: space-between; align-items: center; gap: 16px; flex-wrap: wrap; }
        .logo { font-weight: 700; font-size: 1.5rem; }
        .nav-right { display: flex; gap: 12px; flex-wrap: wrap; }
        .hero { text-align: center; padding: 80px 0 60px; }
        .hero h1 { font-size: 3rem; font-weight: 700; margin: 0 auto 20px; max-width: 820px; }
        .highlight { color: var(--brand); }
        .subtitle { margin-bottom: 30px; color: var(--muted); }
        .hero-btn { font-size: 1.05rem; padding: 12px 28px; }
        .info { padding: 60px 0; background: var(--surface-soft); }
        .info-card { display: flex; background: var(--surface); border-radius: var(--radius); overflow: hidden; box-shadow: var(--shadow); }
        .info-image { flex: 1; min-height: 280px; background: #eef2f6; display: flex; align-items: center; justify-content: center; }
        .info-image img { width: 100%; height: 100%; object-fit: cover; }
        .info-content { flex: 1; padding: 36px; }
        .info-content h2 { font-size: 1.8rem; margin-bottom: 16px; }
        .info-content p { margin-bottom: 16px; color: var(--muted); }
        .link { color: var(--brand); font-weight: 600; display: inline-block; position: relative; }
        .link:after { content: '->'; margin-left: 6px; transition: all 0.2s ease; }
        .link:hover:after { margin-left: 10px; }
        .chatbot { padding: 60px 0; }
        .feature-tag { display: inline-block; background: #e6f2fa; color: var(--brand); padding: 6px 14px; border-radius: 50px; font-size: 0.85rem; font-weight: 600; margin-bottom: 24px; }
        .chatbot-content { display: flex; align-items: center; gap: 40px; }
        .chatbot-text { flex: 1; }
        .chatbot-text h2 { font-size: 2rem; margin-bottom: 16px; }
        .chatbot-text p { color: var(--muted); }
        .cta-row { margin-top: 16px; display: flex; gap: 12px; flex-wrap: wrap; }
        .chatbot-image { flex: 1; display: flex; justify-content: center; }
        .chatbot-image img { max-width: 100%; border-radius: var(--radius); box-shadow: var(--shadow); }
        .report-grid { display: grid; gap: 24px; align-items: center; }
        .report-card { background: var(--surface); border-radius: var(--radius); box-shadow: var(--shadow); padding: 24px; }
        .report-media img { width: 100%; border-radius: var(--radius); box-shadow: var(--shadow); }
        .report-list { margin: 12px 0 0; padding-left: 18px; color: var(--muted); }
        .report-list li { margin-bottom: 8px; }
        .report-links { display: grid; gap: 10px; margin-top: 12px; }
        .report-links a { color: var(--brand); font-weight: 600; }
        .report-section { padding: 40px 0; }
        .how-it-works { padding: 60px 0; background: var(--surface-soft); text-align: center; }
        .how-it-works h2 { font-size: 2rem; margin-bottom: 12px; }
        .section-subtitle { color: var(--muted); margin-bottom: 40px; }
        .steps { display: flex; gap: 24px; justify-content: space-between; }
        .step { flex: 1; background: var(--surface); padding: 28px; border-radius: var(--radius); box-shadow: var(--shadow); }
        .step-icon { font-size: 1.6rem; font-weight: 700; margin-bottom: 16px; color: var(--brand); }
        .step h3 { margin-bottom: 12px; }
        .step p { color: var(--muted); }
        footer { padding: 40px 0; background: #f1f4f7; }
        .footer-content { display: flex; flex-direction: column; align-items: center; text-align: center; gap: 8px; }
        .copyright { font-size: 0.9rem; color: #7c8794; }
        .article-grid { display: grid; gap: 28px; }
        .article-card { background: var(--surface); border-radius: 14px; box-shadow: var(--shadow); overflow: hidden; border: 1px solid var(--line); transition: transform 0.2s ease, box-shadow 0.2s ease; }
        .article-card:hover { transform: translateY(-4px); box-shadow: 0 14px 34px rgba(15, 23, 42, 0.12); }
        .article-thumb { width: 100%; height: 220px; object-fit: cover; background: #eef2f6; display: block; }
        .article-body { padding: 18px 18px 22px; }
        .article-title { font-size: 1.25rem; font-weight: 700; margin-bottom: 10px; line-height: 1.3; }
        .article-meta { color: var(--muted); font-size: 0.95rem; display: flex; gap: 12px; align-items: center; }
        .article-meta span { display: inline-flex; align-items: center; gap: 8px; }
        .article-meta span::before { content: ""; width: 6px; height: 6px; background: var(--brand); border-radius: 50%; display: inline-block; }
        .article-excerpt { color: var(--muted); margin-top: 10px; }
        .detail-wrap { display: grid; gap: 24px; }
        @media (min-width: 900px) {
            .grid.cols-2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
            .grid.cols-3 { grid-template-columns: repeat(3, minmax(0, 1fr)); }
            .article-grid { grid-template-columns: repeat(3, minmax(0, 1fr)); }
            .detail-wrap { grid-template-columns: 2fr 1fr; }
            .report-grid { grid-template-columns: 1.2fr 1fr; }
        }
        @media (max-width: 900px) {
            .info-card, .chatbot-content, .steps { flex-direction: column; }
            .hero { padding-top: 50px; }
            .hero h1 { font-size: 2.2rem; }
        }
    </style>
</head>
<body>
@if (!request()->is('admin/login'))
    <header>
        <div class="container">
            <nav>
                <a class="logo" href="{{ route('landing') }}">cekhoaks</a>
                <div class="nav-right">
                    @if (request()->is('admin/*'))
                        <a href="{{ route('admin.artikel.index') }}" class="btn-secondary">Dashboard</a>
                        <a href="{{ route('admin.artikel.create') }}" class="btn-secondary">Tambah Artikel</a>
                        <form method="post" action="{{ route('admin.logout') }}" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn-primary">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('landing') }}" class="btn-secondary">Beranda</a>
                        <a href="{{ route('artikel.index') }}" class="btn-secondary">Daftar Artikel</a>
                        <a href="{{ route('lapor.hoax') }}" class="btn-secondary">Lapor Hoax</a>
                        <a href="https://t.me/CekBeritabot" class="btn-primary" target="_blank" rel="noopener">Coba Sekarang</a>
                    @endif
                </div>
            </nav>
        </div>
    </header>
@endif
<main class="container">
    @yield('content')
</main>
</body>
</html>
