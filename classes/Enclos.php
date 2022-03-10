<?php

abstract class Enclos{

    private $maxSize = 6;
    public $id;
    private $name;
    public $cleanState;
    public $animals;
    private $type;
    static public $CLEANSTATE_CLEAN = 0;
    static public $CLEANSTATE_CORRECT = 1;
    static public $CLEANSTATE_DIRTY = 2;

    static public $TABLE = 'enclos';

    public function __construct($data)
    {
        $this->hydrate($data);
    }

    private function hydrate($data){
        $this->id = $data['id'] ?? null;
        $this->name = $data['name'];
        $this->type = $data['type'];
        $this->cleanState = $data['clean_state'] ?? self::$CLEANSTATE_CORRECT;
        $this->animals = $this->getAnimals();
    }

    private function getAnimals() {
        $database = new Database();
        $animalsData = $database->getAllWhere(Animal::$TABLE, 'enclos_id', $this->id);

        return array_map(function($animalData){
            return Animal::getSpecie($animalData);
        }, $animalsData);
    }

    public function toSql() {
        // Convertit notre instance Enclos en données brutes
        return array(
            'id' => $this->id ?? null,
            'name' => $this->name,
            'clean_state' => $this->cleanState,
            'type' => $this->type,
            'salinity' => $this->salinity ?? 0,
            'height' => $this->height ?? 0,
        );
    }

    protected function persist(){
        $database = new Database();
        $database->update('enclos', $this->id, $this->toSql());
    }

    public function showStats(){
        Display::showEnclosInfo($this);
    }

    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
        $this->persist();
    }

    public function setCleanState($cleanState) {
        $this->cleanState = $cleanState;
        $this->persist();
    }

    public function getAnimalsCount(){

       return count($this->animals);

    }

    public function showAnimalsStats(){
        Display::showEnclosAnimalsInfo($this);
    }

    public function isEmpty() : bool{
        if($this->getAnimalsCount() == 0){
            return true;
        }else{
            return false;
        }
    }
    public function isFull() : bool{
        if($this->getAnimalsCount() == $this->maxSize){
            return true;
        }else{
            return false;
        }
    }

    public function addAnimal($animal){
        // On vérifie que l'enclos n'est pas plein
        if (!$this->isFull()){
            // On vérifie que l'animal est compatible avec cet enclos
            if ($this->isAnimalCompatible($animal)){
                // On ajoute l'animal dans l'enclos (dans la propriété $animals qui est un tableau)
                array_push($this->animals, $animal);
                // On modifie le enclosId de l'animal
                $animal->setEnclosId($this->id);
                // On met à jour les données de notre base SQL
                $this->persist();

                // ! Ce persist ne concerne que les données de notre enclos, pas des animaux. L'animal a son propre persist, qui dans ce cas est déclenché dans la methode setEnclosId() appelée au dessus.
            }
        }
    }

    public function isAnimalCompatible($animal){
        // Si les caractéristiques de l'animal ne sont pas compatibles avec notre enclos, il n'est pas compatible
        if (!$this->checkCaracteristicCompatibility($animal)) {
            return false;
        }
        // Sinon, si l'enclos est vide, il est compatible
        if($this->isEmpty()){
             return true;
        }
        // Sinon, si l'enclos n'est pas vide, mais que l'animal contenu de l'enclos est du meme type que l'animal qu'on ajoute, il est compatible
        if ($animal->getType() == $this->animals[0] ->getType() ){
           return true;
        }
        // Dans tous les autres cas, il n'est pas compatible
        return false;

        // ! On a pas besoin d'utiliser else car dans chaque if, on retourne une valeur. Quans on retourne une valeur, le reste du code de même niveau est ignoré. Donc si on arrive au if suivant, c'est forcément que le if précédent était faux
    }

    public function removeAnimal($animal){
        // ! Aucune idée de si ça fonctionne, c'est l'IA qui a codé ça, il faudra vérifier :D
        $key = array_search($animal, $this->animals);
        unset($this->animals[$key]);
    }

    static public function getSubType($data){
        // Ceci est une methode statique. On peut y accéder sans avoir à instancier un Enclos.
        // Pour y acceder, il suffira de faire Enclos::getSubType($data)

        // On gère les différentes valeurs possibles du type d'enclos, et on crée une instance de la sous classe correspondante qu'on stocke dans la variable $enclos
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

        // ! ATTENTION : il faut toujours gérer l'option default dans un switch, ne serait-ce que pour envoyer une exception qui nous informera sur l'erreur

        default:
            throw new Exception("Le type d'enclos fourni ne correspond à aucun type connu.");
    }

    // On retourne notre enclos
    return $enclos;
    }


    abstract public function clean();

    abstract public function checkCaracteristicCompatibility($animal);

}

?>