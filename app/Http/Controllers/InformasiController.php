<?php

namespace App\Http\Controllers;

use App\Models\InformasiKeamanan;
use Illuminate\Http\Request;

class InformasiController extends Controller
{
    public function index()
    {
        $data = InformasiKeamanan::latest()->get();
        return view('informasi.index', compact('data'));
    }

    public function create()
    {
        return view('informasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi_informasi' => 'required|string',
        ]);

        InformasiKeamanan::create([
            'judul' => $request->judul,
            'isi_informasi' => $request->isi_informasi,
            'tanggal' => now(),
        ]);

        return redirect()->route('informasi.index')
            ->with('success', 'Informasi keamanan berhasil ditambahkan.');
    }

    public function edit(InformasiKeamanan $informasi)
    {
        return view('informasi.edit', compact('informasi'));
    }

    public function update(Request $request, InformasiKeamanan $informasi)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi_informasi' => 'required|string',
        ]);

        $informasi->update([
            'judul' => $request->judul,
            'isi_informasi' => $request->isi_informasi,
        ]);

        return redirect()->route('informasi.index')
            ->with('success', 'Informasi keamanan berhasil diperbarui.');
    }

    public function destroy(InformasiKeamanan $informasi)
    {
        $informasi->delete();

        return redirect()->route('informasi.index')
            ->with('success', 'Informasi keamanan berhasil dihapus.');
    }
}