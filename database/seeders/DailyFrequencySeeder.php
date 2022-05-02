<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DailyFrequencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('daily_frequencies')->truncate();

        DB::table('daily_frequencies')->insert([
            [
                'id' => 1,
                'name' => '1-2'
            ],
            [
                'id' => 2,
                'name' => '3-4'
            ],
            [
                'id' => 3,
                'name' => '5+'
            ]
        ]);
    }
}
