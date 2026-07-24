<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    // Mahasiswa & Satpam: kirim laporan baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'description' => 'nullable|string',
            'category' => 'nullable|string|max:255',
            'type' => 'nullable|in:ROUTINE,EMERGENCY',
            // Diubah jadi 'file' saja tanpa batas 'mimes' agar tidak memblokir upload dari Android
            'image' => 'nullable|file|max:10240',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        // Fleksibilitas: Ambil isi laporan dari 'content' atau 'description'
        $finalContent = $request->content ?? $request->description ?? 'Laporan Keamanan';
        
        // Fleksibilitas: Auto-generate title jika kosong
        $finalTitle = $request->title ?? (strlen($finalContent) > 30 ? substr($finalContent, 0, 30) . '...' : $finalContent);

        $imageUrl = null;
        if ($request->hasFile('image')) {
            $imageUrl = $request->file('image')->store('reports', 'public');
        }

        $report = Report::create([
            'user_id' => $request->user()->id,
            'title' => $finalTitle,
            'content' => $finalContent,
            'category' => $request->category,
            'type' => $request->type ?? 'ROUTINE',
            'image_url' => $imageUrl,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'status' => 'PENDING',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Laporan berhasil dikirim',
            'data' => $report
        ], 201);
    }

    public function index()
    {
        $data = Report::with('user')->latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'Data laporan berhasil diambil',
            'data' => $data
        ]);
    }

    public function show(Report $report)
    {
        $report->load('user');

        return response()->json([
            'success' => true,
            'message' => 'Detail laporan berhasil diambil',
            'data' => $report
        ]);
    }

    public function updateStatus(Request $request, Report $report)
    {
        $request->validate([
            'status' => 'required|in:PENDING,DIPROSES,SELESAI',
        ]);

        $report->update(['status' => $request->status]);

        return response()->json([
            'success' => true,
            'message' => 'Status laporan berhasil diperbarui',
            'data' => $report
        ]);
    }

    public function webIndex()
    {
        $data = Report::with('user')->latest()->get();
        return view('reports.index', compact('data'));
    }

    public function webUpdateStatus(Request $request, Report $report)
    {
        $request->validate([
            'status' => 'required|in:PENDING,DIPROSES,SELESAI',
        ]);

        $report->update(['status' => $request->status]);

        return redirect()->route('reports.index')
            ->with('success', 'Status laporan berhasil diperbarui.');
    }
}