<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Konfirmasi Janji Temu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
            padding: 20px;
            color: #333;
        }
        .email-container {
            background-color: #ffffff;
            max-width: 600px;
            margin: auto;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        h2 {
            color: #2c3e50;
        }
        ul {
            list-style: none;
            padding-left: 0;
        }
        li {
            margin-bottom: 8px;
        }
        strong {
            width: 90px;
            display: inline-block;
        }
        .footer {
            margin-top: 30px;
            font-size: 0.9em;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <h2>Halo {{ $appointment->nama }},</h2>
        <p>Terima kasih telah membuat janji temu dengan kami. Berikut adalah detailnya:</p>

        <ul>
            <li><strong>Dokter:</strong> {{ $appointment->dokter->nama }}</li>
            <li><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($appointment->date)->translatedFormat('d F Y') }}</li>
            <li><strong>Jam:</strong> {{ $appointment->time }}</li>
            <li><strong>Status:</strong> {{ ucfirst($appointment->status) }}</li>
        </ul>

        <p>Kami akan segera mengonfirmasi janji temu Anda. Mohon tunggu notifikasi selanjutnya melalui email.</p>

        <p class="footer">Jika Anda memiliki pertanyaan, silakan hubungi pihak klinik. <br>Terima kasih telah mempercayakan layanan kesehatan Anda kepada kami.</p>
    </div>
</body>
</html>
