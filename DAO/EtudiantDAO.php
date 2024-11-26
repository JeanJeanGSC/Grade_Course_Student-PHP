<?php

require_once __DIR__ . '/../ServerConfig.php';
require_once __DIR__ . '/../model/Etudiant.php';

class EtudiantDAO {

    private $bd;

    public function __construct($bd) {
        $this->bd = $bd;
    }

    public function AjouterEtudiant($prenom, $nom, $adresse, $ville, $pays, $telephone, $domaine) {
        $query = $this->bd->prepare("INSERT INTO Etudiant (prenom, nom, adresse, ville, pays, telephone, domaine) 
                                               VALUES (:prenom, :nom, :adresse, :ville, :pays, :telephone, :domaine)");

        $query->bindParam(':prenom', $prenom);
        $query->bindParam(':nom', $nom);
        $query->bindParam(':adresse', $adresse);
        $query->bindParam(':ville', $ville);
        $query->bindParam(':pays', $pays);
        $query->bindParam(':telephone', $telephone);
        $query->bindParam(':domaine', $domaine);
        return $query->execute();
    }

    public function ModifierEtudiant($etudiantId, $prenom, $nom, $adresse, $ville,
            $pays, $telephone, $domaine) {
        try {
            $query = $this->bd->prepare("UPDATE Etudiant SET prenom = :prenom, nom = :nom, adresse = :adresse, 
                                                    ville = :ville, pays =:pays, telephone = :telephone, domaine = :domaine WHERE etudiantId = :id");
            $query->bindParam(':prenom', $prenom);
            $query->bindParam(':nom', $nom);
            $query->bindParam(':adresse', $adresse);
            $query->bindParam(':ville', $ville);
            $query->bindParam(':pays',$pays);
            $query->bindParam(':telephone', $telephone);
            $query->bindParam(':domaine', $domaine);
            $query->bindParam(':id', $etudiantId);
            $query->bindParam(':pays', $pays);
            $result = $query->execute();
            if ($result) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            return false;
        }
    }

    public function SupprimerEtudiant($etudiantId) {
        $query = $this->bd->prepare("DELETE FROM Etudiant WHERE etudiantId = :id");
        $query->bindParam(':id', $etudiantId);
        return $query->execute();
    }

    public function FindAllEtudiants() {
        $query = $this->bd->prepare("SELECT * FROM Etudiant");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Etudiant');
    }

    public function GetEtudiantById($etudiantId) {
        $query = $this->bd->prepare("SELECT * FROM Etudiant WHERE etudiantId = :id");
        $query->bindParam(':id', $etudiantId);
        $query->execute();
        return $query->fetchObject('Etudiant');
    }
}