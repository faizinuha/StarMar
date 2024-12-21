<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loading Screen</title>
    {{-- <link rel="stylesheet" href="styles.css"> --}}
    <style>
        /* Loading screen */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #ffffff;
            /* Latar belakang putih */
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            opacity: 1;
            /* Awalnya sepenuhnya terlihat */
            transition: opacity 0.5s ease-out;
            /* Efek transisi */
        }

        .loading-container {
            text-align: center;
        }

        .loading-logo {
            width: 100px;
            /* Ukuran logo */
            margin-bottom: 20px;
        }

        .spinner {
            border: 4px solid rgba(255, 255, 255, 0.3);
            border-top: 4px solid #3498db;
            /* Warna spinner */
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
        }

        /* Animasi spinner */
        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Konten utama */
        #mainContent {
            display: block;
            text-align: center;
            margin-top: 20px;
            opacity: 0;
            /* Awalnya tidak terlihat */
            transition: opacity 0.5s ease-in-out;
            /* Efek transisi */
        }

        /* Penundaan tampilan konten */
        #mainContent.fadeIn {
            opacity: 1;
            /* Menjadi terlihat */
        }
    </style>
</head>

<body>
    <!-- Loading screen -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-container">
            <img src="{{ asset('StarMar/StarMar.png') }}" alt="Logo" class="loading-logo">
            <div class="spinner"></div>
        </div>
    </div>

    <!-- Konten utama -->
    <div id="mainContent">
        <h1>Selamat datang di website kami!</h1>
    </div>

    {{-- <script src="script.js"></script> --}}
    <script>
        // Cek apakah loading screen sudah pernah ditampilkan di sesi ini
        if (!sessionStorage.getItem('loadingShown')) {
            // Durasi loading screen (misalnya 3 detik)
            const loadingDuration = 3000; // dalam milidetik

            window.onload = function() {
                // Menunggu selama loadingDuration dan kemudian menghilangkan loading screen
                setTimeout(function() {
                    // Sembunyikan loading overlay dengan transisi
                    document.getElementById('loadingOverlay').style.opacity = '0';

                    // Setelah transisi selesai, sembunyikan loading screen
                    setTimeout(function() {
                        document.getElementById('loadingOverlay').style.display = 'none';
                        // Tampilkan konten utama dengan transisi fade-in
                        const mainContent = document.getElementById('mainContent');
                        mainContent.classList.add('fadeIn'); // Menambahkan kelas untuk animasi fade
                    }, 500); // Menunggu selama transisi selesai
                    // Tandai bahwa loading screen telah ditampilkan
                    sessionStorage.setItem('loadingShown', 'true');
                }, loadingDuration);
            };
        } else {
            // Jika sudah pernah ditampilkan, langsung tampilkan konten utama
            window.onload = function() {
                document.getElementById('loadingOverlay').style.display = 'none';
                const mainContent = document.getElementById('mainContent');
                mainContent.classList.add('fadeIn'); // Menambahkan animasi fade-in
            };
        }
    </script>
</body>

</html>
