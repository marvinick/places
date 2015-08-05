<?php
  require_once __DIR__."/../vendor/autoload.php";
  require_once __DIR__."/../src/place.php";

  session_start();  //Creating cookie for session
  if (empty($_SESSION['list_of_places'])) {
    $_SESSION['list_of_places'] = array();
  }

  $app = new Silex\Application();

  $app->register(new Silex\Provider\TwigServiceProvider(), array(
      'twig.path' => __DIR__.'/../views'
  ));

  $app->get("/", function() use ($app) {  //Accessing static methods and outputting saved list

    return $app['twig']->render('places.html.twig', array('places' => Place::getAll()));

  });

  $app->post("/places", function() use ($app){ //posting info retrieved from place post
    $place = new Place($_POST['place']);
    $place->save();
    return $app['twig']->render('create_place.html.twig', array('newplace' => $place));
  });

  $app->post("/delete_places", function() use ($app) {  //delete function for stored places
   Place::deleteAll();
   return $app['twig']->render('delete_places.html.twig');
  });

  return $app;

?>
