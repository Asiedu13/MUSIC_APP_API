<?php

namespace Database\Seeders;

use App\Models\Album;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AlbumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Album::factory()
        ->count(10)
        ->hasSongs(150)
        ->create();

        Album::factory()
        ->count(6)
        ->hasSongs(50)
        ->create();

        Album::factory()
        ->count(20)
        ->hasSongs(70)
        ->create();
    }
}
