<?php

namespace Database\Seeders;

use App\Models\Artist;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ArtistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Artist::factory()
        ->count(10)
        ->hasAlbums(5)
        ->create();

        Artist::factory()
        ->count(5)
        ->hasAlbums(3)
        ->create();

        Artist::factory()
        ->count(30)
        ->hasAlbums(6)
        ->create();
    }
}
