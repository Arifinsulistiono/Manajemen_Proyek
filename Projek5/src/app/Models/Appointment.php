<?php

namespace App\Models;

use App\Mail\AppointmentApprovedMail;
use App\Mail\AppointmentCreatedMail;
use App\Models\Diagnosa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'email',
        'mobile',
        'date',
        'time',
        'status',
        'dokter_id'
    ];

    protected static function booted(): void
    {
        // Ketika appointment dibuat
        static::created(function ($appointment) {
            // Kirim email konfirmasi
            Mail::to($appointment->email)->send(new AppointmentCreatedMail($appointment));
        });

        // Ketika status appointment diupdate ke 'approved'
        static::updated(function ($appointment) {
            if ($appointment->isDirty('status') && $appointment->status === 'approved') {
                // Kirim email pemberitahuan disetujui
                Mail::to($appointment->email)->send(new AppointmentApprovedMail($appointment));

                // Buat diagnosa otomatis
                Diagnosa::create([
                    'appointment_id' => $appointment->id,
                    'dokter_id' => $appointment->dokter_id,
                    'keluhan' => '',
                    'status' => 'Belum Diperiksa',
                ]);
            }
        });
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }

    public function diagnosa()
    {
        return $this->hasOne(Diagnosa::class);
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class);
    }
    public function user()
    {
    return $this->belongsTo(User::class);
    }

}
