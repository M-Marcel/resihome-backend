<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyMansionTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mansion', function (Blueprint $table) {
            $table->boolean('status');
            $table->bigInteger('size');
            $table->bigInteger('main_prize');
            $table->bigInteger('size_prize')->nullable();
            $table->bigInteger('estimate_prize');
            $table->bigInteger('year_built');
            $table->bigInteger('parking');
            $table->bigInteger('lot_size');
            $table->bigInteger('tax_value');
            $table->bigInteger('annual_tax_amount');
            $table->boolean('concierge')->nullable();
            $table->string('video')->nullable();
            $table->text('video_description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
