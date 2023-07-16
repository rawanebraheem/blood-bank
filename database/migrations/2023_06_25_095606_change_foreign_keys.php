<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('contacts', function(Blueprint $table) {
			
            $table->dropForeign(['client_id']);
            $table->foreign('client_id')->references('id')->on('clients')
            ->onUpdate('cascade')->onDelete('cascade');

		});

        Schema::table('article_client', function(Blueprint $table) {
			
			$table->foreignId('client_id')->constrained()->onDelete('cascade')->change();


		});
        Schema::table('requests', function(Blueprint $table) {
			
			$table->foreignId('client_id')->constrained()->onDelete('cascade')->change();

		});

        Schema::table('client_notification', function(Blueprint $table) {

			$table->foreignId('client_id')->constrained()->onDelete('cascade')->change();

		});

        Schema::table('blood_type_client', function(Blueprint $table) {
			
			$table->foreignId('client_id')->constrained()->onDelete('cascade')->change();

		});

        Schema::table('client_governorate', function(Blueprint $table) {
			
			$table->foreignId('client_id')->constrained()->onDelete('cascade')->change();

		});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contacts', function(Blueprint $table) {
			
            $table->dropForeign(['client_id']);
            $table->foreign('client_id')->references('id')->on('clients')
            ->onUpdate('restrict')->onDelete('restrict');

		});
    }
};
