<?php

class Eagle extends Animal{

    function __construct($data)
    {
        parent::__construct($data);

    }
    public function fly(){


    }

    public function getType(){
        return 'eagle';
    }
    public function makeSound(){

        echo 'rlouuu ';
       }
}

?>