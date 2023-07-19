<?php

namespace Database\Factories;

use App\Enums\TransactionType;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Check>
 */
class TransactionFactory extends Factory
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
            'type' => TransactionType::DEPOSIT,
            'description' => $this->faker->sentence,
            'amount' => '0',
        ];
    }
}
