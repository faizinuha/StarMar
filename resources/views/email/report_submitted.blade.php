<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Dikirim</title>
    <style>
        /* Umum */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #3498db;
            font-size: 24px;
            text-align: center;
            margin-bottom: 20px;
        }

        p {
            font-size: 16px;
            line-height: 1.5;
            color: #555;
        }

        .token {
            background-color: #f1f1f1;
            padding: 10px;
            border-radius: 5px;
            font-weight: bold;
            color: #e67e22;
            font-size: 18px;
        }

        .footer {
            text-align: center;
            font-size: 14px;
            color: #aaa;
            margin-top: 30px;
        }

        .footer a {
            color: #3498db;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        /* Responsif */
        @media (max-width: 600px) {
            .container {
                padding: 20px;
            }

            h1 {
                font-size: 22px;
            }

            p {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Terima Kasih Telah Melaporkan!</h1>
        <p>Terima kasih telah mengirimkan laporan kepada kami. Kami akan segera memproses laporan Anda.</p>
        <p>Token Anda:</p>
        <div class="token">{{ $token }}</div>
        <p>Salam,</p>
        <p>Tim Kami</p>
        
        <div class="footer">
            <p>Jika Anda memiliki pertanyaan, kunjungi <a href="#">Pusat Bantuan</a></p>
        </div>
    </div>
</body>
</html>
