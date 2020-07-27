<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProperty2IntergerToPropertyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('property', function (Blueprint $table) {
            $table->bigInteger('size');
            $table->bigInteger('main_prize');
            $table->bigInteger('size_prize');
            $table->bigInteger('estimate_prize');
            $table->bigInteger('year_built');
            $table->bigInteger('parking');
            $table->bigInteger('lot_size');
            $table->bigInteger('tax_value');
            $table->bigInteger('annual_tax_amount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('property', function (Blueprint $table) {
            //
        });
    }
}
