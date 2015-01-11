<?php

//Nodebite black box
include_once("nodebite-swiss-army-oop.php");

$ds = new DBObjectSaver(array(
  "host" => "127.0.0.1",
  "dbname" => "wu14oop2",
  "username" => "root",
  "password" => "mysql",
  "prefix" => "CarFanatics"
));

//If there isn't any stored challenges - create 10
if (count($ds->challenges) === 0) {
	for ($i=0; $i < 5; $i++) {
		$challenge_json_data = file_get_contents("data/ch".$i.".json");
		$challenge_data = json_decode($challenge_json_data, true);
		$ds->challenges[] = New Challenge($challenge_data["name"]."1", $challenge_data);
		$ds->challenges[] = New Challenge($challenge_data["name"]."2", $challenge_data);
	}
}

//If game requests a challenge to be carried out, pick a random one
if (isset($_REQUEST["challenge"])) {

	$random_challenge_no = rand(0,count($ds->challenges)-1);

	$challange_data = array(
		"name" => $ds->challenges[$random_challenge_no]->name,
		"description" => $ds->challenges[$random_challenge_no]->description,
		);
	$ds->present_challenge[0] = $ds->challenges[$random_challenge_no];
	echo(json_encode($challange_data));
}

//If human requested to "throw the dice again" i.e. random out a new challenge
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
