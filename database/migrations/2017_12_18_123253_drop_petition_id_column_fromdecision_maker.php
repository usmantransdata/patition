<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropPetitionIdColumnFromdecisionMaker extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('decision_maker', function (Blueprint $table) {
            $table->dropColumn('petition_id');
            $table->dropColumn('user_id');
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('decision_maker', function (Blueprint $table) {
          $table->string('petition_id')->unsigned();
          $table->string('user_id')->unsigned();
        });
    }
}
