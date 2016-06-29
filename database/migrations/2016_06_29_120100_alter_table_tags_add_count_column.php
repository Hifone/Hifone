<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableTagsAddCountColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tags', function (Blueprint $table) {
            $table->integer('count')->after('slug')->unsigned()->default(0); // count of how many times this tag was used
            $table->index('count');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('tags', function (Blueprint $table) {
            $table->dropColumn('count');
        });
    }
}
