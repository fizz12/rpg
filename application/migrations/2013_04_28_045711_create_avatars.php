<?php

class Create_Avatars { // Contains user avatars

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		// create avatars table
		Schema::create('avatars', function($table) {
			$table->increments('id');
			// id of user that 'owns' the avatar
			$table->integer('user_id');
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		// drop avatars table
		Schema::drop('avatars');
	}

}