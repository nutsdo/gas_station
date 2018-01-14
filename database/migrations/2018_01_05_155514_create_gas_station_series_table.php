<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGasStationSeriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gas_station_series', function (Blueprint $table) {
            //
            $table->integer('gas_station_id')->comment('油站id');
            $table->integer('series_id')->comment('油号id');
            $table->decimal('price')->comment('油价');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('gas_station_series');
    }
}
