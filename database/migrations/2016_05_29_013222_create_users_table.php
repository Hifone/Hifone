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

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->nullable();
            $table->string('password');
            $table->string('salt')->nullable();
            $table->string('email')->nullable();
            $table->string('nickname')->nullable();
            $table->string('remember_token')->nullable();
            $table->boolean('is_banned')->default(false);
            $table->string('image_url')->nullable();
            $table->string('avatar_url')->nullable();
            $table->integer('thread_count')->default(0);
            $table->integer('reply_count')->default(0);
            $table->integer('score')->default(0);
            $table->integer('notification_count')->default(0);
            $table->string('location')->nullable();
            $table->integer('location_id')->nullable();
            $table->string('bio')->nullable();
            $table->string('website')->nullable();
            $table->string('company')->nullable();
            $table->string('signature')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->unique('username');
            $table->index('location_id');
            $table->index('is_banned');
            $table->index('thread_count');
            $table->index('reply_count');
            $table->index('score');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
