<?php
class Resultat {
    private $resultatId;
    private $etudiantId;
    private $coursId;
    private $session;
    private $note;

    public function __construct() { }
    
//    public function __construct($resId, $etudiantId,$coursId, $session, $note) {
//        $this->resId = $resId;
//        $this->etudiantId = $etudiantId;
//        $this->coursId = $coursId;
//        $this->session = $session;
//        $this->note = $note;
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
}