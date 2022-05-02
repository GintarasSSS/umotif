<?php

namespace App\Http\Controllers;

use App\Models\DailyFrequency;
use App\Models\Frequency;

class FormController extends Controller
{
    public function index()
    {
        return view(
            'form',
            [
                'frequencies' => Frequency::all(),
                'dailyFrequencies' => DailyFrequency::all()
            ]
        );
    }
}
