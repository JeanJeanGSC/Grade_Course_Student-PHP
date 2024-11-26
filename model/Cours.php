<?php
class Cours {
    private $coursId;
    private $nom;
    private $nombre_credits;

    public function __construct() { }
    
//    public function __construct($nom = null, $nombre_credits = null, $coursId = null) {
//        $this->coursId = $coursId;
//        $this->nom = $nom;
//        $this->nombre_credits = $nombre_credits;
//    }
    
        public function __get($name) {
        // Vérifie si la propriété existe
        if (property_exists($this, $name)) {
            return $this->$name;
        }
        return null;
    }

    public function __set($name, $value) {
        // Vérifie si la propriété existe
        if (property_exists($this, $name)) {
            $this->$name = $value;
        }
    }

    public function setNombreCredits($nombre_credits) {
        if ($nombre_credits >= 1 && $nombre_credits <= 8) {
            $this->nombre_credits = $nombre_credits;
        }
    }
}
