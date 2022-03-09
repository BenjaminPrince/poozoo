<?php

abstract class Animal  {

    public $name;
    public $age;
    private $size;
    public $weight;
    public $isSleeping;
    public $isHungry;
    public $isSick;
    public $id;
    private $enclosId;



function __construct($data)
{
    $this->hydrate($data);
}

public function persist(){
    $database = new Database();
    $database->updateRow('animals', $this->id, $this->toSql());
}

public function getSize(){
    return $this->size;
}

public function getEnclosId() {
    return $this->enclosId;
}

public function setEnclosId($id) {
    $this->enclosId = $id;

    $this->persist();
}

public function setSize(int $size){
    if($size > 0){
        $this->size = $size;
    }else{
        throw new Exception("Animal size has to be a positive integer. " . strval($size) . " given");
    }
    $this->persist();
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
    $this->id = $data['id'] ?? null;
    $this->name = $data['name'] ;
    $this->age = $data['age'] ;
    $this->size = $data['size'] ;
    $this->enclosId = $data['enclos_id'] ;
    $this->weight = $data['weight'] ;
    $this->isSleeping = $data['is_sleeping'] ?? 0 ;
    $this->isHungry = $data['is_hungry'] ?? 0 ;
    $this->isSick = $data['is_sick'] ?? 0 ;
}

public function toSql() {
    return array(
        'id' => $this->id,
        'name' => $this->name,
        'age' => $this->age,
        'weight' => $this->weight,
        'size' => $this->size,
        'enclos_id' => $this->enclosId,
        'is_sleeping' => $this->isSleeping,
        'is_sick' => $this->isSick,
        'is_hungry' => $this->isHungry,
    );
}

    static public function getSpecie($data){
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
    return $animal;
}



    abstract function getType();

}

?>