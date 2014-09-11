<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CsMessages extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cs_messages', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('item_id')->unsigned()->index();
			$table->foreign('item_id')->references('id')->on('cs_items')->onDelete('cascade');
			$table->integer('user_id')->unsigned()->index();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->integer('status_id')->unsigned()->index();
			$table->foreign('status_id')->references('id')->on('cs_status')->onDelete('cascade');
			$table->text('comments');
			$table->string('attachment');
			$table->timestamp('submit_date');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('cs_messages');
	}

}
