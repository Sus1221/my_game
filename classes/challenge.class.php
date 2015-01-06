<?php

  class Challenge extends Base {

    protected $name;
	  protected $handling = 0;
	  protected $speed = 0;
	  protected $persistance = 0;
  	protected $hands_on = 0;
  	protected $id = 0;

  	public function __construct($name, $handling, $speed, $persistance, $hands_on, $id) {
    $this->name = $name;
    $this->handling = $handling;
    $this->speed = $speed;
    $this->persistance = $persistance;
    $this->hands_on = $hands_on;
    $this->id = $id;
    }

    public function get_name() {
    return $this->name;
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

    public function get_id() {
    return $this->id;
    }

  }
