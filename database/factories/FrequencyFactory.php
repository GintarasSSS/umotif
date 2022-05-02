<?php

namespace Database\Factories;

use App\Models\Frequency;
use Illuminate\Database\Eloquent\Factories\Factory;

class FrequencyFactory extends Factory
{
    protected $model = Frequency::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->text(10)
        ];
    }
}
