<?php

namespace App\Http\Controllers;

use App\Models\Bansos;
use Illuminate\Http\Request;

class BansosController extends Controller
{
    public function show($id)
    {
        $bansos = Bansos::findOrFail($id);
        return view('bansos.show', compact('bansos'));
    }
}