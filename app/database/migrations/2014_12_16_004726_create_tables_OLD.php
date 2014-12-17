<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	
		Schema::create('users', function($table) {

		    $table->increments('id');
		    $table->string('email', 100)->unique();
		    $table->string('password');
			$table->string('name');
		    $table->timestamps();

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}


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
			$table->integer('user_id')->unsigned(); # FK Must be UNSIGNED
			$table->string('name', 100);
			$table->string('address_line_1');
			$table->string('address_line_2');
			$table->string('city', 100);
			$table->string('state', 2);
			$table->string('zip', 5);
			$table->string('ext_zip', 4 );
			
			# Define foreign keys...
			$table->foreign('user_id')->references('id')->on('users');

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
