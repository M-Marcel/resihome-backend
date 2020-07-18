<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('tbl-admin', 'admin');
        Schema::rename('tbl_agent', 'agent');
        Schema::rename('tbl_building', 'building');
        Schema::rename('tbl_agent_location', 'agent_location');
        Schema::rename('tbl_location', 'location');
        Schema::rename('tbl_community', 'community');
        Schema::rename('tbl_community_image', 'community_image');
        Schema::rename('tbl_history', 'history');
        Schema::rename('tbl_home_builder', 'home_builder');
        Schema::rename('tbl_lawyer', 'lawyer');
        Schema::rename('tbl_mansion', 'mansion');
        Schema::rename('tbl_mansion_image', 'mansion_image');
        Schema::rename('tbl_mortgage-broker', 'mortgage_broker');
        Schema::rename('tbl_property', 'property');
        Schema::rename('tbl_property_image', 'property_image');
        Schema::rename('tbl_property_inspector', 'property_inspector');
        Schema::rename('tbl_property_school', 'school');
        Schema::rename('tbl_region', 'region');
        Schema::rename('tbl_review', 'review');
        Schema::rename('tbl_school', 'schools');
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
