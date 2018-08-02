<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDescriptionColumnToPetitionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('petition', function (Blueprint $table) {
           $table->string('description')->after('title');
           $table->string('signature_target')->after('message');
          
          
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('petition', function (Blueprint $table) {
            $table->dropColumn('description');
            $table->dropColumn('signature_target');
           
        });
    }
}
