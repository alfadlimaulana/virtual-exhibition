<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
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
            'total' => fake()->randomFloat(3,100000,300000),
            'payment_date' => fake()->randomElement([null, Carbon::parse($this->faker->dateTimeBetween('now', '+2 weeks'))->format('Y-m-d H:i:s')]),
            'method' => 'bca',
            'status' => function (array $attributes) {
                return $attributes['payment_date'] ? 'paid' : 'unpaid';
            },
        ];
    }

     /**
        * Indicate that the user has paid the bill.
    */
    public function paid(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'payment_date' => \Carbon\Carbon::parse($this->faker->dateTimeBetween('now', '+2 weeks'))->format('Y-m-d H:i:s'),
                'status' => 'paid'
            ];
        });
    }

     /**
        * Indicate that the user hasn't pay the bill.
    */
    public function unpaid(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'payment_date' => null,
                'status' => 'unpaid'
            ];
        });
    }
}
