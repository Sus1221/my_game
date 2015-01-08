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
} else {
	(json_encode(false));
}

//Creating two bots if there aren't any
/*if (count($ds->bots) === 0) {

	$list = array("grandParent", "middleAger", "teenAger", "toddler");
	$human = &$ds->human[0];
	$randomClass = $human->class;

	//If the randomed class is the same as the human's - randomize it again
	while ($randomClass == get_class($human)) {
		$randomClass = $list[array_rand($list, 1)];
	}

	$ds->bots[] = new $randomClass("Jack Racer".rand(1,1000));
	$ds->bots[] = new $randomClass("Betsy Powers".rand(1,1000));
}*/

if (count($ds->bots) === 0) {

	$list = array("Grandparent", "MiddleAger", "TeenAger", "Toddler");
	$human = &$ds->human[0];
	$randomClass = get_class($human);

	//If the randomed class is the same as the human's - randomize it again
	while ($randomClass == get_class($human)) {
		$randomClass = $list[array_rand($list, 1)];
	}

	$ds->bots[] = new $randomClass("Jack Racer".rand(1,1000));
	while ($randomClass == get_class($human) || $randomClass == get_class($ds->bots[0])) {
		$randomClass = $list[array_rand($list, 1)];
	}
	$ds->bots[] = new $randomClass("Betsy Powers".rand(1,1000));
} 

/*echo(get_class($ds->human[0]).get_class($ds->bots[0]).get_class($ds->bots[1]));*/

//Echos humans value right now
//Working!
/*echo(json_encode($human_val_now));
echo(json_encode($ds->bots[0]->name));
*/

//trying to get win_tool to work
/*$sus = new Character("Sus");
echo("Här:");
var_dump($sus);
echo("nu");
$vep = "Kanin";
$sus->tools[] = $vep;
echo($sus->tools);*/

if (isset($_REQUEST["enemies"])) {
	
		$bot1 = &$ds->bots[0];
		$bot2 = &$ds->bots[1];

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
} else {
	(json_encode(false));
}

/*var_dump($ds->human);
var_dump($ds->bots);*/

/*$bot1 = $ds->bots[0];
	$bot2 = $ds->bots[1];
$bots_val = array(
		"nameBot1" => $bot1->name,
		"handlingBot1" => $bot1->handling, 
		"speedBot1" => $bot1->speed, 
		"persistanceBot1" => $bot1->persistance,
		"hands_onBot1" => $bot1->hands_on,
		"successBot1" => $bot1->success,
		"toolsBot1" => $bot1->tools,
		"typeBot2" => $bot1->class,
		"nameBot2" => $bot2->name,
		"handlingBot2" => $bot2->handling, 
		"speedBot2" => $bot2->speed, 
		"persistanceBot2" => $bot2->persistance,
		"hands_onBot2" => $bot2->hands_on,
		"successBot2" => $bot2->success,
		"toolsBot2" => $bot2->tools,
		"typeBot2" => $bot2->class,
		);
var_dump($bots_val);
	*/ 

if (isset($_REQUEST["challangeAlone"])) {
	valueOfIdeal($ds->person[0]);
} else {
	(json_encode(false));
}

//
if (isset($_REQUEST["challengeTogether"])) {
	$rand = mt_rand(0,1);
	//new team-object consisting of the human and a random pick of one of the two bots
	$ds->team[] = new Team($ds->human[0],$ds->bots[$rand]);
	var_dump($ds->bots[0]);
} else {
	(json_encode(false));
}
