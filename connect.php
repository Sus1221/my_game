<?php

include_once("nodebite-swiss-army-oop.php");

$ds = new DBObjectSaver(array(
    "host" => "127.0.0.1",
	"dbname" => "wu14oop2",
	"username" => "root",
	"password" => "mysql",
	"prefix" => "CarFanatics" // a prefix unique for your app/project
	));

if (count($ds->characters) === 0) {
  // no monsters so let us create some
  $ds->characters[] = new Character("Gremlin");
  $ds->characters[] = new Character("Joker".rand(77,99));
}

//Prints out current carracters in the db
var_dump($ds->characters);