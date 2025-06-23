<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Invoice Pembayaran - Klinik SehatLah</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            color: #333;
            margin: 40px;
        }
        h1, h2, h3, h4 {
            margin: 0;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header h2 {
            color: #0275d8;
        }
        .info {
            margin-bottom: 20px;
        }
        .info p {
            margin: 2px 0;
        }
        .badge {
            padding: 4px 10px;
            border-radius: 5px;
            color: white;
            font-weight: bold;
            font-size: 12px;
            display: inline-block;
        }
        .badge-success {
            background-color: #28a745;
        }
        .badge-danger {
            background-color: #dc3545;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f5f5f5;
        }
        .total-row td {
            font-weight: bold;
            background-color: #f9f9f9;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 12px;
            color: #777;
        }
        .bukti {
            margin-top: 20px;
            text-align: center;
        }
        .bukti img {
            max-width: 300px;
            border: 1px solid #ccc;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Klinik SehatLah</h2>
        <p>Kab. Tangerang, Cikupa, Citra Raya</p>
        <p>Telp: +62 2345 6789 | Email: kliniksehatlah@gmail.com</p>
        <hr>
        <h3>Invoice Pembayaran</h3>
    </div>

    <div class="info">
        <p><strong>Nama Pasien:</strong> {{ $appointment->nama }}</p>
        <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($appointment->date)->translatedFormat('d F Y') }}</p>
        <p><strong>Jam:</strong> {{ \Carbon\Carbon::parse($appointment->time)->format('H:i') }}</p>
        <p>
            <strong>Status:</strong>
            @if($appointment->transaction->status == 'Lunas')
                <span class="badge badge-success">Lunas</span>
            @else
                <span class="badge badge-danger">Belum Lunas</span>
            @endif
        </p>
        <p><strong>Metode Pembayaran:</strong> {{ $appointment->transaction->payment_method }}</p>
        <p><strong>Kode Invoice:</strong> {{ $appointment->transaction->invoice_code }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Deskripsi</th>
                <th style="text-align: right;">Harga</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Jasa Dokter ({{ $appointment->dokter->nama ?? '-' }})</td>
                <td style="text-align: right;">Rp {{ number_format($appointment->dokter->harga_jasa ?? 0, 0, ',', '.') }}</td>
            </tr>
            @foreach(($appointment->diagnosa->resep->obats ?? []) as $obat)
            <tr>
                <td>Obat: {{ $obat->nama }}</td>
                <td style="text-align: right;">Rp {{ number_format($obat->harga, 0, ',', '.') }}</td>
            </tr>
            @endforeach
            <tr class="total-row">
                <td>Total</td>
                <td style="text-align: right;">
                    Rp {{ number_format(($appointment->dokter->harga_jasa ?? 0) + ($appointment->diagnosa->resep->obats->sum('harga') ?? 0), 0, ',', '.') }}
                </td>
            </tr>
        </tbody>
    </table>

    @if ($appointment->transaction->bukti_pembayaran)
    <div class="bukti">
        <p><strong>Bukti Pembayaran:</strong></p>
        <img src="{{ public_path('storage/' . $appointment->transaction->bukti_pembayaran) }}" alt="Bukti Pembayaran">
    </div>
    @endif

    <div class="footer">
        <p>Invoice ini dicetak secara otomatis oleh sistem Klinik SehatLah.</p>
        <p>Terima kasih atas kunjungan Anda.</p>
    </div>
</body>
</html>
