<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_role', function (Blueprint $table) {
            $table->id();
            $table->integer('buyer');
            $table->integer('owner');
            $table->integer('agent');
            $table->integer('morgage_lender');
            $table->integer('home_reno');
            $table->integer('home_builder');
            $table->integer('photographer');
            $table->integer('home_inspector');
            $table->integer('property_manager');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_role');
    }
}
