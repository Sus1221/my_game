 <?php

class Item extends Base {

  protected $description;
  protected $skills;
  
  public function __construct($description,$skills){
    $this->description = $description;
    $this->skills = $skills;
  }

public function get_skills() {
  return $this->skills;
}

}
