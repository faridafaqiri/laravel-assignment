<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevelopWebLengthsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('develop_web_lengths', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('zone_id');
            $table->unsignedBigInteger('province_id');
            $table->unsignedBigInteger('provincial_zone_id');
            $table->foreign('provincial_zone_id')->references('id')
                ->on('provincial_zones')->onDelete('cascade');
            $table->integer('develop_distributive_web_length');
            $table->integer('develop_transitive_web_length');
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
        Schema::dropIfExists('develop_web_lengths');
    }
}
