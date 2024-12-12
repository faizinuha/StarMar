<div class="relative bg-cover bg-center h-screen" style="background-image: url('https://source.unsplash.com/1600x900/?email');">
    <div class="absolute inset-0 bg-black opacity-50"></div>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <div class="container mx-auto px-4 py-16 relative z-10 text-white">
        <div class="max-w-lg mx-auto text-center bg-opacity-75 bg-gray-800 p-8 rounded-lg shadow-lg">
            <h1 class="text-3xl font-bold mb-4">Verifikasi Email Anda</h1>
            <p class="mb-6">Kami telah mengirimkan tautan verifikasi ke email Anda. Silakan cek email Anda untuk memverifikasi akun.</p>

            @if (session('status') == 'verification-link-sent')
                <div class="alert alert-success mb-4 p-4 bg-green-500 text-white rounded">
                    Tautan verifikasi baru telah dikirim ke alamat email Anda.
                </div>
            @endif

            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="btn btn-primary w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Kirim Ulang Tautan
                </button>
            </form>

            <div class="mt-4 text-sm">
                <p class="text-gray-200">Jika Anda tidak menerima email verifikasi, periksa folder spam Anda atau <a href="{{ route('login') }}" class="text-blue-300 hover:underline">masuk kembali</a> untuk mencoba lagi.</p>
                <p class="mt-2 text-gray-300">Jika ingin melewati verifikasi, <a href="{{ route('beranda') }}" class="text-blue-300 hover:underline">klik di sini</a>.</p>
            </div>
        </div>
    </div>
</div>
