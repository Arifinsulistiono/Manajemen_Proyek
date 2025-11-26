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
    </style>
</head>
<body>
    <div class="header">
        <h2>Klinik SehatLah</h2>
        <p>Kab. Tangerang, Cikupa, Citra Raya</p>
        <p>Telp: +62 2345 6789 | Email: suksesorang6666@gmail.com</p>
        <hr>
        <h3>Invoice Pembayaran</h3>
    </div>

    <div class="info">
        <p><strong>Nama Pasien:</strong> {{ $appointment->nama }}</p>
        <p><strong>Tanggal:</strong> {{ $appointment->date }}</p>
        <p><strong>Jam:</strong> {{ $appointment->time }}</p>
        <p><strong>Status:</strong> {{ $appointment->transaction->status }}</p>
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
                <td style="text-align: right;">Rp {{ number_format(($appointment->dokter->harga_jasa ?? 0) + ($appointment->diagnosa->resep->obats->sum('harga') ?? 0), 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        <p>Invoice ini dicetak secara otomatis oleh sistem Klinik SehatLah.</p>
        <p>Terima kasih atas kunjungan Anda.</p>
    </div>
</body>
</html>