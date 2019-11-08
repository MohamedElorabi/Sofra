<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRestaurantsTable extends Migration {

	public function up()
	{
		Schema::create('restaurants', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 255);
			$table->string('email', 255);
			$table->integer('phone');
			$table->integer('block_id');
			$table->string('password', 255);
			$table->enum('status', array('open', 'closed'));
			$table->decimal('min');
			$table->decimal('fees');
			$table->string('restaurant_phone');
			$table->integer('category_id')->unsigned();
			$table->string('image', 255);
			$table->integer('whatsup');
			$table->string('api_token', 60)->nullable();
			$table->integer('pin_code')->nullable();
			$table->boolean('is_active')->default(0);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('restaurants');
	}
}
