<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ArtikelHoaks extends Model
{
    protected $table = 'artikel_hoaks';

    protected $fillable = [
        'kategori_hoaks_id',
        'judul_klaim',
        'ringkasan_klarifikasi',
        'isi_klarifikasi',
        'sumber_rujukan',
        'gambar_path',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'date',
    ];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriHoaks::class, 'kategori_hoaks_id');
    }
}
