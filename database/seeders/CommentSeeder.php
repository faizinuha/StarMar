<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;

class CommentSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();
        $posts = Post::all();

        foreach ($users as $user) {
            foreach ($posts as $post) {
                Comment::create([
                    'user_id' => $user->id,
                    'post_id' => $post->id,
                    'content' => 'Komentar dari ' . $user->first_name,
                ]);
            }
        }
    }
}
// Ts