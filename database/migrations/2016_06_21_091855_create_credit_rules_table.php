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

class CreateCreditRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credit_rules', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug')->nullable();
            $table->integer('frequency')->unsigned()->default(0);
            $table->integer('reward')->default(0);
            $table->timestamps();

            $table->unique('slug');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('credit_rules');
    }
}
