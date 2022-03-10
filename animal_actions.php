<?php

include './config/autoload.php';

// On instancie un employé pour avoir accès à ses methodes
$employee = new Employee();

// On instancie l'animal et l'enclos dans lequel il se trouve grâce aux ID qu'on a envoyé depuis notre formulaire
$enclos = $employee->getEnclos($_POST['enclos-id']);
$animal = $employee->getAnimal($_POST['animal-id']);

if (isset($_POST['transfert'])) {
    // On récupère l'enclos de destination de l'animal grace à l'ID envoyé depuis le formulaire
    $newEnclos = $employee->getEnclos($_POST['transfert']);
    // On déplace l'animal
    $employee->moveAnimal($animal, $newEnclos);
}

if (isset($_POST['make-sound'])) {
    $animal->makeSound();
}

if (isset($_POST['heal'])) {
    $employee->healAnimal($animal);
}