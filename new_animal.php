<?php

include './config/autoload.php';
$data = array(
    'name'=> $_POST['animal-name'],
    'size'=> $_POST['animal-size'],
    'age'=> $_POST['animal-age'],
    'weight'=> $_POST["animal-weight"],
    'type'=> $_POST['animal-specie'],
    'enclos_id'=> $_POST['animal-enclos']
);

$animal = Animal::getSpecie($data);

$employee = new Employee;

$employee->createAnimal($animal);