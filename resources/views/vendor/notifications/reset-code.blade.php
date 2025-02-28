<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kode Reset Password</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f2f5;
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
            max-width: 500px;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .header {
            margin-bottom: 20px;
        }

        .header img {
            max-width: 120px;
            margin-bottom: 15px;
        }

        .header h1 {
            font-size: 26px;
            color: #333;
            font-weight: 600;
            margin: 0;
        }

        .content p {
            font-size: 16px;
            color: #555;
            line-height: 1.6;
        }

        .reset-button {
            display: inline-block;
            background: linear-gradient(135deg, #6e8efb, #a777e3);
            color: white;
            padding: 14px 28px;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            border-radius: 8px;
            font-weight: 500;
            transition: background 0.3s ease;
            margin-top: 20px;
        }

        .reset-button:hover {
            background: linear-gradient(135deg, #5a75f1, #9162e4);
        }

        .footer {
            font-size: 14px;
            color: #777;
            margin-top: 25px;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="header">
            <img src="{{asset('StarMar/StarMar-.png')}}" alt="Brand Logo">
            <h1>Reset Password</h1>
        </div>
        <div class="content">
            <p>Halo, {{ Auth::user() ? Auth::user()->first_name : 'Pengguna' }}</p>
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
