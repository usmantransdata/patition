<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropDecisionMakerColumnFromPetition extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('petition', function (Blueprint $table) {
            $table->dropColumn('decision_maker');
            $table->dropColumn('message');
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('petition', function (Blueprint $table) {
          $table->string('decision_maker')->unsigned();
          $table->string('message')->unsigned();
        });
    }
}
