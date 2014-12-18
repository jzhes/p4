<?php


use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecipients extends Migration {

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

}
