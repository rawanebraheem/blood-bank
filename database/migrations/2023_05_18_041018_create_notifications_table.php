<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotificationsTable extends Migration {

	public function up()
	{
		Schema::create('notifications', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->timestamps();
			$table->string('title');
			$table->string('content');
			//$table->bigInteger('request_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('notifications');
	}
}