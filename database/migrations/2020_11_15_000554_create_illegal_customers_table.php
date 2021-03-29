<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIllegalCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('illegal_customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('zone_id');
            $table->unsignedBigInteger('province_id');
            $table->unsignedBigInteger('provincial_zone_id');
            $table->foreign('provincial_zone_id')->references('id')
                ->on('provincial_zones')->onDelete('cascade');
            $table->unsignedBigInteger('total');
            $table->boolean('action')->default(0);
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
        Schema::dropIfExists('illegal_customers');
    }
}
