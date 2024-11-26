<?php

class Etudiant {

    private $etudiantId;
    private $prenom;
    private $nom;
    private $adresse;
    private $ville;
    private $pays;
    private $telephone;
    private $domaine;

    
    public function __construct() { }
    
//    public function __construct($prenom = '', $nom = '', $adresse = '', $ville = '',
//            $pays = '', $telephone = '', $domaine = '', $etudiantId = null) {
//        $this->etudiantId = $etudiantId;
//        $this->prenom = $prenom;
//        $this->nom = $nom;
//        $this->adresse = $adresse;
//        $this->ville = $ville;
//        $this->pays = $pays;
//        $this->telephone = $telephone;
//        $this->domaine = $domaine;
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