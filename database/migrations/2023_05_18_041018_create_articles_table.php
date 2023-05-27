<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArticlesTable extends Migration {

	public function up()
	{
		Schema::create('articles', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('title');
			$table->string('image')->nullable();
			$table->text('content');
			//$table->bigInteger('category_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('articles');
	}
}