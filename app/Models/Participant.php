<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    protected $table = 'participants';

    protected $fillable = [
        'first_name',
        'date_of_birth',
        'frequency_id',
        'daily_frequency_id'
    ];

    public function frequency()
    {
        return $this->belongsTo(Frequency::class);
    }

    public function dailyFrequency()
    {
        return $this->belongsTo(DailyFrequency::class);
    }
}
