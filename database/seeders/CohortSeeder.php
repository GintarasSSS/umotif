<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CohortSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cohorts')->truncate();

        DB::table('cohorts')->insert([
            [
                'id' => 1,
                'name' => 'Cohort A'
            ],
            [
                'id' => 2,
                'name' => 'Cohort B'
            ]
        ]);
    }
}
