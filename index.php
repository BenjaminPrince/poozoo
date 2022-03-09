<?php
include "./config/db.php";
include './config/autoload.php';
$employee = new Employee();
$animals = $employee->showAnimals();
$enclos = $employee->showEnclos();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="style.css">
    <title>PooZoo</title>
</head>
<body>
    <div class="flex flex-row">
        <form action="new_animal.php" method="post" class="flex flex-col w-35 p-3 border">
            <h2 class="font-bold">Nouvel animal</h2>
            <label for="animal-name-input">Nom</label>
            <input type="text" name="animal-name" id="animal-name-input">
            <label for="animal-poids-input">Poids</label>
            <input type="number" name="animal-weight" id="animal-poids-input">
            <label for="animal-size-input">Taille</label>
            <input type="number" name="animal-size" id="animal-size-input">
            <label for="animal-age-input">Age</label>
            <input type="number" name="animal-age" id="animal-age-input">
            <label for="animal-specie-input">Espèce</label>
            <select name="animal-specie" id="animal-specie-input">
                <option value="tiger">Tigre</option>
                <option value="bear">Ours</option>
                <option value="fish">Poisson</option>
                <option value="eagle">Aigle</option>
            </select>
            <label for="animal-enclos-input">Enclos</label>
            <select name="animal-enclos" id="animal-enclos-input">
                <?php foreach ($enclos as $e) : ?>
                    <option value="<?= $e->id ?>"><?= $e->getName() ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit" class="m-2 p-2 border bg-yellow-100 hover:bg-yellow-500">Créer</button>
        </form>

        <form action="new_enclos.php" method="post" class="flex flex-col w-35 p-3 border">
            <h2 class="font-bold">Nouvel Enclos</h2>
            <label for="enclos-name-input">Nom</label>
            <input type="text" name="enclos-name" id="enclos-name-input">
            <label for="enclos-type-input">type</label>
            <select name="enclos-type" id="enclos-type-input">
                <option value="aquarium">Aquarium</option>
                <option value="paddock">Plaine</option>
                <option value="aviary">Volière</option>
            </select>
            <button type="submit" class="m-2 p-2 border bg-yellow-100 hover:bg-yellow-500">Créer</button>
        </form>
    </div>
  
    <div class="zoo flex flex-wrap ">
        <div class="enclosure w-96 h-96 m-3 border border-green-400 border-2 rounded-xl flex flex-wrap justify-center">
<?php

foreach ($animals as $animal) {
    ?>

            <div class="group animal <?= $animal->getType() ?> relative w-28 h-44 m-1 border-2 border-gray-300 rounded-xl flex flex-col justify-end items-center bg-contain bg-no-repeat">
                <div class="font-bold"><?= $animal->name; ?></div>
                <div class="italic"><?= $animal->age;?> ans</div>
                <div class="animal-details bg-white absolute top-0 bottom-0 left-0 right-0 hidden group-hover:block">
                    <div>Nom : <?= $animal->name; ?></div>
                    <div>Age : <?= $animal->age; ?></div>
                    <div>Poids : <?= $animal->weight; ?></div>
                    <div>Taille : <?= $animal->getSize(); ?></div>
                    <div>Faim : <?= $animal->isHungry; ?></div>
                    <div>Malade : <?= $animal->isSick; ?></div>
                    <div>Dort : <?= $animal->isSleeping; ?></div>
                    
                </div>
        </div>
       
        

            <?php
            
}

?>




</div>
</div>
<?php
if (isset($_GET['alert'])) : ?>
<div class="sticky bottom-3 left-0 right-0 p-5 m-3 bg-red-100 border border-red-400"><?= $_GET['alert'] ?></div>
<?php endif; ?>
</body>
</html>