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

class CreateThreadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('threads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('body');
            $table->text('body_original')->nullable();
            $table->integer('user_id');
            $table->integer('node_id');
            $table->integer('order')->default(0);
            $table->text('excerpt')->nullable();
            $table->boolean('is_excellent')->default(false);
            $table->boolean('is_blocked')->default(false);
            $table->integer('reply_count')->default(0);
            $table->integer('view_count')->default(0);
            $table->integer('favorite_count')->default(0);
            $table->integer('like_count')->default(0);
            $table->integer('last_reply_user_id')->default(0);
            $table->softDeletes();
            $table->timestamps();

            $table->index('user_id');
            $table->index('node_id');
            $table->index('title');
            $table->index('order');
            $table->index('is_excellent');
            $table->index('is_blocked');
            $table->index('reply_count');
            $table->index('view_count');
            $table->index('favorite_count');
            $table->index('like_count');
            $table->index('last_reply_user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('threads');
    }
}
