<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TThemes extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('t_themes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 255);
			$table->text('description')->nullable();
			$table->string('thumbnail', 100);
			$table->text('features')->nullable();
			$table->string('powerful_id',100);
			$table->string('version',10)->default('1.0');
			$table->decimal('price',10,2)->default(0);
			$table->integer('category_id')->unsigned()->index();
			$table->foreign('category_id')->references('id')->on('t_categories')->onDelete('cascade');
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
		Schema::drop('t_themes');
	}

}
