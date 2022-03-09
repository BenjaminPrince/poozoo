<?php

class Paddock extends Enclos {
   
    
    public function clean(){

    if(empty($this->animals)){
         switch($this-> cleanState) {
            case 0:
                break;
                case 1:
                    $this->cleanState -1;
                    break;
                    case 2:
                        $this->cleanState --;
                        break;
        default:
                throw new exception("only accept value 1 and 2");
                break;
                    }
            }else{
                throw new Exception ("Error procssing request",1);  
        }
    }
}

?>