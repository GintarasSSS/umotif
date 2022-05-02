<?php

namespace Database\Factories;

use App\Models\DailyFrequency;
use Illuminate\Database\Eloquent\Factories\Factory;

class DailyFrequencyFactory extends Factory
{
    protected $model = DailyFrequency::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->text(10)
        ];
    }
}
