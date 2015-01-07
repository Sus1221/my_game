<?php

class Team extends Character {

	protected $members = array();
	protected $handling;
	protected $speed;
	protected $persistance;
	protected $hands_on;
	
}


public function __construct($human, $bot) {

	$this->members[] = $humanPlayer;
    $this->members[] = $computerPlayer;
    $this->handling = $human->handling + $bot->handling;
    $this->speed = $human->speed + $bot->speed;
    $this->persistance = $human->persistance + $bot->persistance;
    $this->hands_on = $human->hands_on + $bot->hands_on;
  }


 
  
   

