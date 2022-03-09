<?php

include './config/autoload.php';
$data = array(
    'name'=> $_POST['enclos-name'],
    'type'=> $_POST['enclos-type']
);

switch ($data['type']) {
    case 'paddock':
    $enclos = new Paddock($data);
    break;
    case 'aquarium':
    $enclos = new Aquarium($data);
    break;
    case 'aviary':
    $enclos = new Aviary($data);
    break;
}
$employee = new Employee;

$employee->createEnclos($enclos);
header("Location: ./index.php");
