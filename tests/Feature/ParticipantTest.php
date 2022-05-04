<?php

namespace Tests\Feature;

use App\Models\Participant;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Tests\TestCase;

class ParticipantTest extends TestCase
{
    use WithoutMiddleware;
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->artisan('db:seed');
    }

    /**
     * @dataProvider postErrorsValidationData
     */
    public function testPostErrorsValidation(array $data, array $errors, array $noErrors)
    {
        $response = $this->post('/participants', $data);

        $response->assertSessionHasErrors($errors);

        $response->assertSessionDoesntHaveErrors($noErrors);
    }

    public function testPostErrorNameIsTaken()
    {
        $name = Participant::factory()->create()->first_name;

        $response = $this->post('/participants', [
            'first_name' => $name
        ]);

        $response->assertSessionHasErrors([
            'first_name' => 'The first name has already been taken.'
        ]);
    }

    public function testPostCorrectData()
    {
        $name =  Str::random(20);

        $this->post('/participants', [
            'first_name' => $name,
            'date_of_birth' => Carbon::now()->subYears(20),
            'frequency_id' => 1,
            'daily_frequency_id' => 1
        ]);

        $this->assertDatabaseHas('participants', ['first_name' => $name]);
    }

    /**
     * @dataProvider postParticipantAssignedToCorrectCohortData
     */
    public function testPostParticipantAssignedToCorrectCohort(string $frequencyName, string $cohortName)
    {
        $name =  Str::random(20);
        $cohort = DB::table('cohorts')->where('name', $cohortName)->get('id')->first();
        $frequency = DB::table('frequencies')->where('name', $frequencyName)->get('id')->first();

        $this->post('/participants', [
            'first_name' => $name,
            'date_of_birth' => Carbon::now()->subYears(20),
            'frequency_id' => $frequency->id,
            'daily_frequency_id' => 1,
        ]);

        $this->assertDatabaseHas(
            'participants',
            [
                'first_name' => $name,
                'frequency_id' => $frequency->id
            ]
        );

        $this->assertDatabaseHas(
            'frequencies',
            [
                'id' => $frequency->id,
                'cohort_id' => $cohort->id
            ]
        );
    }

    public function postParticipantAssignedToCorrectCohortData(): array
    {
        return [
            [
                'frequencyName' => 'Daily',
                'cohortName' => 'Cohort B'
            ],
            [
                'frequencyName' => 'Weekly',
                'cohortName' => 'Cohort A'
            ],
            [
                'frequencyName' => 'Monthly',
                'cohortName' => 'Cohort A'
            ]
        ];
    }

    public function postErrorsValidationData(): array
    {
        return [
            [
                'data' => [],
                'errors' => [
                    'first_name' => 'The first name field is required.',
                    'date_of_birth' => 'The date of birth field is required.',
                    'frequency_id' => 'The frequency id field is required.'
                ],
                'no_errors' => [
                    'daily_frequency_id'
                ]
            ],
            [
                'data' => [
                    'first_name' => Str::random(60),
                    'date_of_birth' => Str::random(20),
                    'frequency_id' => rand(100, 1000)
                ],
                'errors' => [
                    'first_name' => 'The first name must not be greater than 50 characters.',
                    'date_of_birth' => 'The date of birth is not a valid date.',
                    'frequency_id' => 'The selected frequency id is invalid.'
                ],
                'no_errors' => [
                    'daily_frequency_id'
                ]
            ],
            [
                'data' => [
                    'first_name' => Str::random(10),
                    'date_of_birth' => Carbon::now()->format('Y-m-d'),
                    'frequency_id' => 1
                ],
                'errors' => [
                    'date_of_birth' => 'The date of birth must be a date before -18 years.',
                    'daily_frequency_id' => 'The daily frequency id field is required when frequency id is 1.'
                ],
                'no_errors' => [
                    'first_name',
                    'frequency_id'
                ]
            ]
        ];
    }
}
