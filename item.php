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

//if there aren't any items - create 10 of them
if (count($ds->items) === 0) {
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

//If ajax requests that human recieved a new item
if (isset($_REQUEST["plusItem"])) {
	$human = &$ds->human[0];
	
	//if the human has less than three tools
	if(count($human->tools) < 3) {
    	//$rand is a random number between 0 and number of items in $ds->items minus 1
    	$rand = rand(0,count($ds->items)-1);
    	//select a random item from database items
    	$random_item = $ds->items[$rand];
    	//remove it from database items - changed my mind - don't do it!
    	// array_splice($ds->items, $rand-1, 1);
    	//put the name of the random item in the human-tools array
    	$human->tools[] = $random_item->description;

    	//Fetches the values and name of the random item
    	$handlingI = $random_item->skills["handling"];
    	$speedI = $random_item->skills["speed"];
    	$persistanceI = $random_item->skills["persistance"];
    	$hands_onI = $random_item->skills["hands_on"];
    	$item_name = $random_item->description;

    	//creating an array that sums strengths and contains data to send back via ajax
		$human_val_added = array(
			"item_name" => $item_name,
			"name" => $human->name,
			"handling" => ($human->handling += $handlingI), 
			"speed" => ($human->speed += $speedI), 
			"persistance" => ($human->persistance += $persistanceI),
			"hands_on" => ($human->hands_on += $hands_onI),
			"success" => $human->success,
			"tools" => $human->tools,
			"type" => $human->class
		);
		echo(json_encode($human_val_added));
    }else {
    	echo(json_encode("No new items for you, you already have three"));
    }

} 
