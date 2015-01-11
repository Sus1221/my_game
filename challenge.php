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

//If human requested to do challenge alone
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

//If human requested to team up with a competitor
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

