<?php

namespace App\Http\Controllers;

use App\Models\Diagnosa;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
class DiagnosaController extends Controller
{
public function create()
{
    $appointments = Appointment::all(); // atau bisa pakai filter
    return view('frontend.diagnosa', compact('appointments'));
}

    public function store(Request $request)
{
    $request->validate([
        'appointment_id' => 'required|exists:appointments,id',
        'keluhan' => 'required|string',
        'status' => 'required|string',
    ]);

    Diagnosa::create([
        'appointment_id' => $request->appointment_id,
        'dokter_id' => Auth::id(), // otomatis dari user login
        'keluhan' => $request->keluhan,
        'status' => $request->status,
    ]);

    return redirect()->route('diagnosa')->with('success', 'Diagnosa berhasil disimpan.');
}

}

