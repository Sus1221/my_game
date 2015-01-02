 <?php

class Items extends Base {

  protected $name;
  protected $handling = 0;
  protected $speed = 0;
  protected $persistance = 0;
  protected $technology = 0;

  public function __construct($name, $handling, $speed, $persistance, $technology) {
    $this->name = $name;
    $this->handling = $handling;
    $this->speed = $speed;
    $this->persistance = $persistance;
    $this->technology = $technology;
  }


}