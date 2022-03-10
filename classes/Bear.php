<?php

class Bear extends Animal{

    function __construct($data)
    {
        parent::__construct($data);
        $this->caracteristic = parent::$CARACTERISTIC_TERRESTRIAL;

    }
    public function climbTree(){


    }

    public function getType(){
        return 'bear';
    }
    public function sound(){
        return 'GRRRRRRRR';
    }

}

?>