<?php

		$ds->human[0] = $human;
		$ds->bots[0] = $bot;
		var_dump($ds->human[0]);
		var_dump($ds->bots);

class Team extends Character {

	public $handling;
	public $speed;
	public $persistance;
	public $hands_on;
	

	public function __construct($human, $bot) { 

    	$this->handling = $human->handling + $bot->handling;
    	$this->speed = $human->speed + $bot->speed;
    	$this->persistance = $human->persistance + $bot->persistance;
    	$this->hands_on = $human->hands_on + $bot->hands_on;
	}

 public function get_handling() {
    return $this->handling;
  }

  public function set_handling($number) {
    if($number < 100 && $number > 0) {
      $this->handling = $number;
    } else {
      exit;
    }
  }

  public function get_speed() {
    return $this->speed;
  }

  public function set_speed($number) {
    if($number < 100 && $number > 0) {
      $this->speed = $number;
    } else {
      exit;
    }
  }

  public function get_persistance() {
    return $this->persistance;
  }

  public function set_persistance($number) {
    if($number < 100 && $number > 0) {
      $this->persistance = $number;
    } else {
      exit;
    }
  }

  public function get_hands_on() {
    return $this->hands_on;
  }

  public function set_hands_on($number) {
    if($number < 100 && $number > 0) {
      $this->hands_on = $number;
    } else {
      exit;
    }
  }
}



 
  
   

