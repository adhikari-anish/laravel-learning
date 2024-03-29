<?php

namespace Database\Factories;

use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;

class AuthorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function ($author, $faker) {
            $author->profile()->save(Profile::factory()->make());
        })->afterMaking(function ($author, $faker) {
            $author->profile()->save(Profile::factory()->make());
        });
    }
}
