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


if (isset($_REQUEST["reset"])) {
  unset($ds->bots);
  unset($ds->human);
  unset($ds->items);
  unset($ds->challenges);
  unset($ds->team);
  unset($ds->human_tools);
  unset($ds->present_challenge);
  echo(json_encode(true));
}

var_dump($ds->present_challenge[0]);