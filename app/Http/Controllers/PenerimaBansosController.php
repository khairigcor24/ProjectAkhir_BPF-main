<?php

namespace App\Http\Controllers;

use App\Models\PenerimaBansos;
use App\Models\ProgramBansos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


class PenerimaBansosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        Gate::authorize('is-admin-or-staff');

        $user = Auth::user();
        $query = PenerimaBansos::with(['programBansos', 'verifier'])->latest();

        // Search
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Filter by program
        if ($request->filled('program_bansos_id')) {
            $query->where('program_bansos_id', $request->program_bansos_id);
        }

        // Filter by status verifikasi
        if ($request->filled('status_verifikasi')) {
            $query->where('status_verifikasi', $request->status_verifikasi);
        }

        $penerimaBansos = $query->paginate(15)->withQueryString();
        $programBansos = ProgramBansos::where('status', 'aktif')->get();

        // Admin melihat dengan Table, Staff melihat dengan Card/List
        if ($user->role === 'admin') {
            return view('penerima-bansos.admin.index', compact('penerimaBansos', 'programBansos'));
        } elseif ($user->role === 'staff') {
            return view('penerima-bansos.staff.index', compact('penerimaBansos', 'programBansos'));
        }

        abort(403, 'Unauthorized');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Admin dan Guest bisa membuat pendaftaran
        $programBansos = ProgramBansos::where('status', 'aktif')->get();

        if (Auth::check() && Auth::user()->role === 'admin') {
            Gate::authorize('is-admin');
            return view('penerima-bansos.create', compact('programBansos'));
        }

        // Guest dapat membuat pendaftaran
        return view('penerima-bansos.create', compact('programBansos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'program_bansos_id' => 'required|exists:program_bansos,id',
            'nik' => 'required|string|size:16|unique:penerima_bansos,nik',
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:L,P',
            'alamat' => 'required|string',
            'rt' => 'nullable|string|max:10',
            'rw' => 'nullable|string|max:10',
            'kelurahan' => 'nullable|string|max:255',
            'kecamatan' => 'nullable|string|max:255',
            'kota_kabupaten' => 'nullable|string|max:255',
            'provinsi' => 'nullable|string|max:255',
            'telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'jumlah_anggota_keluarga' => 'nullable|integer|min:1',
            'penghasilan_perbulan' => 'nullable|numeric|min:0',
            'status_ekonomi' => 'nullable|in:sangat_miskin,miskin,menengah_bawah,menengah',
            'keterangan' => 'nullable|string',
            'dokumen_pendukung.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        // Handle multiple file uploads
        $dokumenPaths = [];
        if ($request->hasFile('dokumen_pendukung')) {
            foreach ($request->file('dokumen_pendukung') as $file) {
                $path = $file->store('dokumen-penerima', 'public');
                $dokumenPaths[] = $path;
            }
            $validated['dokumen_pendukung'] = $dokumenPaths;
        }

        $validated['created_by'] = Auth::id() ?? null;
        $validated['status_verifikasi'] = 'pending';

        PenerimaBansos::create($validated);

        $redirectRoute = Auth::check() && Auth::user()->role === 'admin'
            ? route('penerima-bansos.index')
            : route('guest.penerima-bansos.success');

        return redirect($redirectRoute)
            ->with('success', 'Pendaftaran berhasil diajukan. Menunggu verifikasi.');
    }

    /**
     * Display the specified resource.
     */
    public function show(PenerimaBansos $penerimaBansos)
    {
        Gate::authorize('is-admin-or-staff');

        $penerimaBansos->load(['programBansos', 'verifier', 'creator', 'penyaluran']);

        return view('penerima-bansos.show', compact('penerimaBansos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PenerimaBansos $penerimaBansos)
    {
        Gate::authorize('is-admin');

        $programBansos = ProgramBansos::all();

        return view('penerima-bansos.edit', compact('penerimaBansos', 'programBansos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PenerimaBansos $penerimaBansos)
    {
        Gate::authorize('is-admin');

        $validated = $request->validate([
            'program_bansos_id' => 'required|exists:program_bansos,id',
            'nik' => 'required|string|size:16|unique:penerima_bansos,nik,' . $penerimaBansos->id,
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:L,P',
            'alamat' => 'required|string',
            'rt' => 'nullable|string|max:10',
            'rw' => 'nullable|string|max:10',
            'kelurahan' => 'nullable|string|max:255',
            'kecamatan' => 'nullable|string|max:255',
            'kota_kabupaten' => 'nullable|string|max:255',
            'provinsi' => 'nullable|string|max:255',
            'telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'jumlah_anggota_keluarga' => 'nullable|integer|min:1',
            'penghasilan_perbulan' => 'nullable|numeric|min:0',
            'status_ekonomi' => 'nullable|in:sangat_miskin,miskin,menengah_bawah,menengah',
            'keterangan' => 'nullable|string',
            'dokumen_pendukung.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        // Handle multiple file uploads (append to existing)
        $dokumenPaths = $penerimaBansos->dokumen_pendukung ?? [];
        if ($request->hasFile('dokumen_pendukung')) {
            foreach ($request->file('dokumen_pendukung') as $file) {
                $path = $file->store('dokumen-penerima', 'public');
                $dokumenPaths[] = $path;
            }
            $validated['dokumen_pendukung'] = $dokumenPaths;
        } else {
            $validated['dokumen_pendukung'] = $dokumenPaths;
        }

        $penerimaBansos->update($validated);

        return redirect()->route('penerima-bansos.index')
            ->with('success', 'Data penerima bansos berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PenerimaBansos $penerimaBansos)
    {
        Gate::authorize('is-admin');

        // Delete uploaded documents
        if ($penerimaBansos->dokumen_pendukung) {
            foreach ($penerimaBansos->dokumen_pendukung as $dokumen) {
                Storage::disk('public')->delete($dokumen);
            }
        }

        $penerimaBansos->delete();

        return redirect()->route('penerima-bansos.index')
            ->with('success', 'Data penerima bansos berhasil dihapus.');
    }

    /**
     * Validasi penerima bansos (Admin dan Staff bisa validasi)
     */
    public function verifikasi(Request $request, PenerimaBansos $penerimaBansos)
    {
        Gate::authorize('is-admin-or-staff');

        $validated = $request->validate([
            'status_verifikasi' => 'required|in:diterima,ditolak',
            'catatan_verifikasi' => 'nullable|string',
        ]);

        $penerimaBansos->update([
            'status_verifikasi' => $validated['status_verifikasi'],
            'catatan_verifikasi' => $validated['catatan_verifikasi'] ?? null,
            'verified_by' => Auth::id(),
            'tanggal_verifikasi' => now(),
        ]);

        return redirect()->route('penerima-bansos.index')
            ->with('success', 'Verifikasi berhasil dilakukan.');
    }

    /**
     * Download dokumen pendukung
     */
    public function downloadDokumen(PenerimaBansos $penerimaBansos, $filename)
    {
        Gate::authorize('is-admin-or-staff');

        // Pastikan dokumen milik penerima ini
        if (!$penerimaBansos->dokumen_pendukung || !in_array($filename, $penerimaBansos->dokumen_pendukung)) {
            abort(404);
        }

        $path = storage_path('app/public/' . $filename);

        if (!file_exists($path)) {
            abort(404);
        }

        return response()->download($path);
    }
}
