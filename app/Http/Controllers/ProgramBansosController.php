<?php

namespace App\Http\Controllers;

use App\Models\ProgramBansos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProgramBansosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        Gate::authorize('is-admin');

        $query = ProgramBansos::with('creator')->latest();

        // Search
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('nama_program', 'like', "%{$request->search}%")
                  ->orWhere('deskripsi', 'like', "%{$request->search}%");
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $programBansos = $query->paginate(15)->withQueryString();

        return view('program-bansos.index', compact('programBansos'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('is-admin');

        return view('program-bansos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('is-admin');

        $validated = $request->validate([
            'nama_program' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kuota' => 'required|integer|min:1',
            'nominal_bantuan' => 'nullable|numeric|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'status' => 'required|in:aktif,nonaktif,selesai',
        ]);

        // Handle file upload
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $gambarPath = $gambar->store('program-bansos', 'public');
            $validated['gambar'] = $gambarPath;
        }

        $validated['created_by'] = Auth::id();

        ProgramBansos::create($validated);

        return redirect()->route('program-bansos.index')
            ->with('success', 'Program Bansos berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProgramBansos $programBansos)
    {
        Gate::authorize('is-admin-or-staff');

        $programBansos->load(['creator', 'penerima', 'penyaluran']);

        return view('program-bansos.show', compact('programBansos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProgramBansos $programBansos)
    {
        Gate::authorize('is-admin');

        return view('program-bansos.edit', compact('programBansos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProgramBansos $programBansos)
    {
        Gate::authorize('is-admin');

        $validated = $request->validate([
            'nama_program' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kuota' => 'required|integer|min:1',
            'nominal_bantuan' => 'nullable|numeric|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'status' => 'required|in:aktif,nonaktif,selesai',
        ]);

        // Handle file upload
        if ($request->hasFile('gambar')) {
            // Delete old image if exists
            if ($programBansos->gambar) {
                Storage::disk('public')->delete($programBansos->gambar);
            }

            $gambar = $request->file('gambar');
            $gambarPath = $gambar->store('program-bansos', 'public');
            $validated['gambar'] = $gambarPath;
        } else {
            // Keep existing image if not uploaded
            $validated['gambar'] = $programBansos->gambar;
        }

        $programBansos->update($validated);

        return redirect()->route('program-bansos.index')
            ->with('success', 'Program Bansos berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProgramBansos $programBansos)
    {
        Gate::authorize('is-admin');

        // Delete image if exists
        if ($programBansos->gambar) {
            Storage::disk('public')->delete($programBansos->gambar);
        }

        $programBansos->delete();

        return redirect()->route('program-bansos.index')
            ->with('success', 'Program Bansos berhasil dihapus.');
    }
}
