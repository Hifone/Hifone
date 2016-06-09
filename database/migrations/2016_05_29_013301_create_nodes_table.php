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

class CreateNodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nodes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('section_id')->default(0);
            $table->string('name');
            $table->string('icon');
            $table->integer('status')->default(0);
            $table->integer('order')->default(0);
            $table->string('slug')->nullable();
            $table->text('description')->nullable();
            $table->integer('thread_count')->default(0);
            $table->integer('reply_count')->default(0);
            $table->timestamps();

            $table->index('section_id');
            $table->index('slug');
            $table->index('name');
            $table->index('thread_count');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('nodes');
    }
}
