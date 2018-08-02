<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSurveyOptionColumnToPrtitionResultTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('petition_result', function (Blueprint $table) {
           $table->string('survey_option')->after('petition_id');           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::table('petition_result', function (Blueprint $table) {
            $table->dropColumn('survey_option');
        });
    }
}
