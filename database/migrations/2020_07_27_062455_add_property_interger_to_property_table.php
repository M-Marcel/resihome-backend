<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPropertyIntergerToPropertyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('property', function (Blueprint $table) {
            $table->dropColumn('size');
            $table->dropColumn('main_prize');
            $table->dropColumn('size_prize');
            $table->dropColumn('estimate_prize');
            $table->dropColumn('year_built');
            $table->dropColumn('parking');
            $table->dropColumn('lot_size');
            $table->dropColumn('tax_value');
            $table->dropColumn('annual_tax_amount');
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
