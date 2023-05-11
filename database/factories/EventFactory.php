<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $available_hour = $this->faker->numberBetween(10, 18);
        $minutes = [0, 30];
        $m_key = array_rand($minutes);
        $add_hour = $this->faker->numberBetween(1, 3);

        $dummyDate = $this->faker->dateTimeThisMonth;
        $start_date = $dummyDate->setTime($available_hour, $minutes[$m_key]);
        $clone = clone $start_date;
        $end_date = $clone->modify('+'.$add_hour.'hour');
        return [
            'name' => $this->faker->name,
            'information' => $this->faker->realText,
            'max_people' => $this->faker->numberBetween(1,20),
            'start_date' => $dummyDate->format('Y-m-d H:i:s'),
            'end_date' => $dummyDate->modify('+1hour')->format('Y-m-d H:i:s'),
            'is_visible' => $this->faker->boolean,
            'start_date' => $start_date,
            'end_date' => $end_date
        ];
    }
}
