<?php

//Nodebite black box
include_once("nodebite-swiss-army-oop.php");

//create a new instance of the DBObjectSaver class 
//and store it in the $db variable
$ds = new DBObjectSaver(array(
  "host" => "127.0.0.1",
  "dbname" => "wu14oop2",
  "username" => "root",
  "password" => "mysql",
  "prefix" => "CarFanatics"
));

	public function makeItems() {
		$ds->items[] = new Item(
		    "gps",
		  array(
		    "handling" => 30,
		    "speed" => 10,
		    "persistance" => 5,
		    "hands_on" => 0
		  )
		);

		$ds->items[] = new Item(
		    "super_fuel",
		  array(
		    "handling" => 0,
		    "speed" => 30,
		    "persistance" => 0,
		    "hands_on" => 0
		  )
		);

		$ds->items[] = new Item(
		    "air_filter",
		  array(
		    "handling" => 0,
		    "speed" => 20,
		    "persistance" => 0,
		    "hands_on" => 10
		  )
		);
		$ds->items[] = new Item(
		    "wax",
		  array(
		    "handling" => 0,
		    "speed" => 5,
		    "persistance" => 0,
		    "hands_on" => 0
		  )
		);
		$ds->items[] = new Item(
		    "energy_drink",
		  array(
		    "handling" => 0,
		    "speed" => 0,
		    "persistance" => 20,
		    "hands_on" => 0
		  )
		);

		$ds->items[] = new Item(
		    "gps2",
		  array(
		    "handling" => 20,
		    "speed" => 10,
		    "persistance" => 5,
		    "hands_on" => 0
		  )
		);

		$ds->items[] = new Item(
		    "super_fuel2",
		  array(
		    "handling" => 0,
		    "speed" => 25,
		    "persistance" => 0,
		    "hands_on" => 0
		  )
		);

		$ds->items[] = new Item(
		    "air_filter2",
		  array(
		    "handling" => 0,
		    "speed" => 25,
		    "persistance" => 0,
		    "hands_on" => 15
		  )
		);
		$ds->items[] = new Item(
		    "wax2",
		  array(
		    "handling" => 0,
		    "speed" => 20,
		    "persistance" => 0,
		    "hands_on" => 10
		  )
		);
		$ds->items[] = new Item(
		    "energy_drink2",
		  array(
		    "handling" => 0,
		    "speed" => 0,
		    "persistance" => 25,
		    "hands_on" => 0
		  )
		);
	}
