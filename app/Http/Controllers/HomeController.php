<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bansos;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data_bansos = Bansos::where('status', 'aktif')->get();
        return view('home', compact('data_bansos'));
    }
}
