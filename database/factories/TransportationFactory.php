<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class TransportationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'type' => $this->faker->randomElement([
                'plane',
                'train',
                'car',
            ]),
            'airport' => $this->faker->name(),
            'terminal' => $this->faker->name(),
            'airline' => $this->faker->name(),
            'flight_number' => $this->faker->countryCode(),
            'station' => $this->faker->name(),
            'train_number' => $this->faker->countryCode(),
            'other_location' => $this->faker->name(),
            'date' => now(),
            'hotel' => $this->faker->name(),
            'address' => $this->faker->address(),
            'transfer' => $this->faker->boolean(),
        ];
    }
}
