<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaymentsTable extends Migration {

	public function up()
	{
		Schema::create('payments', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('restaurant_id');
			$table->string('note', 255);
			$table->decimal('amount');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('payments');
	}
}