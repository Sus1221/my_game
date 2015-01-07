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
/*var_dump($ds->challenges[0]);
var_dump($ds->challenges[1]);
var_dump($ds->challenges[2]);
var_dump($ds->challenges[3]);
var_dump($ds->challenges[4]);
var_dump($ds->challenges[5]);
var_dump($ds->challenges[6]);
var_dump($ds->challenges[7]);
var_dump($ds->challenges[8]);
*/
/*var_dump($ds->challenges[9]);
$challenge_id = $ds->challenges[0];
var_dump($challenge_id);
$random_challenge_no = rand(0,count($ds->challenges)-1);*/
//Working!
/*var_dump($ds->challenges[$random_challenge_no]);*/
/*echo($random_challenge_no);
var_dump($ds->challenges[$random_challenge_no]);*/

$story_data = file_get_contents("data/ch1.json");
$story_data2 = file_get_contents("data/ch2.json");

if (isset($_REQUEST["challenge"])) {
	echo($story_data);
	/*echo(json_encode($ds->challenges[0]));*/
	/*echo(json_encode($ds->challenges[$random_challenge_no]));*/
}

if (isset($_REQUEST["challengeChange"])) {
	echo($story_data2);
	/*echo(json_encode($ds->challenges[$random_challenge_no]));*/
	$ds->human[0]->success -=5;
}

/*function challenge($person){

			$json_story_data = file_get_contents("data/ch1.json");
			$story_data = (json_decode($json_story_data, true));
			//the utimate skill template for this challenge
			$story_skills = $story_data["skills"];
			var_dump($story_skills);

			//Get the hightest skill
			$value = max($story_skills);
			//Get the corresponding key:
			$key = array_search($value, $story_skills);
			echo($value.$key);

			//An int between 1 and 1,5 to use further down
			$random_factor = mt_rand(10,15)/10;
			echo($random_factor);
			
			//fetch the person playing's (human or team) value of $key above
			$player_skills = &$ds->human[0][$key];
			var_dump($player_skills);

			//fetch the bot value of $key above
			$bot1 = &$ds->bots[0];
			$bot2 = &$ds->bots[1];
			var_dump($bot1);

			//if human requested to play alone
			if (count($ds->team) === 0) {
				
				//if human wins over both bots
				if ($ds->human[0][$value] > $ds->bots[0][value] && $ds->human[0][$value] > $ds->bots[0][value]) {
				echo(json_encode("Human"));
				$ds->human[0]->success +=15;
				elseif (($ds->human[0][$value] > $ds->bots[0][value] && $ds->human[0][$value] < $ds->bots[1][value]) || 
					($ds->human[0][$value] < $ds->bots[0][value] && $ds->human[0][$value] < $ds->bots[1][value])) {
					if(count($ds->$human[0]->tools) <= 3) {
						shuffle($ds->$human[0]->tools);
						array_pop($ds->$human[0]->tools);
					}
				}
				}else { 
					echo(json_encode("Bot"));
					$ds->human[0]->success -=5;
				}

			//else = if human requested to play in a team
			}else {
				if ($ds->human[0][$value] > $ds->bots[0][value]) {
					echo(json_encode("Human"));
				$ds->human[0]->success+=9;
				}else {
					echo(json_encode("Bot"));
					$ds->human[0]->success -=5;
				}
			}

		 unset($ds->team);
		 if($ds->human[0]->success > 100 || $ds->bots[0]->success > 100 || $ds->bots[1]->success > 100) {
		 	winnerNow();
		 }
		 if($ds->human[0]->success > 0 || $ds->bots[0]->success > 0 || $ds->bots[1]->success > 0) {
		 	loserNow();
		 }
}*/
/*challenge($person);*/

/*function winnerNow {
	
}

function loserNow {

}*/