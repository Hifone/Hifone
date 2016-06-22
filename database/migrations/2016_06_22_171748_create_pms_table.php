<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('pms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('root_id', 10);
            $table->integer('user_id');
            $table->integer('author_id');
            $table->tinyInteger('folder');
            $table->integer('meta_id');
            $table->timestamps();

            $table->index('user_id');
            $table->index('root_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pms');
    }
}
