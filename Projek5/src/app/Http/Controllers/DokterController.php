<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokter; // Pastikan model Dokter ada

class DokterController extends Controller
{
    public function index()
    {
        $dokters = Dokter::all();
        return view('dokter.index', compact('dokters'));
    }
}
