<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Users extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table){
			$table->increments('id');
			$table->string('name', 45);
			$table->string('email', 45)->unique();
			$table->string('password', 32);
			$table->string('address', 45);
			$table->string('phone', 20);
			$table->string('skype', 45);
			$table->string('avatar', 45);
			$table->string('sex', 10);
			$table->text('profile');
			$table->tinyInteger('user_type');
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
		Schema::dropIfExists('users');
	}

}
