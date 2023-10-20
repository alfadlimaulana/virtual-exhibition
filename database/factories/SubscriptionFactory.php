<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subscription>
 */
class SubscriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->uuid(),
            'expired_date' => Carbon::parse($this->faker->dateTimeBetween('-1 week', '+4 weeks'))->format('Y-m-d H:i:s'),
            'status' => function (array $attributes) {
                if($attributes['expired_date']) {
                    return Carbon::now() < $attributes['expired_date'] ? 'active' : 'expired';
                } else {
                    return 'none';
                }
            }
        ];
    }

    /**
        * Indicate that the user has no subscription.
    */
    public function none(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'expired_date' => null,
                'status' => 'none'
            ];
        });
    }

    /**
        * Indicate that the user's subscription is active.
    */
    public function active(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'expired_date' => Carbon::parse($this->faker->dateTimeBetween('now', '+4 weeks'))->format('Y-m-d H:i:s'),
                'status' => 'active'
            ];
        });
    }

    /**
        * Indicate that the user's subscription is expired.
    */
    public function expired(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'expired_date' => Carbon::parse($this->faker->dateTimeBetween('-1 week', 'now'))->format('Y-m-d H:i:s'),
                'status' => 'expired'
            ];
        });
    }
}
