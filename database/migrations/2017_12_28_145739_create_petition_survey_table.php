<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePetitionSurveyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('petition_survey', function (Blueprint $table) {
            $table->increments('id');
             $table->string('title');
             $table->string('question');
             $table->string('option1');
             $table->string('option2');
             $table->string('option3');
             $table->string('option4');
             $table->string('correct_answer');
             $table->integer('petition_id');
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('petition_survey');
    }
}
