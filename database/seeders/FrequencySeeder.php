<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FrequencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('frequencies')->truncate();

        DB::table('frequencies')->insert([
            [
                'id' => 1,
                'name' => 'Daily',
                'cohort_id' => 2
            ],
            [
                'id' => 2,
                'name' => 'Weekly',
                'cohort_id' => 1
            ],
            [
                'id' => 3,
                'name' => 'Monthly',
                'cohort_id' => 1
            ]
        ]);
    }
}
