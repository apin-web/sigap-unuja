<?php

namespace App\Http\Controllers;

use App\Models\Alert;
use App\Models\Report;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalAlerts = Alert::count();
        $totalReports = Report::count();
        $pendingReports = Report::where('status', 'PENDING')->count();
        $diprosesReports = Report::where('status', 'DIPROSES')->count();
        $selesaiReports = Report::where('status', 'SELESAI')->count();
        $totalUsers = User::count();

        return view('dashboard.index', compact(
            'totalAlerts', 'totalReports', 'pendingReports', 'diprosesReports', 'selesaiReports', 'totalUsers'
        ));
    }
}