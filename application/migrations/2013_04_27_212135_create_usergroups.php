<?php

class Create_Usergroups {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		// Create usergroups table
		Schema::create('usergroups', function($table) {
			// auto increment id
			$table->increments('id');

			//varchars
			$table->string('title', 80);

			$table->timestamps();
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		// Drop usergroups table
		Schema::drop('usergroups');
	}

}