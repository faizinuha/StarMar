<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tindakan terhadap Laporan Anda</title>
    <style>
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

        .footer {
            text-align: center;
            font-size: 14px;
            color: #aaa;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Terima Kasih Telah Melaporkan!</h1>

        <p>Terima kasih telah mengirimkan laporan kepada kami mengenai <strong>{{ $category }}</strong>.</p>

        @if($category == 'Spam')
            <p>Konten Anda yang dilaporkan sebagai spam akan segera diproses oleh tim kami.</p>
        @elseif($category == 'Inappropriate')
            <p>Konten Anda yang dilaporkan sebagai "Konten Tidak Pantas" akan segera ditinjau.</p>
        @elseif($category == 'Harassment')
            <p>Konten Anda yang dilaporkan sebagai "Pelecehan" akan segera diproses.</p>
        @endif

        {{-- <p>Token Laporan Anda: <strong>{{ $report->id }}</strong></p> --}}
        <p>Salam,</p>
        <p>Tim Kami</p>

        <div class="footer">
            <p>Jika Anda memiliki pertanyaan, kunjungi <a href="#">Pusat Bantuan</a></p>
        </div>
    </div>
</body>
</html>
