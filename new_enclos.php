<?php

include './config/autoload.php';
$data = array(
    'name'=> $_POST['enclos-name'],
    'type'=> $_POST['enclos-type']
);

switch ($data['type']) {
    case 'normal':
    $enclos = new Normal($data);
        break;
    case 'aviary':
    $enclos = new Aviary($data);
        break;
    case 'marine':
    $enclos = new Marine($data);
        break;
        
}
$employee = new Employee;

$employee->createEnclos($enclos);

