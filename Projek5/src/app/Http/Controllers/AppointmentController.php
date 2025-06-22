<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Transaction;
use App\Models\Dokter;

class AppointmentController extends Controller
{
     public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'mobile' => 'required|string|max:20',
            'date' => 'required|date',
            'time' => 'required',
            'dokter_id' => 'required|exists:dokters,id',
        ]);

        Appointment::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'date' => $request->date,
            'time' => $request->time,
            'dokter_id' => $request->dokter_id,
            'status' => 'pending', // Default
        ]);

        return redirect()->back()->with('success', 'Janji temu berhasil dibuat!');
    }

    public function index()
    {
        $appointments = Appointment::latest()->get();
        return view('admin.appointments.index', compact('appointments'));
    }

    public function show($id)
    {
        $appointment = Appointment::findOrFail($id);
        return view('admin.appointments.show', compact('appointment'));
    }

        public function create()
    {
        $dokters = Dokter::all(); // Ambil semua dokter dari DB
        return view('frontend.appointment', compact('dokters'));
    }

    public function payment($id)
    {
        $appointment = Appointment::findOrFail($id);
        $transaction = Transaction::where('appointment_id', $id)->first();

        if (!$transaction) {
            $transaction = Transaction::create([
                'appointment_id' => $id,
                'invoice_code' => 'INV-' . strtoupper(uniqid()),
                'amount' => 150000,
                'status' => 'unpaid'
            ]);
        }

        return view('frontend.payment', compact('appointment', 'transaction'));
    }

    public function pay($id)
    {
        $transaction = Transaction::where('appointment_id', $id)->firstOrFail();
        $transaction->status = 'paid';
        $transaction->save();

        return redirect()->route('appointment.payment', $id)->with('success', 'Pembayaran berhasil!');
    }
}
