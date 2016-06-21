<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableCreditRulesAddFrequencyColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('credit_rules', function (Blueprint $table) {
            $table->integer('frequency')->unsigned()->default(0)->after('slug');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('credit_rules', function (Blueprint $table) {
            $table->dropColumn('frequency');
        });
    }
}
