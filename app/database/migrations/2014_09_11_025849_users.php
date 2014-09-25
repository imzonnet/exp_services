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
		Schema::table('users', function(Blueprint $table){
			$table->string('address', 45);
			$table->string('phone', 20)->nullable();
			$table->string('skype', 45)->nullable();
			$table->string('avatar', 45)->default('public/images/avatar.png');
			$table->string('sex', 10)->nullable();
			$table->text('profile')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//Schema::dropIfExists('users');
	}

}
