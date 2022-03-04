
<?php

abstract class enclos {

    public $name;
    public $type;
    public $isClean;
    public $numberAnimals;

    function __construct($data)
    {
        $this->hydrate($data);
    }

    public function showarraycaracter(){
       
    }

    public function showanimalscaracter(){

    }
    public function addanimals(){

    }
    public function deletanimal(){}

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

abstract function getType();

}



?>