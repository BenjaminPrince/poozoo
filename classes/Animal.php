<?php

abstract class Animal  {

    public $name;
    public $age;
    private $size;
    public $weight;
    public $isSleeping;
    public $isHungry;
    public $isSick;

function __construct($data)
{
    $this->hydrate($data);
}

public function getSize(){
    return $this->size;
}

public function setSize(int $argument){
    if($argument>0){
    $this->size=$argument;
    }else{
        throw new Exception("Le nombre doit être supérieur à zéro.");
    }
}


public function eat(){
    $this->isHungry = 0;
}

public function heal(){
    $this->isSick = 0;
}

public function awake(){
    $this->isSleeping = 0;
}

abstract public function makeSound();

private function hydrate($data) {
    $this->name = $data['name'] ;
    $this->age = $data['age'] ;
    $this->size = $data['size'] ;
    $this->weight = $data['weight'] ;
    $this->isSleeping = $data['is_sleeping'] ?? 0 ;
    $this->isHungry = $data['is_hungry'] ?? 0 ;
    $this->isSick = $data['is_sick'] ?? 0 ;
}

    abstract function getType();

}

?>