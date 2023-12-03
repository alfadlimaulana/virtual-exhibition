<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
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
            'name' => fake()->name(),
            'phone' => fake()->phoneNumber(),
            'province' => fake()->randomElement(User::getProvinceOptions()),
            'email' => fake()->unique()->safeEmail(),
            'role' => 'pengunjung',
            'password' => Hash::make('12345678'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
        * Indicate that the user is an artist.
    */
    public function pelukis(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'role' => 'pelukis',
            ];
        });
    }

    /**
        * Indicate that the user is a curator.
    */
    public function kurator(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'role' => 'kurator',
            ];
        });
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    // public function unverified(): static
    // {
    //     return $this->state(fn (array $attributes) => [
    //         'email_verified_at' => null,
    //     ]);
    // }
}
