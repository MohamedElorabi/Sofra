<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateItemOrderTable extends Migration {

	public function up()
	{
		Schema::create('item_order', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('item_id');
			$table->integer('order_id');
			$table->string('qty', 255);
			$table->string('note', 255);
			$table->decimal('price');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('item_order');
	}
}