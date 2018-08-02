<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWebsiteColumnToPeoplesProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('peoples_profile', function (Blueprint $table) {
           $table->string('web_site')->after('avatar');
          
          
           
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
            $table->dropColumn('web_site');
           
        });
    }
}
