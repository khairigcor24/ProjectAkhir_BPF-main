<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DonasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $donasi = Donasi::orderBy('created_at', 'desc')->paginate(15);

        // Admin melihat dengan Table, Staff melihat dengan Card/List
        if ($user->isAdmin()) {
            return view('donasi.admin.index', compact('donasi'));
        } elseif ($user->isStaff()) {
            return view('donasi.staff.index', compact('donasi'));
        }

        abort(403, 'Unauthorized');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Hanya Admin yang bisa create
        Gate::authorize('is-admin');
        
        return view('donasi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Hanya Admin yang bisa store
        Gate::authorize('is-admin');

        $validated = $request->validate([
            'nama_donatur' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'telepon' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'jenis_donasi' => 'required|in:uang,barang,jasa',
            'jumlah' => 'nullable|numeric|min:0',
            'deskripsi_barang' => 'nullable|string',
            'status' => 'required|in:pending,diterima,ditolak,selesai',
            'catatan' => 'nullable|string',
        ]);

        Donasi::create($validated);

        return redirect()->route('donasi.index')
            ->with('success', 'Donasi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Donasi $donasi)
    {
        Gate::authorize('is-admin-or-staff');
        
        return view('donasi.show', compact('donasi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Donasi $donasi)
    {
        // Hanya Admin yang bisa edit
        Gate::authorize('is-admin');
        
        return view('donasi.edit', compact('donasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Donasi $donasi)
    {
        // Hanya Admin yang bisa update
        Gate::authorize('is-admin');

        $validated = $request->validate([
            'nama_donatur' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'telepon' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'jenis_donasi' => 'required|in:uang,barang,jasa',
            'jumlah' => 'nullable|numeric|min:0',
            'deskripsi_barang' => 'nullable|string',
            'status' => 'required|in:pending,diterima,ditolak,selesai',
            'catatan' => 'nullable|string',
        ]);

        $donasi->update($validated);

        return redirect()->route('donasi.index')
            ->with('success', 'Donasi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Donasi $donasi)
    {
        // Hanya Admin yang bisa delete
        Gate::authorize('delete-donasi');

        $donasi->delete();

        return redirect()->route('donasi.index')
            ->with('success', 'Donasi berhasil dihapus.');
    }

    /**
     * Validasi donasi (Admin dan Staff bisa validasi)
     */
    public function validateDonasi(Request $request, Donasi $donasi)
    {
        Gate::authorize('validate-donasi');

        $validated = $request->validate([
            'status' => 'required|in:diterima,ditolak',
            'catatan' => 'nullable|string',
        ]);

        $donasi->update([
            'status' => $validated['status'],
            'catatan' => $validated['catatan'] ?? $donasi->catatan,
            'user_id' => auth()->id(), // Staff yang memvalidasi
        ]);

        return redirect()->route('donasi.index')
            ->with('success', 'Donasi berhasil divalidasi.');
    }

    /**
     * Laporan donasi (Admin dan Staff bisa lihat)
     */
    public function laporan()
    {
        Gate::authorize('view-report');

        $totalDonasi = Donasi::count();
        $donasiPending = Donasi::where('status', 'pending')->count();
        $donasiDiterima = Donasi::where('status', 'diterima')->count();
        $donasiDitolak = Donasi::where('status', 'ditolak')->count();
        $donasiSelesai = Donasi::where('status', 'selesai')->count();
        $totalUang = Donasi::where('jenis_donasi', 'uang')
            ->where('status', 'diterima')
            ->sum('jumlah');

        return view('donasi.laporan', compact(
            'totalDonasi',
            'donasiPending',
            'donasiDiterima',
            'donasiDitolak',
            'donasiSelesai',
            'totalUang'
        ));
    }
}
