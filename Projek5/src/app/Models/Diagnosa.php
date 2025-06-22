<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Resep;

class Diagnosa extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_id',
        'dokter_id',
        'keluhan',
        'status',
    ];

        protected static function booted(): void
    {
        static::updated(function ($diagnosa) {
            // Mengecek apakah status berubah dari "Belum Diperiksa" ke "Sudah diperiksa"
            if (
                $diagnosa->getOriginal('status') === 'Belum diperiksa' &&
                $diagnosa->status === 'Sudah diperiksa' &&
                !Resep::where('diagnosa_id', $diagnosa->id)->exists()
            ) {
                Resep::create([
                    'diagnosa_id' => $diagnosa->id,
                    'obat_id' => null,
                ]);
            }
        });
    }

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

    public function resep()
    {
        return $this->hasOne(Resep::class);
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
