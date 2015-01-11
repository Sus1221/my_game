<?php

  class Challenge extends Base {

    protected $name;
    protected $description;
    public $skills;

  	public function __construct($name, $challenge_data) {
      $this->name = $name;
      $this->skills = $challenge_data["skills"];
      $this->description = $challenge_data["description"];
    }

    public function get_skills() {
      $this->skills = $challenge_data["skills"];
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

    public function get_description() {
      return $this->description;
    }

    //matching a player to $this challenge's strength values
    public function howGoodAMatch($person){
    //total points a person has
    $personSum = 0;
    //total points possible for this challenge
    $idealSum = 0;

    //we now want to check how good a person is at performing this challenge
    foreach($this->skills as $skill => $points){
      //here we check points required by challenge
      $needed = $points;
      //here we check how many points the person has in each strength
      $personHas = $person->{$skill}; 

      //if a person has more points than  the ideal, "round down" to ideal point value
      //else count the skillpoints a person has
      $personSum += $personHas > $needed ? $needed : $personHas;
      $idealSum += $needed;
    }
    //return the percentage of the ideal skill points the person have, f.e. 0,56
    return $personSum/$idealSum;
  }

  }

