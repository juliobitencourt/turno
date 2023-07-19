<?php

namespace Database\Factories;

use App\Enums\CheckDepositStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Check>
 */
class CheckDepositFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => (string) Str::uuid(),
            'status' => CheckDepositStatus::APPROVED,
            'description' => $this->faker->sentence,
            'amount' => '0',
            'picture' => 'filename.jpg',
        ];
    }
}
