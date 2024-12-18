<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kode Reset Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .email-container {
            background-color: #ffffff;
            width: 100%;
            max-width: 600px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 24px;
            color: #4CAF50;
            margin: 0;
        }

        .content {
            text-align: center;
            margin-bottom: 20px;
        }

        .content p {
            font-size: 16px;
            color: #333333;
        }

        .token {
            font-size: 24px;
            font-weight: bold;
            color: #4CAF50;
            background-color: #f1f8f6;
            padding: 10px;
            border-radius: 5px;
            margin: 20px 0;
        }

        .reset-button {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 12px 24px;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .reset-button:hover {
            background-color: #45a049;
        }

        .footer {
            text-align: center;
            font-size: 14px;
            color: #777777;
            margin-top: 30px;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="header">
            <h1>Reset Password</h1>
        </div>
        <div class="content">
            <p>Halo,</p>
            <p>Anda menerima email ini karena kami menerima permintaan reset password Anda.</p>
            <!-- <p>Kode reset password Anda adalah: {{ $token }}</p> -->
            <form action="{{ route('password.confirm') }}" method="post">
                @csrf
                <a href="{{ route('password.reset', ['token' => $token]) }}" class="reset-button">Reset Password</a>
            </form>
        </div>
        <div class="footer">
            <p>Jika Anda tidak meminta untuk mereset password, abaikan email ini.</p>
        </div>
    </div>
</body>

</html>
