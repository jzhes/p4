<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecipientsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
			Schema::create('recipients', function($table) {
			
			# AI, PK
			$table->increments('id');
 
			# created_at, updated_at columns
			$table->timestamps();
 
			# General data...
			$table->string('first_name');
			$table->string('last_name');
			$table->integer('categories_id')->unsigned(); # FK Must be UNSIGNED
			$table->integer('statuses_id')->unsigned(); 
			
			# Define foreign keys...
			$table->foreign('categories_id')->references('id')->on('categories');
			$table->foreign('statuses_id')->references('id')->on('statuses');

		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
			Schema::drop('recipients');
	}

}