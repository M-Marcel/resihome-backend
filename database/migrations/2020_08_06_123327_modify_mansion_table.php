<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyMansionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mansion', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('size');
            $table->dropColumn('main_prize');
            $table->dropColumn('size_prize');
            $table->dropColumn('estimate_prize');
            $table->dropColumn('year_built');
            $table->dropColumn('parking');
            $table->dropColumn('lot_size');
            $table->dropColumn('tax_value');
            $table->dropColumn('annual_tax_amount');
            $table->dropColumn('cordinate');
            // $table->string('owner_id')->nullable();
            $table->string('image')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('imageUrl')->nullable();
            $table->dropColumn('video');
            $table->dropColumn('video_description');
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
