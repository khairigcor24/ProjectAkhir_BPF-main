<?php

namespace App\Http\Controllers;

use App\Models\ProgramBansos;
use Illuminate\Http\Request;

class GuestProgramBansosController extends Controller
{
    /**
     * Display a listing of program bansos for guest (public)
     */
    public function index(Request $request)
    {
        $query = ProgramBansos::where('status', 'aktif')->with('creator')->latest();

        // Search
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('nama_program', 'like', "%{$request->search}%")
                  ->orWhere('deskripsi', 'like', "%{$request->search}%");
            });
        }

        // Filter by date range
        if ($request->filled('tanggal_mulai')) {
            $query->where('tanggal_mulai', '>=', $request->tanggal_mulai);
        }

        if ($request->filled('tanggal_selesai')) {
            $query->where('tanggal_selesai', '<=', $request->tanggal_selesai);
        }

        $programBansos = $query->paginate(12)->withQueryString();

        return view('guest.program-bansos.index', compact('programBansos'));
    }

    /**
     * Display the specified program bansos
     */
    public function show(ProgramBansos $programBansos)
    {
        if ($programBansos->status !== 'aktif') {
            abort(404, 'Program tidak ditemukan atau tidak aktif.');
        }

        $programBansos->load(['creator']);
        
        // Count penerima yang sudah diterima
        $penerimaDiterima = $programBansos->penerima()->where('status_verifikasi', 'diterima')->count();
        $kuotaTersisa = max(0, $programBansos->kuota - $penerimaDiterima);

        return view('guest.program-bansos.show', compact('programBansos', 'kuotaTersisa', 'penerimaDiterima'));
    }
}
