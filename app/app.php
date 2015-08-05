<?php
  require_once __DIR__."/../vendor/autoload.php";
  require_once __DIR__."/../src/place.php";

  session_start();  //Creating cookie for session
  if (empty($_SESSION['list_of_places'])) {
    $_SESSION['list_of_places'] = array();
  }

  $app = new Silex\Application();

  $app->get("/", function() {  //Accessing static methods and outputting saved list
    $output = "";
    $all_places = Place::getAll();
    if (!empty($all_places)){
      $output .= "
      <h1>Places Visited</h1>
      <p>Here are all the places you visited:</p>";

      foreach ($all_places as $place){  //foreach loop grabbing saved places
        $output .= "<p>" . $place->getPlace() . "</p>";
      }
    }

  $output .= "
    <form action='/places' method='post'>
      <label for='description'>Where have you been?</label>
      <input id='description' name='description' type='text'>
      <button type='submit'>Add place</button>
    </form>"; //form for grabbing places visited

    $output.= "
    <form action='/delete_places' method='post'>
        <button type='submit'>delete</button>
    </form>
    ";  // form for deleting places

    return $output;
  });

  $app->post("/places", function(){ //posting info retrieved from place post
    $place = new Place($_POST['description']);
    $place->save();
    return "
    <h1>You created a destination</h1>
    <p>" . $place->getPlace() . "</p>
    <p><a href='/'>View your list of places you visited.</a></p>";

  });

  $app->post("/delete_places", function() {  //delete function for stored places
   Place::deleteAll();

    return "
      <h1>List Cleared!</h1>
      <p><a href='/''>Home</a></p>
    ";
  });

  return $app;

?>
