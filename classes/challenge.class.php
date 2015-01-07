<?php

  class Challenge extends Base {

    protected $name;
    protected $description;
    protected $skills;
/*    
	  protected $handling = 0;
	  protected $speed = 0;
	  protected $persistance = 0;
  	protected $hands_on = 0;
  	protected $id = 0;*/

  	public function __construct($name, $challenge_data) {
      $this->name = $name;
      $this->skills = $challenge_data["skills"];
      $this->description = $challenge_data["description"];
      /*$this->handling = $handling;
      $this->speed = $speed;
      $this->persistance = $persistance;
      $this->hands_on = $hands_on;
      $this->id = $id;*/
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
