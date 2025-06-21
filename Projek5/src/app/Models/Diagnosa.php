<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnosa extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_id',
        'dokter_id',
        'keluhan',
        'status',
    ];

    /**
     * Relasi ke appointment.
     * Mengambil data appointment berdasarkan appointment_id.
     */
    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    /**
     * Relasi ke dokter.
     * Mengambil data dokter berdasarkan dokter_id.
     */
    public function dokter()
    {
        return $this->belongsTo(Dokter::class);
    }

    /**
     * Accessor untuk mengambil nama dari appointment.
     */
    public function getAppointmentNameAttribute()
    {
        return $this->appointment->name ?? null;
    }

    /**
     * Accessor untuk mengambil nama dokter.
     */
    public function getDokterNameAttribute()
    {
        return $this->dokter->nama ?? null;
    }
}
