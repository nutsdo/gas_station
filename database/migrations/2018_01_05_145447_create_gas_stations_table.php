<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGasStationsTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('gas_stations', function(Blueprint $table) {
            $table->increments('id');
			$table->string('name')->comment('油站名称');
			$table->string('cover')->comment('油站图片');
			$table->string('lng',20)->default(0)->comment('经度');
			$table->string('lat',20)->default(0)->comment('纬度');
			$table->boolean('type')->comment('油站类型:1加油站,2加气站');
			$table->string('phone',20)->index()->comment('联系电话');
			$table->string('province',30)->comment('省份');
			$table->string('city',30)->comment('城市');
			$table->string('district',30)->comment('地区');
			$table->string('address')->comment('详细地址');
			$table->boolean('is_banned')->default(0)->comment('是否禁用:0否,1禁用');
            $table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('gas_stations');
	}

}
