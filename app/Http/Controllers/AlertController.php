<?php

namespace App\Http\Controllers;

use App\Models\Alert;
use Illuminate\Http\Request;

class AlertController extends Controller
{
    // Dashboard Admin - tampilkan semua data
    public function index()
    {
        $data = Alert::latest()->get();
        return view('alerts.index', compact('data'));
    }

    public function create()
    {
        return view('alerts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:KEHILANGAN,INFO_PARKIR,LAINNYA',
            'content' => 'required|string',
            'image' => 'nullable|image|max:5120',
            'is_urgent' => 'nullable|boolean',
        ]);

        $imageUrl = null;
        if ($request->hasFile('image')) {
            $imageUrl = $request->file('image')->store('alerts', 'public');
        }

        Alert::create([
            'title' => $request->title,
            'category' => $request->category,
            'content' => $request->content,
            'image_url' => $imageUrl,
            'is_urgent' => $request->boolean('is_urgent'),
        ]);

        return redirect()->route('alerts.index')
            ->with('success', 'Informasi berhasil ditambahkan.');
    }

    public function edit(Alert $alert)
    {
        return view('alerts.edit', compact('alert'));
    }

    public function update(Request $request, Alert $alert)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:KEHILANGAN,INFO_PARKIR,LAINNYA',
            'content' => 'required|string',
            'image' => 'nullable|image|max:5120',
            'is_urgent' => 'nullable|boolean',
        ]);

        $imageUrl = $alert->getRawOriginal('image_url');
        if ($request->hasFile('image')) {
            $imageUrl = $request->file('image')->store('alerts', 'public');
        }

        $alert->update([
            'title' => $request->title,
            'category' => $request->category,
            'content' => $request->content,
            'image_url' => $imageUrl,
            'is_urgent' => $request->boolean('is_urgent'),
        ]);

        return redirect()->route('alerts.index')
            ->with('success', 'Informasi berhasil diperbarui.');
    }

    public function destroy(Alert $alert)
    {
        $alert->delete();

        return redirect()->route('alerts.index')
            ->with('success', 'Informasi berhasil dihapus.');
    }

    // === API untuk Android ===
    public function apiIndex()
    {
        $data = Alert::latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'Data alert berhasil diambil',
            'data' => $data
        ]);
    }

    // Satpam: kirim Alert baru dari APK
    public function apiStore(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:KEHILANGAN,INFO_PARKIR,LAINNYA',
            'content' => 'required|string',
            'image' => 'nullable|image|max:5120',
            'is_urgent' => 'nullable|boolean',
        ]);

        $imageUrl = null;
        if ($request->hasFile('image')) {
            $imageUrl = $request->file('image')->store('alerts', 'public');
        }

        $alert = Alert::create([
            'title' => $request->title,
            'category' => $request->category,
            'content' => $request->content,
            'image_url' => $imageUrl,
            'is_urgent' => $request->boolean('is_urgent'),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Informasi berhasil disebarkan',
            'data' => $alert
        ], 201);
    }
}