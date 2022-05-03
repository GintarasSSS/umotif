<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParticipantsPostRequest;
use App\Models\Cohort;
use App\Models\Participant;
use Illuminate\Database\Eloquent\Collection;

class ParticipantController extends Controller
{
    const DAILY_FREQUENCY = 1;
    const DAILY_COHORT = 2;

    const DEFAULT_COHORT = 1;

    public function index()
    {
        $cohorts = $this->getCohorts();

        return view(
            'tables',
            [
                'cohorts' => [
                    'Cohort A' => $cohorts->where('id', self::DEFAULT_COHORT)->first(),
                    'Cohort B' => $cohorts->where('id', self::DAILY_COHORT)->first()
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

    private function getCohorts(): ?Collection
    {
        return Cohort::with(['participants' => function ($query) {
            $query->with(['frequency', 'dailyFrequency']);
        }])->get();
    }
}
