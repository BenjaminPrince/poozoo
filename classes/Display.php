<?php

class Display {
    static function animalSound($sound) {
        self::setHomeMessage($sound);
    }

    static function setHomeMessage($message) {
        // On redirige vers la page d'accueil, en fournissant un message qui sera affiché en haut à droite
        header("Location: ../index.php?alert=$message");
    }
    static function showEnclosInfo(Enclos $enclos){
        header('Location: ../enclos.php?id='.$enclos->id);
    }

    static function showEnclosAnimalsInfo($enclos){

    }

    static function refreshZoo() {
        // On redirige vers la page d'accueil
        header('Location: ../index.php');
    }
}