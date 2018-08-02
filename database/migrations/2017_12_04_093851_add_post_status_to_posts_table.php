<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPostStatusToPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
           $table->string('post_status')->after('author_id');
           $table->string('created_by')->after('categories_id');
           $table->string('deleted_by')->after('created_by');
           $table->string('visibility')->after('deleted_by');
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('post_status');
            $table->dropColumn('created_by');
            $table->dropColumn('post_status');
            $table->dropColumn('deleted_by');
            $table->dropColumn('visibility');
        });
    }
}
