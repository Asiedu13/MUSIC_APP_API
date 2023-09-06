<?php

namespace Database\Factories;

use App\Models\Album;
use App\Models\Artist;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Song>
 */
class SongFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'album_id' => Album::factory(),
            'title' => $this->faker->catchPhrase(),
            'artist_id' => Artist::factory(),
            'genre' => $this->faker->word(),
            'rating' => $this->faker->numberBetween(0, 100),
            'date_released' => $this->faker->dateTimeThisDecade(),
            'is_active' => true,
        ];
    }
}
