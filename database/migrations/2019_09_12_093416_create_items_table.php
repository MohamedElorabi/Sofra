<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateItemsTable extends Migration {

	public function up()
	{
		Schema::create('items', function(Blueprint $table) {
			$table->increments('id');
			$table->string('image', 255);
			$table->string('name', 255);
			$table->text('description');
			$table->decimal('price');
			$table->integer('duration');
			$table->integer('restaurant_id');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('items');
	}
}
