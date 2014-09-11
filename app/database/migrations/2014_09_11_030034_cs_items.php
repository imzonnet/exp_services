<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CsItems extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cs_items', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title', 45);
			$table->text('requirement');
			$table->string('link',100)->nullable();
			$table->string('attachment', 100)->nullable();
			$table->text('info');
			$table->integer('budget_id')->unsigned()->index();
			$table->foreign('budget_id')->references('id')->on('cs_budgets')->onDelete('cascade');
			$table->integer('deliver_in')->default(0);
			$table->integer('service_type_id')->unsigned()->index();
			$table->foreign('service_type_id')->references('id')->on('cs_service_types')->onDelete('cascade');
			$table->integer('user_id')->unsigned()->index();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
		Schema::dropIfExists('cs_items');
	}

}
