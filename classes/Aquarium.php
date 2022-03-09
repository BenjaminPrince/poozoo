<?php

class Aquarium extends Enclos{

    public $salinity;

    function __construct($data)
    {
        parent::__construct($data);
        $this->hydrate($data);

    }

    public function hydrate($data){
        $this->salinity = $data['salinity'] ?? 100;
    }

    public function clean() {
        if ($this->cleanState > 0) $this->cleanState--;
    }
}

?>