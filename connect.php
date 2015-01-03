<?php

include_once("nodebite-swiss-army-oop.php");

$ds = new DBObjectSaver(array(
    "host" => "127.0.0.1",
	"dbname" => "wu14oop2",
	"username" => "root",
	"password" => "mysql",
	"prefix" => "CarFanatics" // a prefix unique for your app/project
	));

if (count($ds->bots) === 0) {

	$list = array("grandParent", "middleAger", "teenAger", "toddler");
	$randomClass = $list[array_rand($list, 1)];

	$ds->bots[] = new $randomClass("Jack Racer".rand(1,1000));
	$ds->bots[] = new $randomClass("Betsy Powers".rand(1,1000));
}

//Prints out current carracters in the db
var_dump($ds->bots);


