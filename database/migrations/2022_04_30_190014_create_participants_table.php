<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 255)->unique();
            $table->timestamp('date_of_birth');
            $table->unsignedInteger('frequency_id');
            $table->unsignedInteger('daily_frequency_id')->nullable();
            $table->unsignedInteger('cohort_id');

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();

            $table->foreign('frequency_id')->references('id')->on('frequencies');
            $table->foreign('daily_frequency_id')->references('id')->on('daily_frequencies');
            $table->foreign('cohort_id')->references('id')->on('cohorts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('participants');
    }
}
