<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Konfirmasi Janji Temu Disetujui</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f6f8fa;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background-color: #ffffff;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        h2 {
            color: #2c3e50;
        }
        .details {
            margin-top: 20px;
            line-height: 1.6;
        }
        .details strong {
            display: inline-block;
            width: 100px;
        }
        .footer {
            margin-top: 30px;
            font-size: 0.9em;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Halo {{ $appointment->nama }},</h2>
        <p>Janji temu Anda telah <strong style="color: green;">disetujui</strong>. Berikut detailnya:</p>

        <div class="details">
            <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($appointment->date)->translatedFormat('d F Y') }}</p>
            <p><strong>Waktu:</strong> {{ $appointment->time }}</p>
            <p><strong>Dokter:</strong> {{ $appointment->dokter->nama ?? '-' }}</p>
        </div>

        <p class="footer">
            Silakan datang tepat waktu sesuai jadwal. Jika ada pertanyaan, Anda bisa menghubungi pihak klinik.  
            <br><br>Terima kasih telah menggunakan layanan kami.
        </p>
    </div>
</body>
</html>
