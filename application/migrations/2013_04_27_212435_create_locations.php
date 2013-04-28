<?php

class Create_Locations {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		// create locations table
		Schema::create('locations', function($table) {
			// id autoincrements
			$table->increments('id');

			//varchars
			$table->string('name', 120);

			//Ints
			$table->integer('minlevel')->default(0); // Min. level required to access loc

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
		// drop locations table
		Schema::drop('locations');
	}

}