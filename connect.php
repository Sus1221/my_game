<?php

include_once("nodebite-swiss-army-oop.php");

$ds = new DBObjectSaver(array(
    "host" => "127.0.0.1",
	"dbname" => "wu14oop2",
	"username" => "root",
	"password" => "mysql",
	"prefix" => "CarFanatics" // a prefix unique for your app/project
	));

//Creating human player off of the data he/she entered
if (isset($_REQUEST["player_name"]) && isset($_REQUEST["player_class"])) {

	$humanName = $_REQUEST["player_name"];
	$humanClass = $_REQUEST["player_class"]

	&$ds->human = new $humanClass($humanName);
	var_dump($ds->human);
	}

//Creating two bots if there aren't any
if (count($ds->bots) === 0) {

	$list = array("grandParent", "middleAger", "teenAger", "toddler");
	$randomClass = $list[array_rand($list, 1)];

	//If the randomed class is the same as the human's - randomize it again
	if ($randomClass == $ds->humanClass) {
		$randomClass = $list[array_rand($list, 1)];
	}

	$ds->bots[] = new $randomClass("Jack Racer".rand(1,1000));
	$ds->bots[] = new $randomClass("Betsy Powers".rand(1,1000));
}

//Prints out current carracters in the db
var_dump($ds->bots);

