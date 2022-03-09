<?php

class Aviary extends Enclos{

    public $height;

    function __construct($data)
    {
        parent::__construct($data);

    }
   


    public function getType(){
        return 'aviary';
    }
   

}

?>