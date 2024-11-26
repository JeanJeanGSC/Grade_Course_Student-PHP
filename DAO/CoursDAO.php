<?php

require_once __DIR__ . '/../ServerConfig.php';
require_once __DIR__ . '/../model/Cours.php';

class CoursDAO {

     private $bd;

    public function __construct($bd) {
        $this->bd = $bd;
    }
    
    public function AjouterCours(Cours $cours) {
        $nom = $cours->__get('nom');
        $nombre_credits = $cours->__get('nombre_credits');
        $query = $this->bd->prepare("INSERT INTO cours (nom, nombre_credits) VALUES (:nom, :nombre_credits)");
        $query->bindParam(':nom', $nom);
        $query->bindParam(':nombre_credits', $nombre_credits);
        return $query->execute();
    }

public function ModifierCours($coursId, $nom, $nombre_credits) {
    $query = $this->bd->prepare("UPDATE cours SET nom = :nom, nombre_credits = :nombre_credits WHERE coursId = :id");
    $query->bindParam(':id', $coursId);
    $query->bindParam(':nom', $nom);
    $query->bindParam(':nombre_credits', $nombre_credits);

    if ($query->execute()) {
        return $query->rowCount() > 0; // Retourne vrai si au moins une ligne a été modifiée
    }
    return false;
}

    public function SupprimerCours($coursId) {
        $query = $this->bd->prepare("DELETE FROM cours WHERE coursId = :id");
        $query->bindParam(':id', $coursId);
        return $query->execute();
    }
    
    public function FindAllCours() {
        $query = $this->bd->prepare("SELECT * FROM cours");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Cours');
    }

    public function GetCoursById($coursId) {
        $query = $this->bd->prepare("SELECT * FROM cours WHERE coursId = :id");
        $query->bindParam(':id', $coursId);
        $query->execute();
        return $query->fetchObject('Cours');
    }
}

