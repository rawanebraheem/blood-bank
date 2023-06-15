<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration {

	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->timestamps();
			$table->string('name', 70);
			$table->string('phone', 25)->unique();
			$table->string('email', 60)->unique();
			$table->string('password');
			$table->date('d_o_b');
			//$table->bigInteger('blood_type_id')->unsigned();
			$table->date('last_donation_date');
			//$table->bigInteger('city_id')->unsigned();
			$table->integer('pin_code')->nullable();
			$table->boolean('is_active')->default(1);
                        
        
		});
	} 

	public function down()
	{
		Schema::drop('clients');
	}
}