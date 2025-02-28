
    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title', 'Forgot-Password')</title>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        @stack('styles')
    </head>
    <body class="bg-gray-100 flex items-center justify-center min-h-screen">
        <div class="max-w-md w-full bg-white shadow-lg rounded-lg p-6">
            <div class="text-center mb-4">
                <img src="{{asset('StarMar/StarMar-.png')}}" class="w-20 h-20 mx-auto" alt="StarMar">
                <h2 class="text-2xl font-semibold text-gray-800">{{ __('Forgot your password?') }}</h2>
                <p class="mt-2 text-sm text-gray-600">{{ __('Demi Keamanan Bersama Mohon Untuk Memasukkan Email Anda Untuk Melakukan Reset Password...') }}</p>
            </div>

            <!-- Session Status -->
            @if (session('status'))
                <div class="mb-4 text-sm text-green-600 text-center">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">{{ __('Email') }}</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }} " placeholder="Masukan Email Anda!" required autofocus
                        class="mt-2 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @error('email')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-center mt-6">
                    <button type="submit"
                        class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white rounded-lg font-semibold hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition duration-200 ease-in-out">
                        {{ __('Reset password') }}
                    </button>
                </div>
                 <!-- Opsi jika lupa email -->
                 <a href="#" class="text-sm text-indigo-600 hover:text-indigo-500 mt-2 block text-center">
                    {{ __('Lupa email? Klik di sini untuk bantuan') }}
                </a>
            </form>
        </div>
    </body>
    </html>
