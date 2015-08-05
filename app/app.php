<?php
  require_once __DIR__."/../vendor/autoload.php";
  require_once __DIR__."/../src/task.php";

  session_start();
  if (empty($_SESSION['list_of_places'])) {
    $_SESSION['list_of_places'] = array();
  }

  $app = new Silex\Application();

  

?>
