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




$ch1 = file_get_contents("./data/ch0.json");
$ch2 = file_get_contents("./data/ch1.json");

$challenges = new Array();

$challenge = json_decode($ch1);
var_dump("ch1".$ch1);

if (isset($_REQUEST["challenge"]) {
	echo("Yohuu");
}





$challenge = json_decode($challenge_data, true);