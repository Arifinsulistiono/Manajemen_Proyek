<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Dokter;

class HomeController extends Controller
{
    public function index()
    {
        $doctors = Dokter::all();
        $totalPatients = Appointment::count();
        return view('frontend.index', compact('doctors','totalPatients'));
        
    }
    public function team()
    {
        $doctors = Dokter::all();
        return view('frontend.team', compact('doctors'));
    }
    public function about()
    {
        $doctors = Dokter::all();
        return view('frontend.about', compact('doctors'));
    }
}