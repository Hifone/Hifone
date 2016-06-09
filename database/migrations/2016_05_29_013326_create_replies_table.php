<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('replies', function (Blueprint $table) {
            $table->increments('id');
            $table->text('body');
            $table->text('body_original')->nullable();
            $table->integer('user_id');
            $table->integer('thread_id');
            $table->boolean('is_block')->default(false);
            $table->integer('like_count')->default(0);
            $table->timestamps();

            $table->index('user_id');
            $table->index('thread_id');
            $table->index('is_block');
            $table->index('like_count');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('replies');
    }
}
