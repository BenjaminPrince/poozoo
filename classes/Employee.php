<?php


class Employee{

    private $database;

    public function __construct() {
        $this->database = new Database();
    }


    public function scanEnclosure(Enclos $enclosure){
        $enclosure->showStats();
        $enclosure->showAnimalsStats();
    }

    public function cleanEnclosure(Enclos $enclosure){
        if($enclosure->isEmpty()){
            $enclosure->clean();

            Display::refreshZoo();
        }
        else {
            Display::setHomeMessage("Please empty this enclosure before cleaning");
        }

    }

    public function feedAnimals($enclosure){
        $enclosure->animals;
        foreach ($enclosure->animals as $animal ) {
            if($animal->isSleeping) {
                $animal->awake();
            }
            $animal->eat();

        }

        Display::refreshZoo();

    }

    public function healAnimal($animal){
        $animal->heal();
        Display::refreshZoo();
    }

    public function moveAnimal(Animal $animal, Enclos $enclosure){
        // On vérifie que l'on peut bien ajouter l'animal dans l'enclos
        // Deux conditions : l'animal est compatible, et l'enclos n'est pas plein
        if($enclosure->isAnimalCompatible($animal) && !$enclosure->isFull()){
            // On récupère l'ID de l'enclos actuel de l'animal
            $actualEnclosId = $animal->getEnclosId();
            // On crée une instance d'enclos basé sur cet ID
            $actualEnclos = $this->getEnclos($actualEnclosId);
            // On retire l'animal de cet enclos
            $actualEnclos->removeAnimal($animal);
            // On ajoute l'animal dans l'enclos de destination
            $enclosure->addAnimal($animal);
            // On rafraichit la page
            Display::refreshZoo();
        }
        else {
            // On notifie l'utilisateur que l'animal ne peut pas être ajouté
            Display::setHomeMessage("This animal can't be added to this enclosure, please check the requirements");
        }
    }


    public function createAnimal($animal){
        $enclosure = $this->getEnclos($animal->getEnclosId());
        if($enclosure->isAnimalCompatible($animal) && !$enclosure->isFull()){
            $this->database->add(Animal::$TABLE, $animal->toSql());
            Display::refreshZoo();
        }
        else {
            Display::setHomeMessage("Can't create this new animal. Please check the enclosure requirements.");
        }
    }

    public function createEnclos($enclos){
        $this->database->add(Enclos::$TABLE, $enclos->toSql());
        Display::refreshZoo();
    }

    public function getAnimal($id) {
        $data = $this->database->get(Animal::$TABLE, $id);
        return Animal::getSpecie($data);
    }

    public function getEnclos($id) {
        // On récupère les données de l'enclos grâce à son ID
        $enclosData = $this->database->get(Enclos::$TABLE, $id);
        // On retourne une instance d'Enclos basée sur ces données
        return Enclos::getSubType($enclosData);
    }

    public function getAllAnimals(){
        $animalsData = $this->database->getAll(Animal::$TABLE);
        return array_map(function($data) {
            return Animal::getSpecie($data);
        }, $animalsData);
    }

    public function getAllEnclos(){
        $enclosData = $this->database->getAll(Enclos::$TABLE);
        return array_map(function($data) {
            return Enclos::getSubType($data);
        }, $enclosData);
    }

    public function randomize() {
        $enclos = $this->getAllEnclos();

        foreach ($enclos as $e) {
            $e->setCleanState(rand(0, 2));
            foreach ($e->animals as $animal) {
                $animal->setState(rand(0, 1), rand(0, 1), rand(0, 1));
            }
        }

        Display::refreshZoo();
    }
}

?>