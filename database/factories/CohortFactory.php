<?php

namespace Database\Factories;

use App\Models\Cohort;
use Illuminate\Database\Eloquent\Factories\Factory;

class CohortFactory extends Factory
{
    protected $model = Cohort::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->text(10)
        ];
    }
}
