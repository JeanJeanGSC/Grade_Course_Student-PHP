<?php
require_once __DIR__ . '/../ServerConfig.php';
require_once __DIR__ . '/../DAO/ResultatDAO.php';

$bd = Database::getConnection();
$resultatDAO = new ResultatDAO($bd);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $etudiantId = intval($_POST['etudiantId']);
    $notes = $_POST['notes'];
    
    foreach ($notes as $resId => $newNote) {
        var_dump($resId, $newNote);
        $resultatDAO->ModifierResultat($resId, $newNote);
    }

    header("Location: detailsEtudiant.php?id=$etudiantId&message=update_reussie");
    exit();
}
?>
