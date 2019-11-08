<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration {

	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 255);
			$table->string('email', 255);
			$table->integer('phone');
			$table->string('password', 255);
			$table->string('image');
      $table->boolean('is_active')->default(1);
			$table->integer('block_id');
			$table->string('api_token', 60)->nullable();
			$table->integer('pin_code')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('clients');
	}
}
