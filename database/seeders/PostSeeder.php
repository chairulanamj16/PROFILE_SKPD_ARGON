<?php

namespace Database\Seeders;

use Database\Factories\PostFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\V1\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // PostFactory::new()->count(1000)->create();
        Post::factory()->count(10)->create();
    }
}
