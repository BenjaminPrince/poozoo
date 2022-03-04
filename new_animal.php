<?php

include './config/autoload.php';
$data = array(
    'name'=> $_POST['animal-name'],
    'size'=> $_POST['animal-size'],
    'age'=> $_POST['animal-age'],
    'weight'=> $_POST["animal-weight"],
    'type'=> $_POST['animal-specie']
);
switch ($data['type']) {
    case 'tiger':
    $animal = new Tiger($data);
        break;
    case 'fish':
    $animal = new Fish($data);
        break;
            case 'eagle':
    $animal = new Eagle($data);
        break;
            case 'bear':
    $animal = new Bear($data);
        break;
}
$employee = new Employee;

$employee->createAnimal($animal);

header("Location: index.php");