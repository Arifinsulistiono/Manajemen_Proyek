<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Janji Temu Anda Ditolak</title>
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
            color: #c0392b;
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
        <p>Mohon maaf, janji temu Anda telah <strong style="color: red;">ditolak</strong>. Berikut detail pengajuannya:</p>

        <div class="details">
            <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($appointment->date)->translatedFormat('d F Y') }}</p>
            <p><strong>Waktu:</strong> {{ $appointment->time }}</p>
            <p><strong>Dokter:</strong> {{ $appointment->dokter->nama ?? '-' }}</p>
        </div>

        <p class="footer">
            Jika Anda merasa ini sebuah kekeliruan atau ingin menjadwalkan ulang, silakan hubungi pihak klinik.  
            <br><br>Terima kasih atas pengertian Anda.
        </p>
    </div>
</body>
</html>
