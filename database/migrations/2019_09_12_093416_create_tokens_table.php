<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTokensTable extends Migration {

	public function up()
	{
		Schema::create('tokens', function(Blueprint $table) {
			$table->increments('id');
			$table->string('token', 191);
			$table->enum('type', array('android', 'ios'));
			$table->integer('tokenable_id');
			$table->string('tokenable_type', 255);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('tokens');
	}
}