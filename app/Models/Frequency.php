<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Frequency extends Model
{
    use HasFactory;

    protected $table = 'frequencies';

    public function participants()
    {
        return $this->hasMany(Participant::class);
    }

    public function cohort()
    {
        return $this->belongsTo(Cohort::class);
    }
}
