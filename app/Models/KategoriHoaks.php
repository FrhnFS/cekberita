<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriHoaks extends Model
{
    protected $table = 'kategori_hoaks';

    protected $fillable = [
        'nama',
    ];

    public function artikelHoaks(): HasMany
    {
        return $this->hasMany(ArtikelHoaks::class, 'kategori_hoaks_id');
    }
}
