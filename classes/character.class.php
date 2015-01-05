<?php

class Character extends Base {
  // properties
  protected $handling = 0;
  protected $speed = 0;
  protected $persistance = 0;
  protected $hands_on = 0;
  protected $name;
  protected $success = 50;
  protected $tools = array();

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

    public function get_name() {
    return $this->name;
  }

    public function get_success() {
    return $this->success;
  }

    public function get_tools() {
    return $this->tools;
  }

  public function win_tool() {
    
  }

  public function loose_tool() {
    
  }

  public function accept_challenge() {
    
  }

  public function change_challenge() {
    
  }

  public function carry_out_challenge() {
    
  }

  public function carry_out_challenge_with_companion() {
    
  }
}