<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeterReadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meter_readers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('zone_id');
            $table->unsignedBigInteger('province_id');
            $table->unsignedBigInteger('provincial_zone_id');
            $table->foreign('provincial_zone_id')->references('id')
                ->on('provincial_zones')->onDelete('cascade');
            $table->string('name');
            $table->integer('age');
            $table->text('address')->nullable();
            $table->string('degree');
            $table->boolean('area');// هموار- کوهی
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
        Schema::dropIfExists('meter_readers');
    }
}
