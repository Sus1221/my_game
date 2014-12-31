<?php

class Character extends Base {
  // properties
  protected $name;
  protected $success = 50;
  protected $tools = array();

  public function __construct($name) {
    $this->name = $name;
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