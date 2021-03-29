<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoveredPopulationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('covered_populations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('zone_id');
            $table->foreign('zone_id')->references('id')
                ->on('zones')->onDelete('cascade');
            $table->integer('population');
            $table->integer('year');
            $table->integer('m_residential');
            $table->integer('m_business');
            $table->integer('m_holyPlaces');
            $table->integer('m_public');
            $table->integer('m_governmental');
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
        Schema::dropIfExists('covered_populations');
    }
}
