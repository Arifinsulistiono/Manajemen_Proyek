<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_id',
        'invoice_code',
        'amount',
        'status',
        'payment_method',
    ];

    protected static function booted()
    {
        static::creating(function ($transaction) {
            // Generate invoice code otomatis
            $transaction->invoice_code = 'INV-' . now()->format('YmdHis') . Str::upper(Str::random(4));

            // Hitung amount otomatis dari jasa dokter dan harga obat
            $transaction->amount = $transaction->calculateTotalTagihan();
        });

        static::updating(function ($transaction) {
            // Update total tagihan jika appointment diubah
            $transaction->amount = $transaction->calculateTotalTagihan();
        });
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    public function getPasienNamaAttribute()
    {
        return $this->appointment?->nama ?? '-';
    }

    public function getHargaJasaDokterAttribute()
    {
        return $this->appointment?->dokter?->harga_jasa ?? 0;
    }

    public function getObatListAttribute()
    {
        return $this->appointment?->diagnosa?->resep?->obats?->pluck('nama')->implode(', ') ?? '-';
    }

    public function getTotalHargaObatAttribute()
    {
        return $this->appointment?->diagnosa?->resep?->obats?->sum('harga') ?? 0;
    }

    public function getTotalTagihanAttribute()
    {
        return $this->harga_jasa_dokter + $this->total_harga_obat;
    }

    public function calculateTotalTagihan(): int
    {
        return $this->getTotalTagihanAttribute();
    }
}