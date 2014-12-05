<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGiftsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('gifts', function($table) {

			# AI, PK
			$table->increments('id');
 
			# created_at, updated_at columns
			$table->timestamps();
 
			# General data...
			$table->integer('user_id')->unsigned(); # FK Must be UNSIGNED
			$table->integer('recipient_id')->unsigned(); 
			$table->string('item');
			$table->integer('qty');
			$table->integer('price');
			$table->integer('totalcost');
			$table->boolean('purchased');
			$table->boolean('online');
			
			# Define foreign keys...
			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('recipient_id')->references('id')->on('recipients');

		});
		
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('gifts');
	}

}
