<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Address.php";

    $app['debug'] = true;
    session_start();
    if (empty($_SESSION['list_of_addresses'])) {
      $_SESSION['list_of_addresses'] = array();
    }

    $app = new Silex\Application();

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use ($app) {
        $addresses = $_SESSION['list_of_addresses'];
        return $app['twig']->render('index.html.twig', array('addresses' => $addresses));
    });

    // $app->post('/new_address', function() use ($app) {
    //   $address = new Address($_POST['input_name'], $_POST['input_number'], $_POST['input_address']);
    //   $address->save();
    //   return $app['twig']->render('index.html.twig', array('newaddress' => $address));
    // });

    return $app;
?>
