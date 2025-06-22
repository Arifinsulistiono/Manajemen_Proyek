<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Transaction;

class Resep extends Model
{
    use HasFactory;

    protected $fillable = [
        'diagnosa_id',
    ];

    public function diagnosa()
    {
        return $this->belongsTo(Diagnosa::class);
    }

    // Relasi many-to-many ke obat
    public function obats()
    {
        return $this->belongsToMany(Obat::class);
    }

    // Event model: saat resep dibuat, otomatis buat transaksi
    public static function booted()
    {
        static::created(function ($resep) {
            $diagnosa = $resep->diagnosa;
            $appointment = $diagnosa->appointment;

            $jasaDokter = $appointment->dokter?->harga_jasa ?? 0;
            $hargaObat = $resep->obats()->sum('harga');
            $total = $jasaDokter + $hargaObat;

            // Cegah duplikat transaksi
            if (!$appointment->transaction) {
                Transaction::create([
                    'appointment_id' => $appointment->id,
                    'invoice_code' => 'INV-' . now()->format('YmdHis') . strtoupper(Str::random(4)),
                    'amount' => $total,
                    'status' => 'Belum Lunas',
                ]);
            }
        });

        static::updated(function ($resep) {
            // Update harga jika obat diubah
            $diagnosa = $resep->diagnosa;
            $appointment = $diagnosa->appointment;

            $jasaDokter = $appointment->dokter?->harga_jasa ?? 0;
            $hargaObat = $resep->obats()->sum('harga');
            $total = $jasaDokter + $hargaObat;

            if ($appointment->transaction) {
                $appointment->transaction->update([
                    'amount' => $total,
                ]);
            }
        });
    }
}
