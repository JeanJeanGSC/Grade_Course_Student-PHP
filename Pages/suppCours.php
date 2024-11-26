<?php
require_once __DIR__ . '/../ServerConfig.php';
require_once __DIR__ . '/../DAO/CoursDAO.php';

$bd = Database::getConnection();
$coursDAO = new CoursDAO($bd);

if (isset($_GET['id'])) {
    $coursId = intval($_GET['id']);
    $suppressionReussie = $coursDAO->SupprimerCours($coursId);
    
    if ($suppressionReussie) {
        echo "success";
    } else {
        echo "error";
    }
}
?>
