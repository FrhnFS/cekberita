@extends('layouts.app')

@section('title', $mode === 'create' ? 'Tambah Artikel' : 'Edit Artikel')

@section('content')
<div class="card" style="padding: 20px; margin-bottom: 16px;">
    <p style="text-transform: uppercase; letter-spacing: 0.08em; color: var(--muted); margin: 0 0 6px;">
        Admin Panel
    </p>
    <h1 style="margin: 0;">{{ $mode === 'create' ? 'Tambah Artikel' : 'Edit Artikel' }}</h1>
</div>

<div class="card" style="padding: 20px;">
    @if ($errors->any())
        <div class="card" style="padding: 12px; border-color: #f3d4d4; background: #fff5f5; margin-bottom: 12px;">
            <ul style="margin: 0; padding-left: 18px; color: #a33434;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="post" action="{{ $mode === 'create' ? route('admin.artikel.store') : route('admin.artikel.update', $artikel) }}" enctype="multipart/form-data">
        @csrf
        @if ($mode === 'edit')
            @method('PUT')
        @endif

        <div class="grid cols-2">
            <label>Judul Klaim
                <input type="text" name="judul_klaim" value="{{ old('judul_klaim', $artikel->judul_klaim) }}" required>
            </label>

            <label>Kategori
                <select name="kategori_hoaks_id" required>
                    <option value="">Pilih kategori</option>
                    @foreach ($kategoris as $kategori)
                        <option value="{{ $kategori->id }}" @selected(old('kategori_hoaks_id', $artikel->kategori_hoaks_id) == $kategori->id)>
                            {{ $kategori->nama }}
                        </option>
                    @endforeach
                </select>
            </label>
        </div>

        <label>Tanggal Publikasi
            <input type="date" name="published_at" value="{{ old('published_at', optional($artikel->published_at)->format('Y-m-d')) }}" required>
        </label>

        <label>Ringkasan Klarifikasi
            <textarea name="ringkasan_klarifikasi" rows="3" required>{{ old('ringkasan_klarifikasi', $artikel->ringkasan_klarifikasi) }}</textarea>
        </label>

        <label>Isi Klarifikasi
            <textarea name="isi_klarifikasi" rows="6" required>{{ old('isi_klarifikasi', $artikel->isi_klarifikasi) }}</textarea>
        </label>

        <label>Sumber Rujukan (opsional)
            <textarea name="sumber_rujukan" rows="3">{{ old('sumber_rujukan', $artikel->sumber_rujukan) }}</textarea>
        </label>

        <label>Gambar Artikel (JPEG/PNG)
            <input type="file" name="gambar" {{ $mode === 'create' ? 'required' : '' }} accept="image/jpeg,image/png">
        </label>

        @if ($mode === 'edit' && $artikel->gambar_path)
            <div class="card" style="padding: 12px; background: #f5f7f6; border-color: #e1e7e5; margin-bottom: 12px;">
                <p style="margin: 0 0 8px;">Gambar saat ini:</p>
                <img src="{{ asset('storage/' . $artikel->gambar_path) }}" alt="{{ $artikel->judul_klaim }}" style="max-width: 320px; height: auto;">
            </div>
        @endif

        <button class="btn-primary" type="submit">Simpan</button>
    </form>
</div>
@endsection
