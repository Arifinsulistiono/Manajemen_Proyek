<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Transaction;
use App\Models\Dokter;
use App\Mail\AppointmentApprovedMail;
use App\Mail\AppointmentRejectedMail;
use Illuminate\Support\Facades\Mail;
use App\Mail\PaymentSuccessMail;

class AppointmentController extends Controller
{
    // Menyimpan janji temu dari form frontend
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
        // Cek apakah email sudah punya appointment yang belum lunas
        $existingAppointment = Appointment::where('email', $request->email)
        ->whereHas('transaction', function ($q) {
            $q->where('status', '!=', 'Lunas');
        })
        ->first();

    if ($existingAppointment) {
        return redirect()->back()->with('error', 'Anda sudah memiliki janji temu yang belum dibayar.');
    }

        Appointment::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'date' => $request->date,
            'time' => $request->time,
            'dokter_id' => $request->dokter_id,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Janji temu berhasil dibuat!');
    }

    // Tampilkan list appointment untuk admin
    public function index()
    {
        $appointments = Appointment::latest()->get();
        return view('admin.appointments.index', compact('appointments'));
    }

    // Tampilkan detail appointment
    public function show($id)
    {
        $appointment = Appointment::findOrFail($id);
        return view('admin.appointments.show', compact('appointment'));
    }

    // Form pendaftaran appointment
    public function create()
    {
        $dokters = Dokter::all();
        return view('frontend.appointment', compact('dokters'));
    }

    // Tampilkan form input email (frontend)
    public function paymentForm()
    {
        return view('frontend.payment');
    }

    // Cari data appointment berdasarkan email (frontend)
    public function paymentByEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $appointments = Appointment::where('email', $request->email)
            ->with(['dokter', 'diagnosa.resep.obats', 'transaction'])
            ->orderBy('date', 'desc')
            ->orderBy('time', 'desc')
            ->get();

        if ($appointments->isEmpty()) {
            return redirect()->back()->with('error', 'Data tidak ditemukan untuk email tersebut.');
        }

        // Buat transaksi jika belum ada
        foreach ($appointments as $appointment) {
            if (!$appointment->transaction) {
                Transaction::create([
                    'appointment_id' => $appointment->id,
                    'invoice_code' => 'INV-' . strtoupper(uniqid()),
                    'amount' => 0, // dihitung di view
                    'status' => 'Belum Lunas'
                ]);
            }
        }

        return view('frontend.payment', compact('appointments'));
    }


    // Tampilkan halaman pembayaran berdasarkan appointment_id (admin atau frontend)
    public function payment($id)
{
    $appointment = Appointment::with(['dokter', 'diagnosa.resep.obats'])->findOrFail($id);
    $transaction = Transaction::where('appointment_id', $id)->first();

    if (!$transaction) {
        $transaction = Transaction::create([
            'appointment_id' => $appointment->id,
            'status' => 'Belum Lunas',
        ]);
    }

    return view('frontend.payment', compact('appointment', 'transaction'));
}

    // Tandai transaksi sudah dibayar
    // public function pay($id)
    // {
    //     $transaction = Transaction::where('appointment_id', $id)->firstOrFail();
    //     $transaction->status = 'Lunas';
    //     $transaction->save();

    //     return redirect()->route('appointment.payment', $id)->with('success', 'Pembayaran berhasil!');
    // }
    public function pay(Request $request, $id)
{
    $request->validate([
        'payment_method' => 'required',
        'bukti_pembayaran' => 'nullable|image|max:2048'
    ]);

    $transaction = Transaction::where('appointment_id', $id)->firstOrFail();
    $transaction->status = 'Lunas';
    $transaction->payment_method = $request->payment_method;

    if ($request->hasFile('bukti_pembayaran')) {
        $path = $request->file('bukti_pembayaran')->store('bukti', 'public');
        $transaction->bukti_pembayaran = $path;
    }

    $transaction->save();

    // Tambahkan bagian ini untuk kirim email
    $appointment = $transaction->appointment()->with('dokter')->first();
    Mail::to($appointment->email)->send(new PaymentSuccessMail($appointment));

    return redirect()->route('appointment.payment.invoice', $id)
        ->with('success', 'Pembayaran berhasil dan email notifikasi telah dikirim!');
}


public function invoice($id)
{
    $appointment = Appointment::with(['dokter', 'diagnosa.resep.obats', 'transaction'])->findOrFail($id);
    $pdf = Pdf::loadView('frontend.invoice', compact('appointment'));
    return $pdf->download('invoice_' . $appointment->id . '.pdf');
}
public function approve($id)
{
    $appointment = Appointment::findOrFail($id);
    $appointment->status = 'approved';
    $appointment->save();

    // Kirim email notifikasi
    Mail::to($appointment->email)->send(new AppointmentApprovedMail($appointment));

    return redirect()->route('appointments.index')->with('success', 'Appointment berhasil disetujui dan email telah dikirim.');
}


public function reject($id)
{
    $appointment = Appointment::findOrFail($id);
    $appointment->status = 'Rejected';
    $appointment->save();

    // Pastikan menggunakan email langsung dari $appointment
    if ($appointment->email) {
        Mail::to($appointment->email)->send(new AppointmentRejectedMail($appointment));
    }

    return redirect()->route('appointments.index')->with('success', 'Appointment ditolak dan email dikirim.');
}

}