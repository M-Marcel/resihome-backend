<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_property', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id')->nullable();
            $table->foreignId('agent_id');
            $table->string('address');
            $table->string('location');
            $table->text('description');
            $table->string('type');
            $table->string('sub_type');
            $table->string('home_type');
            $table->string('status')->nullable();
            $table->bigInteger('bedroom');
            $table->bigInteger('bathroom');
            $table->bigInteger('half_bedroom');
            $table->bigInteger('quarter_bedroom');
            $table->bigInteger('three_quarter_bedroom');
            $table->string('size');
            $table->string('main_prize');
            $table->string('size_prize')->nullable();
            $table->string('estimate_prize');
            $table->string('year_built');
            $table->string('heating');
            $table->string('cooling');
            $table->string('parking');
            $table->string('lot_size');
            $table->bigInteger('story');
            $table->string('internet_tv');
            $table->string('new_construction');
            $table->string('major_remodel_year');
            $table->string('tax_value');
            $table->string('annual_tax_amount');
            $table->string('neighborhood');
            $table->boolean('transport');
            $table->boolean('shopping');
            $table->boolean('school');
            $table->boolean('swimmimg_pool');
            $table->boolean('gym');
            $table->boolean('city');
            $table->boolean('water');
            $table->boolean('park');
            $table->string('cordinate');
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
        Schema::dropIfExists('tbl_property');
    }
}
