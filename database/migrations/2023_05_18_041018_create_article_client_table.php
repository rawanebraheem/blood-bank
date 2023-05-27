<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArticleClientTable extends Migration {

	public function up()
	{
		Schema::create('article_client', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->timestamps();
			//$table->bigInteger('client_id')->unsigned();
			//$table->bigInteger('article_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('article_client');
	}
}