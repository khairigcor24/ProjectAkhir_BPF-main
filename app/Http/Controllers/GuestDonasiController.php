<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use Illuminate\Http\Request;

class GuestDonasiController extends Controller
{
    /**
     * Display public search page for donations
     */
    public function search(Request $request)
    {
        $query = Donasi::where('status', 'diterima')
            ->orderBy('created_at', 'desc');

        if ($request->has('q') && $request->q) {
            $query->where(function($q) use ($request) {
                $q->where('nama_donatur', 'like', '%' . $request->q . '%')
                  ->orWhere('deskripsi_barang', 'like', '%' . $request->q . '%');
            });
        }

        $donasi = $query->paginate(12);

        return view('guest.donasi.search', compact('donasi'));
    }

    /**
     * Show the form for registering donation (Guest)
     */
    public function create()
    {
        return view('guest.donasi.create');
    }

    /**
     * Store a newly created donation from guest
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_donatur' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'telepon' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'jenis_donasi' => 'required|in:uang,barang,jasa',
            'jumlah' => 'nullable|numeric|min:0',
            'deskripsi_barang' => 'nullable|string',
        ]);

        $validated['status'] = 'pending'; // Default status untuk guest

        Donasi::create($validated);

        return redirect()->route('guest.donasi.create')
            ->with('success', 'Terima kasih! Donasi Anda telah terdaftar dan sedang menunggu validasi.');
    }
}
