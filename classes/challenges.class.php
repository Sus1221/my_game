<?php

	protected $handling = 0;
	protected $speed = 0;
	protected $persistance = 0;
  	protected $hands_on = 0;
  	protected $name;

  	public function __construct($name) {
    $this->name = $name;
  	}

  	public function get_handling() {
    return $this->handling;
  	}

    public function get_speed() {
    return $this->speed;
  	}

    public function get_persistance() {
    return $this->persistance;
  	}

    public function get_hands_on() {
    return $this->hands_on;
  	}