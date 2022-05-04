<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParticipantsPostRequest;
use App\Models\Frequency;
use App\Models\Participant;
use Illuminate\Database\Eloquent\Collection;

class ParticipantController extends Controller
{
    const MESSAGE_PATTERN = 'Candidate %s is assigned to %s';

    public function index()
    {
        return view(
            'tables',
            [
                'cohorts' => $this->getParticipants()
            ]
        );
    }

    public function store(ParticipantsPostRequest $request)
    {
        $data = $request->toArray();

        $frequency = Frequency::with(['cohort'])->find($data['frequency_id']);

        Participant::create($data);

        return back()->with('success', sprintf(self::MESSAGE_PATTERN, $data['first_name'], $frequency->cohort->name));
    }

    private function getParticipants(): ?Collection
    {
        return Participant::with([
            'dailyFrequency',
            'frequency' => function($query) {
                $query->with(['cohort']);
            }
        ])
            ->get()
            ->groupBy('frequency.cohort.id');
    }
}
