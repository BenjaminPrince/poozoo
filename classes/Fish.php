<?php

class Fish extends Animal{

    function __construct($data)
    {
        parent::__construct($data);
        $this->caracteristic = parent::$CARACTERISTIC_MARINE;
    }
    public function swim(){


    }
    public function getType(){
        return 'fish';
    }

    public function sound(){
        return 'PO PO PO PO';
    }
}

?>