<?php

class Paddock extends Enclos{
    function __construct($data)
    {
        parent::__construct($data);

    }

    public function clean() {
        if ($this->cleanState != Enclos::$CLEANSTATE_CLEAN) {
            $this->cleanState--;
            $this->persist();
        }
    }

    public function checkCaracteristicCompatibility($animal)
    {
        if ($animal->caracteristic == Animal::$CARACTERISTIC_TERRESTRIAL) {
            return true;
        }else{
            return false;
        }
    }


}
?>