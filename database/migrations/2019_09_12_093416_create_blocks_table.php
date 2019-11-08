<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBlocksTable extends Migration {

	public function up()
	{
		Schema::create('blocks', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 255);
			$table->integer('city_id');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('blocks');
	}
}