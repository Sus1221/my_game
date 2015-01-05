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

	if (!count($ds->human)) {
		$ds->human[] = new $humanClass($humanName);
		$human = &$ds->human[0];
	} else {
		$human = &$ds->human[0];
	}
}

//Creating two bots if there aren't any
if (count($ds->bots) === 0) {

	$list = array("grandParent", "middleAger", "teenAger", "toddler");
	$randomClass = get_class($human);

	//If the randomed class is the same as the human's - randomize it again
	while ($randomClass == get_class($human)) {
		$randomClass = $list[array_rand($list, 1)];
	}

	$ds->bots[] = new $randomClass("Jack Racer".rand(1,1000));
	$ds->bots[] = new $randomClass("Betsy Powers".rand(1,1000));
}

//Prints out current caracters in the db
var_dump($ds->bots);
var_dump($human);