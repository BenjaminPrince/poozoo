<?php


class Employee{

public function createAnimal($animal){

    include './config/db.php';
    $req = $db->prepare("INSERT INTO animals (name, type, size, weight, age) VALUES (?,?,?,?,?)");
    $req->execute([$animal->name, $animal->type, $animal->size, $animal->weight, $animal->age]);

}
public function showAnimals(){

    include './config/db.php';

    $recup= $db->prepare("SELECT * FROM animals");
    $recup->execute();
    $animalsData = $recup->fetchAll();
    //pour chaque donnés d'animal on retourne un animal
    $animals = [];
    foreach ($animalsData as $data) {

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

        array_push($animals, $animal);

    }
    return $animals;
}


}

?>