<?php

namespace Database\Factories;

use App\Models\Cohort;
use App\Models\DailyFrequency;
use App\Models\Frequency;
use App\Models\Participant;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ParticipantFactory extends Factory
{
    protected $model = Participant::class;

    public function definition(): array
    {
        return [
            'first_name' => $this->faker->text(30),
            'date_of_birth' => Carbon::now()->subYears(20),
            'frequency_id' => Frequency::factory()->create()->id,
            'daily_frequency_id' => DailyFrequency::factory()->create()->id,
            'cohort_id' => Cohort::factory()->create()->id
        ];
    }
}
