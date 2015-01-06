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

//Import all the challenge data from the json files
$ch0 = file_get_contents("./data/ch0.json");
$ch1 = file_get_contents("./data/ch1.json");
$ch2 = file_get_contents("./data/ch2.json");
$ch3 = file_get_contents("./data/ch3.json");
$ch4 = file_get_contents("./data/ch4.json");

$ds->items[] = new Item(
    "GPS",
  array(
    "handling" => 80,
    "speed" => 70,
    "persistance" => 0,
    "hands_on" => 50
  )
);

var_dump($ds->items);

/*$ds->challenges[] =new Challenge("Cruising1", 50, 0, 4, 4);
$ds->challenges[] =new Challenge("Cruising2", 50, 0, 4, 4);
$ds->challenges[] =new Challenge("Dragrace1", 50, 0, 4, 4);
$ds->challenges[] =new Challenge("Dragrace2", 50, 0, 4, 4);
$ds->challenges[] =new Challenge("ParallelParking1", 50, 0, 4, 4);
$ds->challenges[] =new Challenge("ParallelParking2", 50, 0, 4, 4);
$ds->challenges[] =new Challenge("CarPark1", 50, 0, 4, 4);
$ds->challenges[] =new Challenge("CarPark2", 50, 0, 4, 4);
$ds->challenges[] =new Challenge("Deliver1", 50, 0, 4, 4);
$ds->challenges[] =new Challenge("Deliver2", 50, 0, 4, 4);
*/

/*$challenge_array = new array($ch0, $ch1, $ch2, $ch3, $ch4, $ch2, $ch3, $ch3, $ch3, $ch4, $ch5, $ch $ch1, $ch1, $ch1);*/


if (isset($_REQUEST["challenge"])) {
	echo("Yohuu");
}

/*var_dump($ds->bots);
var_dump($ds->human);

$ds->items[] =new Item("Hammaren", 50, 0, 4, 4);

var_dump($ds->items);*/