<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNickNameToPeoplesProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('peoples_profile', function (Blueprint $table) {
           $table->string('nick_name')->after('id');
          
          
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('peoples_profile', function (Blueprint $table) {
            $table->dropColumn('nick_name');
           
        });
    }
}
