<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdToPeoplesProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('peoples_profile', function (Blueprint $table) {
           $table->string('user_id')->after('interest');
          
          
           
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
            $table->dropColumn('user_id');
           
        });
    }
}
