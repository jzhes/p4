<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateGifts extends Migration {

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
			$table->integer('qty')->unsigned();
			$table->double('price')->unsigned();
			$table->double('total')->unsigned();
			$table->boolean('purchased');
			
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
