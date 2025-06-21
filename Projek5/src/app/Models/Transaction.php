<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    // Tentukan kolom yang bisa diisi mass-assignment
    protected $fillable = [
        'appointment_id',
        'invoice_code',
        'amount',
        'status',
    ];

    // Relasi ke appointment
    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}
