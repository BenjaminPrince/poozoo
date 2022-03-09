<?php

class Marine extends Enclos{

    public $salinity;

    function __construct($data)
    {
        parent::__construct($data);

    }
   

    public function getType(){
        return 'marine';
    }
   
}

?>