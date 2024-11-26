<?php

require_once __DIR__ . '/../ServerConfig.php';
require_once __DIR__ . '/../model/Resultat.php';

class ResultatDAO {

    private $bd;

    public function __construct($bd) {
        $this->bd = $bd;
    }

    public function AjouterResutat(Resultat $resultat) {
        $bd = Database::getConnection();
        $query = $bd->prepare("INSERT INTO Resultat (etudiantId, coursId, session, note) VALUES (:etudiantId, :coursId, :session, :note)");
        $query->bindParam(':etudiantId', $resultat->getEtudiantId());
        $query->bindParam(':coursId', $resultat->getCoursId());
        $query->bindParam(':session', $resultat->getSession());
        $query->bindParam(':note', $resultat->getNote());
        return $query->execute();
    }

    public function ModifierResultat($resId, $note) {
        $query = $this->bd->prepare("UPDATE Resultat SET note = :note WHERE resultatId = :id");

        // Débogage des valeurs
        echo "resId: $resId, note: $note <br>";

        $query->bindParam(':id', $resId);
        $query->bindParam(':note', $note);

        if ($query->execute()) {
            echo "Modification réussie!<br>";
        } else {
            echo "Erreur SQL : " . implode(", ", $query->errorInfo()) . "<br>";
        }
    }

    public function SupprimerResultat($resId) {
        $bd = Database::getConnection();
        $query = $bd->prepare("DELETE FROM Resultat WHERE resultatId = :id");
        $query->bindParam(':id', $resId);
        return $query->execute();
    }

    public function FindAllResultat() {
        $bd = Database::getConnection();
        $query = $bd->prepare("SELECT * FROM Resultat");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_CLASS, 'Resultat');
    }

    public function GetResultatById($resId) {
        $bd = Database::getConnection();
        $query = $bd->prepare("SELECT * FROM cours WHERE resultatId= :id");
        $query->bindParam(':id', $resId);
        $query->execute();
        return $query->fetchObject('Resultat');
    }

    public function FindResultsByEtudiantId($etudiantId) {
        $query = $this->bd->prepare("SELECT * FROM Resultat WHERE etudiantId = :etudiantId");
        $query->bindParam(':etudiantId', $etudiantId);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Resultat');
    }

}
