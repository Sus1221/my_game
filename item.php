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

/*echo(count($ds->human->tools));*/

//If ajax calls for a new human-item
if (isset($_REQUEST["plusItem"])) {
	
	//if the human has less than three tools
	if(count($ds->human->tools) < 3) {
    	//$rand is a random number between 0 and number of items in $ds->items)
    	$rand = rand(0,count($ds->items));
    	//Inserts a random tool from items to human-tool-list
    	

    	$handlingI = ($ds->items[$rand]->skills["handling"]);
    	$speedI = ($ds->items[$rand]->skills["speed"]);
    	$persistanceI = ($ds->items[$rand]->skills["persistance"]);
    	$hands_onI = ($ds->items[$rand]->skills["hands_on"]);
    	$item_name = ($ds->items[$rand][0]);

    	/*echo($handlingI.$speedI.$persistanceI.$hands_onI);*/
    	

    	$human = &$ds->human[0];
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
    }

}

var_dump($ds->items[0][0]);

/*var_dump($ds->items[0]->skills["handling"]);*/

    	


/*var_dump($ds->items[$rand]);*/
/*var_dump($ds->items[0]->handling);*/



/*echo($ds->items[$rand]);

$ds->human->tools[] = $ds->items[$rand];
echo(count($ds->human->tools));*/

