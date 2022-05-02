<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cohort extends Model
{
    use HasFactory;

    protected $table = 'cohorts';

    public function participants()
    {
        return $this->hasMany(Participant::class);
    }
}