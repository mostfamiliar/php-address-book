<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Address.php";

    session_start();
    if (empty($_SESSION['list_of_contacts'])) {
        $_SESSION['list_of_contacts'] = array();
    }

    $app = new Silex\Application();

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use ($app) {
        $addresses = $_SESSION['list_of_contacts'];
        return $app['twig']->render('index.html.twig', array('addresses' => Contact::getAll()));
    });

    $app->post('/create_contact', function() use ($app) {
        $address = new Contact($_POST['input_name'], $_POST['input_number'], $_POST['input_address']);
        $address->saveContact();
        return $app['twig']->render('contact.html.twig', array('addresses' => Contact::getAll()));
    });

    $app->post('/delete_addresses', function() use ($app){
        Contact::deleteAll();
        return $app['twig']->render('delete.html.twig');
    });

    $app->post('delete_single', function() use ($app) {
        $item = $_POST['contactName'];
        $contacts = $_SESSION['list_of_contacts'];
        $count = 0;
        foreach ($contacts as $contact) {
          $count++;
            // $index = array_search($contact->getName(), $contacts);
          if ( $item == $contact->getName()) {
            echo $count;
            unset($contacts[$count]);
          }
        }
        var_dump($contacts);
        return $app['twig']->render('single_delete.html.twig', array('contact' => $contacts));
    });

    return $app;
?>
