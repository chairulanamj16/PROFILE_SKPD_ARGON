<?php

namespace Database\Seeders;

use App\Models\V1\ThemeGallery;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ThemeGalleriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ThemeGallery::create([
            'uuid' => '1',
            'slug' => '1',
            'name' => '1',
            'description' => '1', // Ganti dengan password yang diinginkan
            'image' => '1'
        ]);
    }
}
