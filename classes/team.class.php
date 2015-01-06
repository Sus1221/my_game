<?php

class Team extends Character {

	protected $handling;
	protected $speed;
	protected $persistance;
	protected $hands_on;
	
}


public function __construct($one, $two) {
    $this->handling = $one->handling + $two->handling;
    $this->speed = $one->speed + $two->speed;
    $this->persistance = $one->persistance + $two->persistance;
    $this->hands_on = $one->hands_on + $two->hands_on;
  }