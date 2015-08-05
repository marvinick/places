<?php

class Place  {

  private $place;

  function  __construct($place) {
    $this->place = $place;
  }

  function setPlace($new_place) {
    $this->place = (string) $new_place;
  }

  function getPlace() {
    return $this->place;
  }

  function save() {  //saving list of places to cookie
    array_push($_SESSION['list_of_places'], $this);
  }

  static function getAll() {  //getting info from cookie
    return $_SESSION['list_of_places'];
  }

  static function deleteAll()  //deleting cookie info
  {
    $_SESSION["list_of_places"] = array();
  }

}
?>
