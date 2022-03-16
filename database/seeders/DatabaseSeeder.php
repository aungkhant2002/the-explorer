<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Gallery;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => "Aung Khant",
            'email' => "ak@gmail.com",
            'email_verified_at' => now(),
            'password' => Hash::make("asdffdsa"),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => "Kyaw Kyaw",
            'email' => "kyawkyaw@gmail.com",
            'email_verified_at' => now(),
            'password' => Hash::make("asdffdsa"),
            'remember_token' => Str::random(10),
        ]);

        User::factory(25)->create();
        Post::factory(120)->create();
        Comment::factory(340)->create();
        Gallery::factory(500)->create();
    }
}
