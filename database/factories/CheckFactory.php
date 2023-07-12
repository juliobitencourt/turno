<?php

namespace Database\Factories;

use App\Enums\CheckStatus;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Check>
 */
class CheckFactory extends Factory
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
            'status_id' => CheckStatus::ACCEPTED,
            'description' => $this->faker->sentence,
            'amount' => '0',
            'filename' => $this->faker->string(),
        ];
    }
}
