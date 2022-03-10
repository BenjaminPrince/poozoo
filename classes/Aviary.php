<?php

class Aviary extends Enclos{

    public $height;


    function __construct($data)
    {
        parent::__construct($data);
        $this->hydrate($data);

    }

    public function hydrate($data){
        $this->height = $data['height'] ?? 100;
    }

    public function clean() {
        if ($this->cleanState != Enclos::$CLEANSTATE_CLEAN) {
            $this->cleanState--;
            $this->persist();
        }
    }

    public function checkCaracteristicCompatibility($animal)
    {
        if ($animal->caracteristic == Animal::$CARACTERISTIC_AERIAL) {
            return true;
        }else{
            return false;
        }
    }
}

?>