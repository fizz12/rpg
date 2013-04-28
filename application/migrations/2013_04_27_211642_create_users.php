<?php

class Create_Users {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		// Create users table
		Schema::create('users', function($table) {
			//autoincrement id column
			$table->increments('id');//->primary('id');
			#$table->primary('id');

			//varchars
			$table->string('username', 32);
			$table->string('email', 180);
			$table->string('password', 64);

			//ints
			$table->integer('usergroup')->default(0);
			$table->integer('level')->default(1); // Player level
			$table->integer('str')->default(0); //Strength
			$table->integer('agi')->default(0); //Agility
			$table->integer('def')->default(0); //Defense
			$table->integer('avatar')->default(0); // ID of user's avatar

			//bools
			$table->boolean('active')->default(false);
			$table->boolean('premium')->default(false);

			//created/update_at timestamps
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
		// drop users table
		Schema::drop('users');
	}

}