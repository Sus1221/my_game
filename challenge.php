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

if (count($ds->challenges) === 0) {

		$ds->challenges[] =new Challenge("Cruising1", 50, 0, 4, 4, 0);
		$ds->challenges[] =new Challenge("Cruising2", 50, 0, 4, 4, 0);
		$ds->challenges[] =new Challenge("Dragrace1", 50, 0, 4, 4, 1);
		$ds->challenges[] =new Challenge("Dragrace2", 50, 0, 4, 4, 1);
		$ds->challenges[] =new Challenge("ParallelParking1", 50, 0, 4, 4, 2);
		$ds->challenges[] =new Challenge("ParallelParking2", 50, 0, 4, 4, 2);
		$ds->challenges[] =new Challenge("CarPark1", 50, 0, 4, 4, 3);
		$ds->challenges[] =new Challenge("CarPark2", 50, 0, 4, 4, 3);
		$ds->challenges[] =new Challenge("Deliver1", 50, 0, 4, 4, 4);
		$ds->challenges[] =new Challenge("Deliver2", 50, 0, 4, 4, 4);
}


$random_challenge_no = array_rand($ds->challenges);

$story_data = file_get_contents("data/ch1.json");
$story_data2 = file_get_contents("data/ch2.json");

if (isset($_REQUEST["challenge"])) {
	echo($story_data);
}

if (isset($_REQUEST["challengeChange"])) {
	echo($story_data2);
	$ds->human[0]->get_change_challenge;
	$ds->human[0]->success -=5;
}
