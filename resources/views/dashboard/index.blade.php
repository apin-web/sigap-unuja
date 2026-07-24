@extends('layouts.app')

@section('page-title', 'Dashboard')

@section('content')
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card p-3">
                <div class="text-muted small">Total Informasi</div>
                <div class="fs-3 fw-bold text-primary">{{ $totalAlerts }}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3">
                <div class="text-muted small">Total Laporan</div>
                <div class="fs-3 fw-bold text-dark">{{ $totalReports }}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3">
                <div class="text-muted small">Laporan Pending</div>
                <div class="fs-3 fw-bold text-warning">{{ $pendingReports }}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3">
                <div class="text-muted small">Total Akun</div>
                <div class="fs-3 fw-bold text-success">{{ $totalUsers }}</div>
            </div>
        </div>
    </div>

    <div class="card p-4">
        <h6 class="mb-3">Status Penanganan Laporan</h6>
        <div class="d-flex gap-4">
            <div><span class="badge bg-warning text-dark">PENDING</span> {{ $pendingReports }}</div>
            <div><span class="badge bg-info text-dark">DIPROSES</span> {{ $diprosesReports }}</div>
            <div><span class="badge bg-success">SELESAI</span> {{ $selesaiReports }}</div>
        </div>
    </div>
@endsection