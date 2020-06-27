<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_review', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('agent_id');
            $table->text('description');
            $table->integer('responaiveness');
            $table->integer('price');
            $table->integer('work_quality');
            $table->integer('puncuality');
            $table->integer('services_provided');
            $table->integer('year_of_service');
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
        Schema::dropIfExists('tbl_review');
    }
}
