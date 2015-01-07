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
	for ($i=0; $i < 5; $i++) {
		$challenge_json_data = file_get_contents("data/ch".$i.".json");
		$challenge_data = json_decode($challenge_json_data);

		$ds->challenges[] = New Challenge($challenge_data["name"]."1", $challenge_data);
		$ds->challenges[] = New Challenge($challenge_data["name"]."2", $challenge_data);
	}
}
		/*$ds->challenges[] =new Challenge("Cruising1", 50, 0, 4, 4, 0);
		$ds->challenges[] =new Challenge("Cruising2", 50, 0, 4, 4, 0);
		$ds->challenges[] =new Challenge("Dragrace1", 50, 0, 4, 4, 1);
		$ds->challenges[] =new Challenge("Dragrace2", 50, 0, 4, 4, 1);
		$ds->challenges[] =new Challenge("ParallelParking1", 50, 0, 4, 4, 2);
		$ds->challenges[] =new Challenge("ParallelParking2", 50, 0, 4, 4, 2);
		$ds->challenges[] =new Challenge("CarPark1", 50, 0, 4, 4, 3);
		$ds->challenges[] =new Challenge("CarPark2", 50, 0, 4, 4, 3);
		$ds->challenges[] =new Challenge("Deliver1", 50, 0, 4, 4, 4);
		$ds->challenges[] =new Challenge("Deliver2", 50, 0, 4, 4, 4);*/


$random_challenge_no = count($ds->challenges)-1;
/*echo($random_challenge_no);
var_dump($ds->challenges[$random_challenge_no]);*/
/*$story_data = file_get_contents("data/ch1.json");
$story_data2 = file_get_contents("data/ch2.json");*/

if (isset($_REQUEST["challenge"])) {
	echo($ds->challanges[random_challenge_no]);
}

if (isset($_REQUEST["challengeChange"])) {
	echo($ds->challanges[random_challenge_no]);
	$ds->human[0]->success -=5;
}
