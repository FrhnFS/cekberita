<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('artikel_hoaks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_hoaks_id')->constrained('kategori_hoaks');
            $table->string('judul_klaim');
            $table->text('ringkasan_klarifikasi');
            $table->longText('isi_klarifikasi');
            $table->text('sumber_rujukan')->nullable();
            $table->string('gambar_path');
            $table->date('published_at');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('artikel_hoaks');
    }
};
