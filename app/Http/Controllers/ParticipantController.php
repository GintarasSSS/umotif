<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParticipantsPostRequest;
use App\Models\Cohort;
use App\Models\Participant;

class ParticipantController extends Controller
{
    const DAILY_FREQUENCY = 1;
    const DAILY_COHORT = 2;

    const DEFAULT_COHORT = 1;

    public function index()
    {
        return view(
            'tables',
            [
                'cohorts' => [
                    $this->getCohort(self::DEFAULT_COHORT),
                    $this->getCohort(self::DAILY_COHORT)
                ]
            ]
        );
    }

    public function store(ParticipantsPostRequest $request)
    {
        $data = $request->toArray();

        switch ($data['frequency_id']) {
            case self::DAILY_FREQUENCY:
                $cohort = Cohort::find(self::DAILY_COHORT);
                $message = 'Candidate %s is assigned to %s';
                break;
            default:
                $cohort = Cohort::find(self::DEFAULT_COHORT);
                $message = 'Participant %s is assigned to %s';
        }

        $data['cohort_id'] = $cohort->id;

        Participant::create($data);

        return back()->with('success', sprintf($message, $data['first_name'], $cohort->name));
    }

    private function getCohort(int $cohortId): ?Cohort
    {
        return Cohort::with(['participants' => function ($query) {
            $query->with(['frequency', 'dailyFrequency']);
        }])->find($cohortId);
    }
}
