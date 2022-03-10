<?php

class Tiger extends Animal{

    function __construct($data)
    {
        parent::__construct($data);
        $this->caracteristic = parent::$CARACTERISTIC_TERRESTRIAL;
    }
    public function errant(){


    }
   public function getType(){
       return 'tiger';
   }
   public function sound(){
        return 'ROARRRRRR';
   }


}

?>