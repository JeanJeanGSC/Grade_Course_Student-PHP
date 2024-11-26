<?php
require_once __DIR__ . '/../ServerConfig.php';
require_once __DIR__ . '/../DAO/EtudiantDAO.php';

$bd = Database::getConnection();
$etudiantDAO = new EtudiantDAO($bd);

if (isset($_GET['id'])) {
    $etudiantId = intval($_GET['id']);
    $suppressionReussie = $etudiantDAO->SupprimerEtudiant($etudiantId);
    
    if ($suppressionReussie) {
        echo "success"; // Réponse pour Ajax
    } else {
        echo "error"; // Réponse pour Ajax
    }
}
?>