<?php

class Character extends Base {

  protected $handling = 0;
  protected $speed = 0;
  protected $persistance = 0;
  protected $hands_on = 0;
  protected $name;
  protected $success = 50;
  public $tools = array();

  public function __construct($name) {
    $this->name = $name;
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

  public function get_name() {
    return $this->name;
  }

  public function get_success() {
    return $this->success;
  }

  public function set_success($val) {
      $this->success = $val;
  }

  public function get_tools() {
    return $this->tools;
  }

  public function set_tools() {
    return $this->tools;
  }

  public function get_class() {
    return get_class($this);
  }

}

