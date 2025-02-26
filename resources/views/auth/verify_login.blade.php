<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-semibold text-center mb-4">Verifikasi Login</h2>
        <p class="text-gray-600 text-center mb-4">Kami telah mengirimkan kode ke email Anda. Masukkan kode tersebut untuk melanjutkan.</p>

        @if (session('error'))
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-center">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('cheaker.account.post') }}" class="space-y-4">
            @csrf
            <div>
                <label for="code" class="block text-gray-700 font-medium">Kode Verifikasi</label>
                <input type="text" id="code" name="code" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">Verifikasi</button>
        </form>
    </div>
</div>
