<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Storage;

class BotAutoPost extends Command
{
    protected $signature = 'bot:post-comment'; // Perintah CLI
    protected $description = 'Loader!!'; // Deskripsi perintah

    public function handle()
    {
        $users = User::all();

        foreach ($users as $user) {
            // 1. User membuat postingan
            $post = Post::create([
                'user_id' => $user->id,
                'content' => "Ini postingan otomatis dari {$user->first_name}",
                'image' => $this->getRandomImage(),
            ]);

            $this->info("User {$user->email} memposting: {$post->content}");

            // 2. User berkomentar di postingan lain
            $this->autoComment($user, $post->id);
        }

        $this->info('Berhasil!!');
    }

    private function getRandomImage()
    {
        $images = ['post1.jpg', 'post2.jpg', 'post3.jpg'];
        return 'posts/' . $images[array_rand($images)];
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
