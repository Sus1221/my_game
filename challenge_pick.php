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
		$challenge_data = json_decode($challenge_json_data, true);
		$ds->challenges[] = New Challenge($challenge_data["name"]."1", $challenge_data);
		$ds->challenges[] = New Challenge($challenge_data["name"]."2", $challenge_data);
	}
}




if (isset($_REQUEST["challenge"])) {
	/*echo($story_data);*/
	/*echo(json_encode($ds->challenges[0]));*/
	$random_challenge_no = rand(0,count($ds->challenges)-1);

	$challange_data = array(
		"name" => $ds->challenges[$random_challenge_no]->name,
		"description" => $ds->challenges[$random_challenge_no]->description,
		);
	$ds->present_challenge[0] = $ds->challenges[$random_challenge_no];
	echo(json_encode($challange_data));
}

if (isset($_REQUEST["challengeChange"])) {
	//human looses 5 success-points
	$ds->human[0]->success -=5;
	
	$random_challenge_no = rand(0,count($ds->challenges)-1);
	$challange_data = array(
		"name" => $ds->challenges[$random_challenge_no]->name,
		"description" => $ds->challenges[$random_challenge_no]->description,
		);
	$ds->present_challenge[0] = $ds->challenges[$random_challenge_no];
	echo(json_encode($challange_data));
	
}
// $random_challenge_no = rand(0,count($ds->challenges)-1);

// 	$challange_data = array(
// 		"name" => $ds->challenges[$random_challenge_no]->name,
// 		"description" => $ds->challenges[$random_challenge_no]->description,
// 		);
// 	$ds->present_challenge[] = $ds->challenges[$random_challenge_no];