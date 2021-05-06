<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('seo_id');
            $table->integer('status_id');
            $table->integer('province_id');
            $table->integer('city_id');
            $table->string('name');
            $table->string('street');
            $table->string('barangay');
            $table->string('longitude');
            $table->string('latitude');
            $table->string('phone');
            $table->string('fax');
            $table->string('mobile');
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
        Schema::dropIfExists('branches');
    }
}
