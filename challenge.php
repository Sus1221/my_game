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

 if (isset($_REQUEST["DoChallengeAlone"])) {
 	//run function howGoodAMatch with human,bot1 and bot 2 on present challenge
 	$raw_human_score = $ds->present_challenge[0]->howGoodAMatch($ds->human[0]);
 	$human_result = round($raw_human_score,4);

 	//if bot1 is alive
 	if($ds->bots[0]->success > 0) {
	 	$raw_bot1_score = $ds->present_challenge[0]->howGoodAMatch($ds->bots[0]);
	 	$bot1_result = round($raw_bot1_score,4);
	//if bot1 is dead its challenge-result is always 0
	}else {
		$bot1_result = 0;
	}
	//if bot2 is alive
 	if($ds->bots[1]->success > 0) {
 		$raw_bot2_score = $ds->present_challenge[0]->howGoodAMatch($ds->bots[1]);
 		$bot2_result = round($raw_bot2_score,4);
 	//if bot 2 is the dead its challenge-result is always 0
 	}else {
 		$bot2_result = 0;
 	}
 	//if human wins
 	if ($human_result > $bot1_result && $human_result > $bot2_result) {
 		$ds->human[0]->success +=15;
 		//and if bot1 comes in second
 		if($bot1_result > $bot2_result) {
 			$ds->bots[1]->success -=5;
 		//or if bot2 comes in second
 		}else{
 			$ds->bots[0]->success -=5;
 		}
 		echo(json_encode("You won"));
 	//if human comes in second
 	}else if($human_result > $bot1_result || $human_result > $bot2_result) {
 		minus_human_item();
 		//and if bot 1 wins
 		if($bot1_result > $bot2_result) {
 			$ds->bots[0]->success +=15;
 			$ds->bots[1]->success -=5;
 		//or if bot 2 wins
 		}else {
 			$ds->bots[0]->success -=5;
 			$ds->bots[1]->success +=15;
 		}
 		echo(json_encode("You came in second and lost an item in "));
 	//if human comes in last
 	}else {
 		minus_human_item();
 		$ds->human[0]->success -=5;
 		//and if bot 1 wins
 		if($bot1_result > $bot2_result) {
 			$ds->bots[0]->success +=15;
 		//or if bot 2 wins
 		}else {
 			$ds->bots[1]->success +=15;
 		}
 		echo(json_encode("You lost an item and lost "));
 	}
}
//var_dump($ds->present_challenge[0]);
//->howGoodAMatch($ds->bots[1]);

if (isset($_REQUEST["DoChallengeTogether"])) {
 	//Cost human -5 successpoints
 	$ds->human[0]->success -=5;
 	//create a team consisting of the human and a bot
 	$ds->team[] = New Team($ds->human[0], $ds->bots[0]);
 	
 	//Make the team and the lone bot run the challenge
 	$raw_lone_bot_score = $ds->present_challenge[0]->howGoodAMatch($ds->bots[1]);
 	//Round off to 4 decimals
 	$lone_bot_result = round($raw_lone_bot_score,4);
 	
 	$raw_team_score = $ds->present_challenge[0]->howGoodAMatch($ds->team[0]);
 	$team_result = round($raw_team_score,4);
 	
 	//if team wins
 	if($team_result > $lone_bot_result) {
 		$ds->human[0]->success +=9;
 		$ds->bots[0]->success +=9;
 		$ds->bots[1]->success -=5;
 		echo(json_encode("The team won!"));
 	//if team looses
 	}else {
 		$ds->human[0]->success -=5;
 		$ds->bots[0]->success -=5;
 		$ds->bots[1]->success +=15;
 		echo(json_encode("The team lost.."));
 	}

 	//Lastly - Delete the temporary team from the db
 	unset($ds->team);
}

function minus_human_item() {
	$human = &$ds->human[0];
	
	//if the human has any tools
	if(count($human->tools) > 0) {
    	//$rand is a random number between 0 and number of items in human->tools array minus 1
    	$rand = rand(0,count($human->tools)-1);
    	//select a random item name from human tools array
    	$random_item = $human->tools[$rand];
    	//remove the name from human tools
    	array_splice($human->tools, $rand-1, 1);
    	
    	//Find item where description = name of item just removed from human-tools
    	$db_item_right_name = array_search($random_item, $ds->items);

		
		//fetching item's strength-values in variables to subtract from human strengths
    	$handlingI = $db_item_right_name["handling"];
    	$speedI = $db_item_right_name["speed"];
    	$persistanceI = $db_item_right_name["persistance"];
    	$hands_onI = $db_item_right_name["hands_on"];
    
    	
    	//subtract removed item-strength-values from human-stength-values
		
			$human->handling -= $handlingI; 
			$human->speed -= $speedI;
			$human->persistance -= $persistanceI;
			$human->hands_on -= $hands_onI;

	}else {
		exit;
	}
	// return $human_val_added;

}
//Code below prints the result number + rounded number to this php-page

// echo($ds->present_challenge[0]->howGoodAMatch($ds->human[0]));
// $raw_human_score = $ds->present_challenge[0]->howGoodAMatch($ds->human[0]);
// $human_result = round($raw_human_score,3);




/*function challenge($person){

			$json_story_data = file_get_contents("data/ch1.json");
			$story_data = (json_decode($json_story_data, true));
			//the utimate skill template for this challenge
			$story_skills = $story_data["skills"];
			

			//Get the hightest skill
			$value = max($story_skills);
			//Get the corresponding key:
			$key = array_search($value, $story_skills);
			

			//An int between 1 and 1,5 to use further down
			$random_factor = mt_rand(10,15)/10;
			
			
			//fetch the person playing's (human or team) value of $key above
			$player_skills = &$ds->human[0][$key];
			
			//fetch the bot value of $key above
			$bot1 = &$ds->bots[0];
			$bot2 = &$ds->bots[1];
			

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
					if(count($ds->$human[0]->tools) <= 3) {
						shuffle($ds->$human[0]->tools);
						array_pop($ds->$human[0]->tools);
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
*/

