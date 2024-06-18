<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AttendanceFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    return [
      'user_id' => $this->faker->numberBetween(1, 10),
      'latitude' => $this->faker->latitude,
      'longitude' => $this->faker->longitude,
      'date' => $this->faker->dateTimeBetween('2024-06-15', '2024-06-17')->format('Y-m-d'),
      'clock_in' => $this->faker->time(),
      'clock_out' => $this->faker->time(),
      'created_at' => now()
    ];
  }
}
