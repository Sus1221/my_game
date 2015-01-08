<?php

  class Challenge extends Base {

    protected $name;
    protected $description;
    public $skills;
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

    //matching a player to $this challenges strength values
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

      //not for me
      // //check if a person has any tools
      // if (count($person->tools) > 0) {
      //   //if they do, go through them
      //   for ($i = 0; $i < count($person->tools); $i++) {
      //     //and for each skill the tool has
      //     foreach ($person->tools[$i]->skills as $toolSkill => $value) {
      //       //if a toolSkill matches the skill we are currently calculating
      //       if ($toolSkill == $skill) {
      //         //add the toolSkill points 
      //         $has += $value;
      //       }
      //     }
      //   } 
      // }

      //if a person has more points than  the ideal, "round down" to ideal point value(to preserve our percentage)
      //else count the skillpoints a person has
      $personSum += $personHas > $needed ? $needed : $personHas;
      $idealSum += $needed;
    }
    //returns f.e. 0,56
    //return the percentage of skill points the person have
    return $personSum/$idealSum;
  }

  }

