<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();

        foreach ($users as $user) {
            Post::create([
                'user_id' => $user->id,
                'image' => 'posts/' . Str::random(10) . '.jpg', // Simulasi gambar
                'content' => 'Ini adalah postingan otomatis dari ' . $user->first_name,
            ]);
        }
    }
}
