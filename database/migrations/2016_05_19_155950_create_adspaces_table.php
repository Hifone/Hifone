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

class CreateAdspacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adspaces', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('adblock_id');
            $table->integer('order')->default(0);
            $table->string('position');
            $table->string('route');
            $table->timestamps();

            $table->unique('position');
            $table->index('adblock_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('adspaces');
    }
}
