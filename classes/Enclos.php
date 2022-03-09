
<?php

abstract class Enclos {

    private $numberAnimals;
    public $name;
    public $isClean;
    public $type;
    static public $CLEANSTATE_CLEAN = 0;
    static public $CLEANSTATE_CORRECT = 1;
    static public $CLEANSTATE_DIRTY = 2;

    function __construct($data)
    {
        $this->hydrate($data);
    }

    public function showarrayCaracter(){
       
    }

    public function showanimalsCaracter(){

    }
    public function addAnimal($animal){

    }
    public function removeAnimal($animal){

    }

    public function countAnimals(){
        $this->numberAnimals = 0;

    }
    public function cleaning(){
        $this->isClean = "clean";
    }

    private function hydrate($data) {
    $this->name = $data['name'] ;
    $this->type = $data['type'] ;
    $this->isClean = $data['is_clean'] ?? "clean";
    $this->numberAnimals = $data['number_animals'] ?? 0 ;
   
}



}



?>