<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            // Statistik untuk Admin
            $stats = [
                'total_program' => \App\Models\ProgramBansos::count(),
                'program_aktif' => \App\Models\ProgramBansos::where('status', 'aktif')->count(),
                'total_penerima' => \App\Models\PenerimaBansos::count(),
                'penerima_pending' => \App\Models\PenerimaBansos::where('status_verifikasi', 'pending')->count(),
                'penerima_diterima' => \App\Models\PenerimaBansos::where('status_verifikasi', 'diterima')->count(),
                'total_penyaluran' => \App\Models\PenyaluranBansos::count(),
                'penyaluran_disalurkan' => \App\Models\PenyaluranBansos::where('status', 'disalurkan')->count(),
                'total_donasi' => \App\Models\Donasi::count(),
                'total_nominal_donasi' => \App\Models\Donasi::where('jenis_donasi', 'uang')->where('status', 'diterima')->sum('jumlah'),
            ];
            
            // Data terbaru
            $programTerbaru = \App\Models\ProgramBansos::latest()->take(5)->get();
            $penerimaTerbaru = \App\Models\PenerimaBansos::with('programBansos')->latest()->take(5)->get();
            
            return view('dashboard.admin', compact('stats', 'programTerbaru', 'penerimaTerbaru'));
        } 
        
        if ($user->isStaff()) {
            // Statistik untuk Staff
            $stats = [
                'penerima_pending' => \App\Models\PenerimaBansos::where('status_verifikasi', 'pending')->count(),
                'penerima_diterima' => \App\Models\PenerimaBansos::where('status_verifikasi', 'diterima')->count(),
                'penyaluran_dijadwalkan' => \App\Models\PenyaluranBansos::where('status', 'dijadwalkan')->count(),
                'penyaluran_diproses' => \App\Models\PenyaluranBansos::where('status', 'diproses')->count(),
            ];
            
            // Data untuk staff
            $penerimaPending = \App\Models\PenerimaBansos::with('programBansos')->where('status_verifikasi', 'pending')->latest()->take(10)->get();
            $penyaluranPending = \App\Models\PenyaluranBansos::with(['penerimaBansos', 'programBansos'])
                ->whereIn('status', ['dijadwalkan', 'diproses'])
                ->latest()->take(10)->get();
            
            return view('dashboard.staff', compact('stats', 'penerimaPending', 'penyaluranPending'));
        }
        
        // Guest dashboard
        $programAktif = \App\Models\ProgramBansos::where('status', 'aktif')->latest()->take(6)->get();
        return view('dashboard.guest', compact('programAktif'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
