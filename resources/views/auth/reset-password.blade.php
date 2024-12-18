@extends('auth.layouts.main')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<div class="min-h-screen flex items-center justify-center bg-gray-900 text-gray-200">
    <form method="POST" action="{{ route('password.store') }}" class="w-full max-w-md bg-gray-800 p-6 rounded-lg shadow-lg">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <h2 class="text-2xl font-bold text-center mb-6">{{ __('Reset Password') }}</h2>

        <!-- Email Address -->
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium">{{ __('Email') }}</label>
            <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus
                class="mt-1 block w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 sm:text-sm text-gray-300"
                autocomplete="email" placeholder="Masukan Email...">
            @error('email')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-4 relative">
            <label for="password" class="block text-sm font-medium">{{ __('Password') }}</label>
            <input id="password" type="password" name="password" required
                class="mt-1 block w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 sm:text-sm text-gray-300"
                autocomplete="new-password" placeholder="Masukan Password...">
            <p id="password-strength" class="text-sm mt-2"></p>
            @error('password')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mb-4">
            <label for="password_confirmation" class="block text-sm font-medium">{{ __('Confirm Password') }}</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required
                class="mt-1 block w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 sm:text-sm text-gray-300"
                autocomplete="new-password" placeholder="Konfirmasi Password...">
            @error('password_confirmation')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit Button -->
        <div class="flex items-center justify-end mt-4">
            <button type="submit"
                class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-offset-2 focus:ring-offset-gray-800">
                {{ __('Reset Password') }}
            </button>
        </div>
    </form>
</div>

<script>
    const passwordInput = document.getElementById('password');
    const strengthIndicator = document.getElementById('password-strength');

    passwordInput.addEventListener('input', function () {
        const password = passwordInput.value;
        const strength = getPasswordStrength(password);

        strengthIndicator.textContent = `Strength: ${strength}`;
        strengthIndicator.classList.remove('text-red-500', 'text-yellow-500', 'text-green-500');
        if (strength === 'Weak') {
            strengthIndicator.classList.add('text-red-500');
        } else if (strength === 'Moderate') {
            strengthIndicator.classList.add('text-yellow-500');
        } else if (strength === 'Strong') {
            strengthIndicator.classList.add('text-green-500');
        }
    });

    function getPasswordStrength(password) {
        if (password.length < 6) {
            return 'Weak';
        } else if (password.match(/[a-z]/) && password.match(/[A-Z]/) && password.match(/\d/) && password.length >= 8) {
            return 'Strong';
        } else {
            return 'Moderate';
        }
    }
</script>

@endsection
