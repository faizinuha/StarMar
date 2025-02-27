<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class BotAutoPost extends Command
{
    protected $signature = 'bot:post-comment'; // Perintah CLI
    protected $description = 'Loader!!'; // Deskripsi perintah

    public function handle()
    {
        $users = User::all();

        foreach ($users as $user) {
            $imageUrl = $this->getRandomImageUrl();
            if ($imageUrl) {
                $imagePath = $this->downloadAndSaveImage($imageUrl);

                $post = Post::create([
                    'user_id' => $user->id,
                    'content' => "Ini postingan otomatis dari {$user->first_name}",
                    'image' => $imagePath,
                ]);

                $this->info("User {$user->email} memposting: {$post->content}");
                $this->autoComment($user, $post->id);
            } else {
                $this->warn("Gagal mendapatkan gambar untuk user {$user->email}");
            }
        }

        $this->info('Berhasil!!');
    }

    private function getRandomImageUrl()
    {
        $apiKey = env('PIXABAY_API_KEY');
        $response = Http::get("https://pixabay.com/api/", [
            'key' => $apiKey,
            'q' => 'media sosial',
            'image_type' => 'photo',
            'per_page' => 100,
        ]);

        if ($response->successful()) {
            $data = $response->json();
            if ($data['totalHits'] > 0) {
                $randomImage = $data['hits'][array_rand($data['hits'])];
                return $randomImage['webformatURL'];
            }
        }

        return null; // Jika tidak ada gambar yang ditemukan
    }
    private function downloadAndSaveImage($url)
    {
        $contents = file_get_contents($url);
        $name = 'storage/' . Str::random(10) . '.jpg';
        Storage::put('public/' . $name, $contents);
        return $name;
    }

    private function autoComment($user, $post_id)
    {
        // Ambil 3 user random selain diri sendiri untuk dikomentari
        $randomUsers = User::where('id', '!=', $user->id)->inRandomOrder()->take(3)->get();

        foreach ($randomUsers as $randomUser) {
            Comment::create([
                'user_id' => $user->id,
                'post_id' => $post_id,
                'content' => "Komentar dari {$user->first_name} ke {$randomUser->first_name}",
            ]);

            $this->info("User {$user->email} berkomentar di postingan {$randomUser->email}");
        }
    }
}
