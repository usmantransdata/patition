<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDescriptionToCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('category', function (Blueprint $table) {
           $table->string('description')->after('name');
           $table->string('slug')->after('description');
           $table->string('post_id')->after('slug');
           $table->string('created_by')->after('post_id');
          
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('category', function (Blueprint $table) {
            $table->dropColumn('description');
            $table->dropColumn('slug');
            $table->dropColumn('post_id');
            $table->dropColumn('created_by');
        });
    }
}
