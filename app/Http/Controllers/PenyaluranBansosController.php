<?php

namespace App\Http\Controllers;

use App\Models\PenyaluranBansos;
use App\Models\PenerimaBansos;
use App\Models\ProgramBansos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PenyaluranBansosController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        Gate::authorize('is-admin-or-staff');

        $user = Auth::user();
        $query = PenyaluranBansos::with(['penerimaBansos', 'programBansos', 'distributor'])->latest();

        // Search
        if ($request->filled('search')) {
            $query->whereHas('penerimaBansos', function($q) use ($request) {
                $q->where('nama_lengkap', 'like', "%{$request->search}%")
                  ->orWhere('nik', 'like', "%{$request->search}%");
            });
        }

        // Filter by program
        if ($request->filled('program_bansos_id')) {
            $query->where('program_bansos_id', $request->program_bansos_id);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by metode penyaluran
        if ($request->filled('metode_penyaluran')) {
            $query->where('metode_penyaluran', $request->metode_penyaluran);
        }

        $penyaluranBansos = $query->paginate(15)->withQueryString();
        $programBansos = ProgramBansos::all();

        // Admin melihat dengan Table, Staff melihat dengan Card/List
        if ($user->role === 'admin') {
            return view('penyaluran-bansos.admin.index', compact('penyaluranBansos', 'programBansos'));
        } elseif ($user->role === 'staff') {
            return view('penyaluran-bansos.staff.index', compact('penyaluranBansos', 'programBansos'));
        }

        abort(403, 'Unauthorized');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        Gate::authorize('is-admin-or-staff');

        // Get verified penerima that haven't been distributed yet
        $penerimaBansos = PenerimaBansos::where('status_verifikasi', 'diterima')
            ->whereDoesntHave('penyaluran', function($query) {
                $query->where('status', 'disalurkan');
            })
            ->with('programBansos')
            ->get();

        $programBansosId = $request->program_bansos_id;

        return view('penyaluran-bansos.create', compact('penerimaBansos', 'programBansosId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('is-admin-or-staff');

        $validated = $request->validate([
            'penerima_bansos_id' => 'required|exists:penerima_bansos,id',
            'program_bansos_id' => 'required|exists:program_bansos,id',
            'nominal_diterima' => 'required|numeric|min:0',
            'metode_penyaluran' => 'required|in:transfer,tunai,voucher,barang',
            'no_rekening' => 'nullable|string|max:50|required_if:metode_penyaluran,transfer',
            'nama_bank' => 'nullable|string|max:255|required_if:metode_penyaluran,transfer',
            'bukti_penyaluran' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'tanggal_penyaluran' => 'required|date',
            'status' => 'required|in:dijadwalkan,diproses,disalurkan,gagal',
            'catatan' => 'nullable|string',
        ]);

        // Handle file upload
        if ($request->hasFile('bukti_penyaluran')) {
            $bukti = $request->file('bukti_penyaluran');
            $buktiPath = $bukti->store('bukti-penyaluran', 'public');
            $validated['bukti_penyaluran'] = $buktiPath;
        }

        PenyaluranBansos::create($validated);

        return redirect()->route('penyaluran-bansos.index')
            ->with('success', 'Penyaluran bansos berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(PenyaluranBansos $penyaluranBansos)
    {
        Gate::authorize('is-admin-or-staff');

        $penyaluranBansos->load(['penerimaBansos', 'programBansos', 'distributor']);

        return view('penyaluran-bansos.show', compact('penyaluranBansos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PenyaluranBansos $penyaluranBansos)
    {
        Gate::authorize('is-admin-or-staff');

        $penerimaBansos = PenerimaBansos::where('status_verifikasi', 'diterima')
            ->with('programBansos')
            ->get();

        return view('penyaluran-bansos.edit', compact('penyaluranBansos', 'penerimaBansos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PenyaluranBansos $penyaluranBansos)
    {
        Gate::authorize('is-admin-or-staff');

        $validated = $request->validate([
            'penerima_bansos_id' => 'required|exists:penerima_bansos,id',
            'program_bansos_id' => 'required|exists:program_bansos,id',
            'nominal_diterima' => 'required|numeric|min:0',
            'metode_penyaluran' => 'required|in:transfer,tunai,voucher,barang',
            'no_rekening' => 'nullable|string|max:50|required_if:metode_penyaluran,transfer',
            'nama_bank' => 'nullable|string|max:255|required_if:metode_penyaluran,transfer',
            'bukti_penyaluran' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'tanggal_penyaluran' => 'required|date',
            'status' => 'required|in:dijadwalkan,diproses,disalurkan,gagal',
            'catatan' => 'nullable|string',
        ]);

        // Handle file upload
        if ($request->hasFile('bukti_penyaluran')) {
            // Delete old file if exists
            if ($penyaluranBansos->bukti_penyaluran) {
                Storage::disk('public')->delete($penyaluranBansos->bukti_penyaluran);
            }

            $bukti = $request->file('bukti_penyaluran');
            $buktiPath = $bukti->store('bukti-penyaluran', 'public');
            $validated['bukti_penyaluran'] = $buktiPath;
        } else {
            $validated['bukti_penyaluran'] = $penyaluranBansos->bukti_penyaluran;
        }

        $penyaluranBansos->update($validated);

        return redirect()->route('penyaluran-bansos.index')
            ->with('success', 'Penyaluran bansos berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PenyaluranBansos $penyaluranBansos)
    {
        Gate::authorize('is-admin');

        // Delete bukti file if exists
        if ($penyaluranBansos->bukti_penyaluran) {
            Storage::disk('public')->delete($penyaluranBansos->bukti_penyaluran);
        }

        $penyaluranBansos->delete();

        return redirect()->route('penyaluran-bansos.index')
            ->with('success', 'Penyaluran bansos berhasil dihapus.');
    }
}
