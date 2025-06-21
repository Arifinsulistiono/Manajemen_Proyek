<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Diagnosa;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'email',
        'mobile',
        'date',
        'time',
        'message',
        'dokter_id'
    ];

    protected static function booted(): void
    {
        static::created(function ($appointment) {
            Diagnosa::create([
                'appointment_id' => $appointment->id,
                'dokter_id' => $appointment->dokter_id,
                'keluhan' => $appointment->message ?? '',
                'status' => 'Belum Diperiksa',
            ]);
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
}
