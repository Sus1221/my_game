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

function challenge($person){

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
}
/*challenge($person);*/

/*function winnerNow {
	
}

function loserNow {

}*/