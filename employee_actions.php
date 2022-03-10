<?php

include './config/autoload.php';

$employee = new Employee();

$enclos = $employee->getEnclos($_POST['enclos-id']);

if (isset($_POST['clean'])) {
    $employee->cleanEnclosure($enclos);
}

if (isset($_POST['feed'])) {
    $employee->feedAnimals($enclos);
}