<?php

class Fish extends Animal{

    function __construct($data)
    {
        parent::__construct($data);

    }
    public function swim(){
        

    }
    public function getType(){
        return 'fish';
    }

    
    public function makeSound(){

        echo 'po po po bagera';
       }
}

?>