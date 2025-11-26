<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Pembayaran Berhasil</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f8f9fa; padding: 20px;">
    <div style="max-width: 600px; background: #ffffff; padding: 20px; border-radius: 8px; margin: auto;">
        <h2 style="color: #28a745;">Pembayaran Berhasil</h2>

        <p>Halo <strong>{{ $appointment->nama }}</strong>,</p>
        <p>Terima kasih! Pembayaran janji temu Anda telah berhasil.</p>

        <hr>
        <h4>Detail Pembayaran:</h4>
        <p>
            <strong>Nama Pasien:</strong> {{ $appointment->nama }}<br>
            <strong>Tanggal:</strong> {{ $appointment->date }}<br>
            <strong>Jam:</strong> {{ $appointment->time }}<br>
            <strong>Status:</strong> {{ ucfirst($appointment->transaction->status) }}<br>
            <strong>Metode Pembayaran:</strong> {{ $appointment->transaction->payment_method ?? '-' }}<br>
            <strong>Kode Invoice:</strong> {{ $appointment->transaction->invoice_code ?? '-' }}
        </p>

        <hr>
        <h4>Deskripsi Harga:</h4>
        <ul>
            <li><strong>Jasa Dokter ({{ $appointment->dokter->nama }})</strong> — Rp {{ number_format(($hargaJasa = $appointment->dokter->harga_jasa ?? 0), 0, ',', '.') }}</li>

            @if($appointment->diagnosa && $appointment->diagnosa->resep && $appointment->diagnosa->resep->obats->count())
                @foreach($appointment->diagnosa->resep->obats as $obat)
                    <li>
                        Obat: {{ $obat->nama }} — 
                        Rp {{ number_format($obat->harga * ($obat->pivot->jumlah ?? 1), 0, ',', '.') }}
                    </li>
                @endforeach
            @endif
        </ul>

        @php
            $totalObat = $appointment->diagnosa && $appointment->diagnosa->resep
                ? $appointment->diagnosa->resep->obats->sum(function ($obat) {
                    return $obat->harga * ($obat->pivot->jumlah ?? 1);
                })
                : 0;
            $total = $hargaJasa + $totalObat;
        @endphp

        <p><strong>Total:</strong> Rp {{ number_format($total, 0, ',', '.') }}</p>

        <hr>
        <p>Silakan simpan email ini sebagai bukti pembayaran. Jika Anda memiliki pertanyaan, hubungi kami kapan saja.</p>
        <p>Terima kasih atas kepercayaan Anda!</p>
    </div>
</body>
</html>
