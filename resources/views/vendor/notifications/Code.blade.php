<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kode Reset Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #aaa;
        }
        .button {
            display: inline-block;
            padding: 12px 24px;
            font-size: 16px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Permintaan Reset Password</h2>
            <p>Halo,</p>
            <p>Anda baru saja meminta untuk mereset password Anda. Berikut adalah token reset password Anda:</p>
        </div>

        <div>
            <p><strong>Token Reset Password:</strong> {{ $token }}</p>
        </div>

        <div class="footer">
            <p>Jika Anda tidak merasa melakukan permintaan reset password, abaikan email ini.</p>
            <p>&copy; {{ date('Y') }} Perusahaan Kami. Semua hak cipta dilindungi.</p>
        </div>
    </div>
</body>
</html>
