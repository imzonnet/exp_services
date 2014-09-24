<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TThemeImages extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('t_theme_images', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 45);
			$table->string('image', 100);
			$table->integer('ordering');
			$table->tinyInteger('state');
			$table->integer('theme_id')->unsigned()->index();
			$table->foreign('theme_id')->references('id')->on('t_themes')->onDelete('cascade');
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
		Schema::drop('t_theme_images');
	}

}
