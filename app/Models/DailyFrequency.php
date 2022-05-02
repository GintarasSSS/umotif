<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyFrequency extends Model
{
    use HasFactory;

    protected $table = 'daily_frequencies';

    public function participants()
    {
        return $this->hasMany(Participant::class);
    }
}
