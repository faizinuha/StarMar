<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class AiGeminiController extends Controller
{
    public function index()
    {
        return view('Ai-Gemini.Ai-Gemini');
    }

    public function chat(Request $request)
    {
        $apiKey = env('GEMINI_API_KEY');
        $userInput = trim($request->input('message'));

        if (empty($userInput)) {
            return response()->json([
                'success' => false,
                'error' => 'Pesan tidak boleh kosong.'
            ], 400);
        }

        if (empty($apiKey)) {
            return response()->json([
                'success' => false,
                'error' => 'API Key tidak ditemukan. Periksa konfigurasi .env Anda.'
            ], 500);
        }

        // Cek apakah jawaban sudah ada di cache
        $cacheKey = 'gemini_' . md5($userInput);
        if (Cache::has($cacheKey)) {
            return response()->json([
                'success' => true,
                'reply' => Cache::get($cacheKey)
            ]);
        }

        // Batasi Jumlah Chat per Hari per User
        $userChats = Session::get('chat_count', 0);

        if ($userChats >= 500) { // Maksimal 500 chat per hari
            return response()->json([
                'success' => false,
                'error' => 'Batas harian telah tercapai, coba lagi besok.'
            ], 429);
        }

        Session::increment('chat_count');

        try {
            // Kirim permintaan ke API Gemini
            $response = Http::withHeaders([
                'Content-Type' => 'application/json'
            ])->post("https://generativelanguage.googleapis.com/v1/models/gemini-pro:generateContent?key=$apiKey", [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $userInput]
                        ]
                    ]
                ]
            ]);

            // Periksa apakah respons berhasil
            if ($response->successful()) {
                $data = $response->json();

                // Pastikan data valid
                if (!isset($data['candidates'][0]['content']['parts'][0]['text'])) {
                    return response()->json([
                        'success' => false,
                        'error' => 'Respons dari AI tidak valid.'
                    ], 500);
                }

                $reply = $data['candidates'][0]['content']['parts'][0]['text'];

                // Simpan jawaban ke cache selama 1 jam
                Cache::put($cacheKey, $reply, now()->addHours(1));

                return response()->json([
                    'success' => true,
                    'reply' => $reply
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'error' => 'Gagal mendapatkan respons dari AI.'
                ], 500);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
