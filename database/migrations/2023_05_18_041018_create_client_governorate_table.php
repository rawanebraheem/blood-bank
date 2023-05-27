<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientGovernorateTable extends Migration {

	public function up()
	{
		Schema::create('client_governorate', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->timestamps();
			//$table->bigInteger('client_id')->unsigned();
			//$table->bigInteger('governorate_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('client_governorate');
	}
}