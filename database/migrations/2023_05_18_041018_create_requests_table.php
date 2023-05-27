<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRequestsTable extends Migration {

	public function up()
	{
		Schema::create('requests', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('patient_name', 70);
			$table->string('patient_phone', 25);
			//$table->bigInteger('city_id')->unsigned();
			$table->string('hospital_name');
			//$table->bigInteger('blood_type_id')->unsigned();
			$table->smallInteger('patient_age')->nullable();
			$table->smallInteger('bags_num')->nullable();
			$table->text('details')->nullable();
			$table->string('hospital_address');
			$table->decimal('latitude', 10,8)->nullable();
			$table->decimal('longitude', 10,8)->nullable();
		//	$table->bigInteger('client_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('requests');
	}
}