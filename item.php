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
    	//Push the object of the whole new human tool into an own database-array
    	$ds->human_tools[] = $random_item;

    	//Fetches the values and name of the random item
    	$handlingI = $random_item->skills["handling"];
    	$speedI = $ds->items[$rand]->skills["speed"];
    	$persistanceI = $ds->items[$rand]->skills["persistance"];
    	$hands_onI = $ds->items[$rand]->skills["hands_on"];
    	$item_name = $ds->items[$rand]->description;

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
    }

} 

function minus_human_item() {
	$human = &$ds->human[0];
	
	//if the human has any tools
	if(count($human->tools) > 0) {
    	//$rand is a random number between 0 and number of items in human->tools array minus 1
    	$rand = rand(0,count($human->tools)-1);
    	//select a random item name from human tools array
    	$random_item = $human->tools[$rand];
    	//remove the name from human tools
    	array_splice($human->tools, $rand-1, 1);
    	//Find item where description = name of item just removed from human-tools
    	$db_item_right_name = array_search($random_item, $ds->items);

		
		//subtracting item's strength-values to subtract from human strengths
    	$handlingI = $db_item_right_name["handling"];
    	$speedI = $db_item_right_name["speed"];
    	$persistanceI = $db_item_right_name["persistance"];
    	$hands_onI = $db_item_right_name["hands_on"];
    
    	
    	//creating an array that subtracts the values of the item from human strengths
		$human_val_added = array(
			"name" => $human->name,
			"handling" => ($human->handling -= $handlingI), 
			"speed" => ($human->speed -= $speedI), 
			"persistance" => ($human->persistance -= $persistanceI),
			"hands_on" => ($human->hands_on -= $hands_onI),
			"success" => $human->success,
			"tools" => $human->tools,
		);
	}
	return $human_val_added;

}

//////////////////////////////////////////////////
// $human = &$ds->human[0];
// if(count($human->tools < 3)){
// 	$human->tools[] = "air_filter2";
// 	$human->tools[] = "energy_drink";
// 	$human->tools[] = "gps2";
// 	$human->tools[] = "gps2";
// }
// var_dump($human->tools);
	
    	//$rand is a random number between 0 and number of items in human->tools array minus 1
    	// $rand = rand(0,count($human->tools)-1);
    	// //select a random item name from human tools array
    	// $random_item = $human->tools[$rand];
    	// //remove the name from human tools
    	// var_dump($random_item);
    	/*array_splice($human->tools, $rand-1, 1);
    	//Find item where description = name of item just removed from human-tools
    	$db_item_right_name = array_search($random_item, $ds->items);

		
		//subtracting item's strength-values to subtract from human strengths
    	$handlingI = $db_item_right_name["handling"];
    	$speedI = $db_item_right_name["speed"];
    	$persistanceI = $db_item_right_name["persistance"];
    	$hands_onI = $db_item_right_name["hands_on"];
    
    	
    	//creating an array that subtracts the values of the item from human strengths
		$human_val_added = array(
			"name" => $human->name,
			"handling" => ($human->handling -= $handlingI), 
			"speed" => ($human->speed -= $speedI), 
			"persistance" => ($human->persistance -= $persistanceI),
			"hands_on" => ($human->hands_on -= $hands_onI),
			"success" => $human->success,
			"tools" => $human->tools,
		);
	*/



/*var_dump($ds->items[0]);
var_dump($ds->items[0]->description);*/

/*var_dump($ds->items[0]->skills["handling"]);*/

    	


/*var_dump($ds->items[$rand]);*/
/*var_dump($ds->items[0]->handling);*/



/*echo($ds->items[$rand]);

$ds->human->tools[] = $ds->items[$rand];
echo(count($ds->human->tools));*/

