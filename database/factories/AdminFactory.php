<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
           
                'name' => $this->faker->name(),
                'image' => $this->faker->name(),
                'password' => $this->faker->name(),
                'email' => $this->faker->unique()->safeEmail(),
        ];
    }
}
