<?php

namespace Database\Factories;

use App\Models\Artist;
use Illuminate\Database\Eloquent\Factories\Factory;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Album>
 */
class AlbumFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'artist_id' => Artist::factory(),
            'title' => $this->faker->catchPhrase(),
            'number_of_songs' => $this->faker->numberBetween(0, 15),
            'date_released' => $this->faker->dateTimeThisDecade(),
            'rating' => $this->faker->numberBetween(0, 100),
            'is_active' => true,
        ];
    }
}
