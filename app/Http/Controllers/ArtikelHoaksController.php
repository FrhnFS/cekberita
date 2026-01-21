<?php

namespace App\Http\Controllers;

use App\Models\ArtikelHoaks;
use App\Models\KategoriHoaks;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ArtikelHoaksController extends Controller
{
    public function publicIndex()
    {
        $artikels = ArtikelHoaks::with('kategori')
            ->orderByDesc('created_at')
            ->paginate(12);

        return view('artikel.index', compact('artikels'));
    }

    public function landing()
    {
        $artikels = ArtikelHoaks::with('kategori')
            ->orderByDesc('created_at')
            ->take(3)
            ->get();

        return view('landing', compact('artikels'));
    }

    public function publicShow(ArtikelHoaks $artikel)
    {
        $artikel->load('kategori');

        return view('artikel.show', compact('artikel'));
    }

    public function adminIndex()
    {
        $artikels = ArtikelHoaks::with('kategori')
            ->orderByDesc('created_at')
            ->paginate(20);

        return view('admin.artikel.index', compact('artikels'));
    }

    public function create()
    {
        $kategoris = KategoriHoaks::orderBy('nama')->get();

        return view('admin.artikel.form', [
            'artikel' => new ArtikelHoaks(),
            'kategoris' => $kategoris,
            'mode' => 'create',
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'kategori_hoaks_id' => 'required|exists:kategori_hoaks,id',
            'judul_klaim' => 'required|string|max:255',
            'ringkasan_klarifikasi' => 'required|string',
            'isi_klarifikasi' => 'required|string',
            'sumber_rujukan' => 'nullable|string',
            'published_at' => 'required|date',
            'gambar' => 'required|file|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        $file = $request->file('gambar');
        if (!$file || !$file->isValid() || !$file->getRealPath()) {
            return back()->withErrors(['gambar' => 'Upload gambar gagal. Pastikan file dipilih dan tidak melebihi batas ukuran.'])->withInput();
        }

        $path = $this->storeResizedImage($file);

        ArtikelHoaks::create([
            'kategori_hoaks_id' => $data['kategori_hoaks_id'],
            'judul_klaim' => $data['judul_klaim'],
            'ringkasan_klarifikasi' => $data['ringkasan_klarifikasi'],
            'isi_klarifikasi' => $data['isi_klarifikasi'],
            'sumber_rujukan' => $data['sumber_rujukan'],
            'published_at' => $data['published_at'],
            'gambar_path' => $path,
        ]);

        return redirect()->route('admin.artikel.index')->with('status', 'Artikel berhasil dibuat.');
    }

    public function edit(ArtikelHoaks $artikel)
    {
        $kategoris = KategoriHoaks::orderBy('nama')->get();

        return view('admin.artikel.form', [
            'artikel' => $artikel,
            'kategoris' => $kategoris,
            'mode' => 'edit',
        ]);
    }

    public function update(Request $request, ArtikelHoaks $artikel)
    {
        $data = $request->validate([
            'kategori_hoaks_id' => 'required|exists:kategori_hoaks,id',
            'judul_klaim' => 'required|string|max:255',
            'ringkasan_klarifikasi' => 'required|string',
            'isi_klarifikasi' => 'required|string',
            'sumber_rujukan' => 'nullable|string',
            'published_at' => 'required|date',
            'gambar' => 'nullable|file|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            if (!$file || !$file->isValid() || !$file->getRealPath()) {
                return back()->withErrors(['gambar' => 'Upload gambar gagal. Pastikan file dipilih dan tidak melebihi batas ukuran.'])->withInput();
            }
            if ($artikel->gambar_path) {
                Storage::disk('public')->delete($artikel->gambar_path);
            }
            $artikel->gambar_path = $this->storeResizedImage($file);
        }

        $artikel->fill([
            'kategori_hoaks_id' => $data['kategori_hoaks_id'],
            'judul_klaim' => $data['judul_klaim'],
            'ringkasan_klarifikasi' => $data['ringkasan_klarifikasi'],
            'isi_klarifikasi' => $data['isi_klarifikasi'],
            'sumber_rujukan' => $data['sumber_rujukan'],
            'published_at' => $data['published_at'],
        ]);
        $artikel->save();

        return redirect()->route('admin.artikel.index')->with('status', 'Artikel berhasil diperbarui.');
    }

    public function destroy(ArtikelHoaks $artikel)
    {
        if ($artikel->gambar_path) {
            Storage::disk('public')->delete($artikel->gambar_path);
        }

        $artikel->delete();

        return redirect()->route('admin.artikel.index')->with('status', 'Artikel berhasil dihapus.');
    }

    private function storeResizedImage(UploadedFile $file): string
    {
        $extension = strtolower($file->getClientOriginalExtension());
        $allowed = ['jpg', 'jpeg', 'png'];
        if (!in_array($extension, $allowed, true)) {
            throw new \RuntimeException('Format gambar tidak didukung.');
        }

        $sourcePath = $file->getRealPath();
        [$srcW, $srcH] = getimagesize($sourcePath) ?: [0, 0];
        if ($srcW <= 0 || $srcH <= 0) {
            throw new \RuntimeException('Gambar tidak valid.');
        }

        $targetW = 1200;
        $targetH = 630;

        $srcImage = $extension === 'png'
            ? imagecreatefrompng($sourcePath)
            : imagecreatefromjpeg($sourcePath);

        $destImage = imagecreatetruecolor($targetW, $targetH);
        if ($extension === 'png') {
            imagealphablending($destImage, false);
            imagesavealpha($destImage, true);
            $transparent = imagecolorallocatealpha($destImage, 0, 0, 0, 127);
            imagefilledrectangle($destImage, 0, 0, $targetW, $targetH, $transparent);
        }

        $scale = max($targetW / $srcW, $targetH / $srcH);
        $newW = (int) round($srcW * $scale);
        $newH = (int) round($srcH * $scale);
        $srcX = (int) round(($newW - $targetW) / 2);
        $srcY = (int) round(($newH - $targetH) / 2);

        $tempImage = imagecreatetruecolor($newW, $newH);
        if ($extension === 'png') {
            imagealphablending($tempImage, false);
            imagesavealpha($tempImage, true);
            $transparentTemp = imagecolorallocatealpha($tempImage, 0, 0, 0, 127);
            imagefilledrectangle($tempImage, 0, 0, $newW, $newH, $transparentTemp);
        }

        imagecopyresampled($tempImage, $srcImage, 0, 0, 0, 0, $newW, $newH, $srcW, $srcH);
        imagecopy($destImage, $tempImage, 0, 0, $srcX, $srcY, $targetW, $targetH);

        Storage::disk('public')->makeDirectory('artikel');
        $filename = pathinfo($file->hashName(), PATHINFO_FILENAME) . '.' . ($extension === 'jpeg' ? 'jpg' : $extension);
        $relativePath = 'artikel/' . $filename;
        $absolutePath = Storage::disk('public')->path($relativePath);

        if ($extension === 'png') {
            imagepng($destImage, $absolutePath, 6);
        } else {
            imagejpeg($destImage, $absolutePath, 85);
        }

        imagedestroy($srcImage);
        imagedestroy($tempImage);
        imagedestroy($destImage);

        return $relativePath;
    }
}
