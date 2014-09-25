<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TThemeLogs extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('t_theme_logs', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text('description');
			$table->tinyInteger('state')->default(1);
			$table->integer('theme_id')->unsigned()->index();
			$table->foreign('theme_id')->references('id')->on('t_themes')->onDelete('cascade');
			$table->timestamp('changed_date');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('t_theme_logs');
	}

}
