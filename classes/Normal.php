<?php

class Normal extends Enclos{

    function __construct($data)
    {
        parent::__construct($data);

    }
   

    public function getType(){
        return 'normal';
    }
   

}

?>