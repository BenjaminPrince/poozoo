<?php

class Eagle extends Animal{

    function __construct($data)
    {
        parent::__construct($data);
        $this->caracteristic = parent::$CARACTERISTIC_AERIAL;

    }
    public function fly(){


    }

    public function getType(){
        return 'eagle';
    }
    public function sound(){
        return 'IIIIIIIIIII';
    }
}

?>