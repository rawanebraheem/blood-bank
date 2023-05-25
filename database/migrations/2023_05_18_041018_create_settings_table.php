<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration {

	public function up()
	{
		Schema::create('settings', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('notification_settings_text');
			$table->text('about_app');
			$table->string('phone')->nullable();
			$table->string('email')->nullable();
			$table->string('fb_link')->nullable();
			$table->string('tw_link')->nullable();
			$table->string('insta_link')->nullable();
			$table->string('youtube_link')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('settings');
	}
}