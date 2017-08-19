<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('notification', function (Blueprint $table) {
			$table->increments('notification_id');
			$table->integer('comment_user_id');
			$table->integer('post_id');
			$table->string('comment_user_name');
			$table->integer('post_user_id');
			$table->unique(['comment_user_id','post_id']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('notification');
	}

}
