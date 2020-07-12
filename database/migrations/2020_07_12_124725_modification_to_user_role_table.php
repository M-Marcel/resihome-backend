<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModificationToUserRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_role', function (Blueprint $table) {
            $table->dropColumn('buyer');
            $table->dropColumn('owner');
            $table->dropColumn('agent');
            $table->dropColumn('morgage_lender');
            $table->dropColumn('home_reno');
            $table->dropColumn('home_builder');
            $table->dropColumn('photographer');
            $table->dropColumn('home_inspector');
            $table->dropColumn('property_manager');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_role', function (Blueprint $table) {
            //
        });
    }
}
