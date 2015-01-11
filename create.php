<?php

include_once("nodebite-swiss-army-oop.php");

$ds = new DBObjectSaver(array(
    "host" => "127.0.0.1",
	"dbname" => "wu14oop2",
	"username" => "root",
	"password" => "mysql",
	"prefix" => "CarFanatics" // a prefix unique for your app/project
	));

//Creating human player based on the data he/she entered
if (isset($_REQUEST["player_name"]) && isset($_REQUEST["player_class"])) {

	$humanName = $_REQUEST["player_name"];
	$humanClass = $_REQUEST["player_class"];

	//Creating a list of human data to echo back to js-ajax
	if (count($ds->human[0]) === 0) {
		$ds->human[] = new $humanClass($humanName);
		$human = &$ds->human[0];
		$human_val_now = array(
			"name" => $human->name,
			"handling" => $human->handling, 
			"speed" => $human->speed, 
			"persistance" => $human->persistance,
			"hands_on" => $human->hands_on,
			"success" => $human->success,
			"tools" => $human->tools,
			"type" => $human->class,
		);
		echo(json_encode($human_val_now));
	} else {
		$human = &$ds->human[0];
	}
}

//If there anen't any bots, create two
if (count($ds->bots) === 0) {

	$list = array("Grandparent", "MiddleAger", "TeenAger", "Toddler");
	$human = &$ds->human[0];
	$randomClass = get_class($human);

	//If the randomed class is the same as the human's - randomize it again
	//so none of the three players get the same class
	while ($randomClass == get_class($human)) {
		$randomClass = $list[array_rand($list, 1)];
	}

	$ds->bots[] = new $randomClass("Jack Racer".rand(1,1000));
	while ($randomClass == get_class($human) || $randomClass == get_class($ds->bots[0])) {
		$randomClass = $list[array_rand($list, 1)];
	}
	$ds->bots[] = new $randomClass("Betsy Powers".rand(1,1000));
}

//If js-ajax requests enemy-info
if (isset($_REQUEST["enemies"])) {
	
		$bot1 = &$ds->bots[0];
		$bot2 = &$ds->bots[1];

		//Create a list of enemy-data
		$bots_val = array(
		"nameBot1" => $bot1->name,
		"handlingBot1" => $bot1->handling, 
		"speedBot1" => $bot1->speed, 
		"persistanceBot1" => $bot1->persistance,
		"hands_onBot1" => $bot1->hands_on,
		"successBot1" => $bot1->success,
		"typeBot2" => $bot1->class,
		"nameBot2" => $bot2->name,
		"handlingBot2" => $bot2->handling, 
		"speedBot2" => $bot2->speed, 
		"persistanceBot2" => $bot2->persistance,
		"hands_onBot2" => $bot2->hands_on,
		"successBot2" => $bot2->success,
		"typeBot2" => $bot2->class,
		);
		echo(json_encode($bots_val));
}

//If js-ajax requests current standings in the game
if (isset($_REQUEST["currentStandings"])) {

		$human = &$ds->human[0];
		$bot1 = &$ds->bots[0];
		$bot2 = &$ds->bots[1];
		
		//create a list consisting of human-data and botdata
		$current_standings_array = array(
			"name" => $human->name,
			"handling" => $human->handling, 
			"speed" => $human->speed, 
			"persistance" => $human->persistance,
			"hands_on" => $human->hands_on,
			"success" => $human->success,
			"tools" => $human->tools,
			"type" => $human->class,
			"nameBot1" => $bot1->name,
			"handlingBot1" => $bot1->handling, 
			"speedBot1" => $bot1->speed, 
			"persistanceBot1" => $bot1->persistance,
			"hands_onBot1" => $bot1->hands_on,
			"successBot1" => $bot1->success,
			"typeBot2" => $bot1->class,
			"nameBot2" => $bot2->name,
			"handlingBot2" => $bot2->handling, 
			"speedBot2" => $bot2->speed, 
			"persistanceBot2" => $bot2->persistance,
			"hands_onBot2" => $bot2->hands_on,
			"successBot2" => $bot2->success,
			"typeBot2" => $bot2->class,
		);
		//If someone won the game add new string to the array above
		if($human->success >= 100 || $bot1->success >= 100 || $bot2->success >= 100){
			$current_standings_array_with_w = array("The game is now over!" => "We have a winner!") + $current_standings_array;
			echo(json_encode($current_standings_array_with_w));
		//If human died
		}elseif($human->success <= 0){
			$human_dead_array = array("The game is now over!" => "Human player dead") + $current_standings_array;
			echo(json_encode($human_dead_array));
		//If one of the bots died
		}elseif($bot1->success <= 0 || $bot2->success <= 0){
			$human_dead_array = array("You're doing great!" => "One of your enemies died!") + $current_standings_array;
			echo(json_encode($human_dead_array));
		//If nobody won the game yet
		}else{
			echo(json_encode($current_standings_array));
		}
}