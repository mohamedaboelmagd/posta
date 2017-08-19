<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('comments', function (Blueprint $table) {
			$table->increments('comment_id');
			$table->string('comment_name');
			$table->integer('post_id')->unsigned()->index();
			$table->timestamps();
		});
		Schema::table('comments', function (Blueprint $table) {
			$table->foreign('post_id')->references('post_id')->on('posts')->onDelete('cascade')->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('comments');
	}

}
