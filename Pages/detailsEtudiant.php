<?php
require_once __DIR__ . '/../ServerConfig.php'; // Inclusion de la configuration de la base de données
require_once __DIR__ . '/../DAO/EtudiantDAO.php';
require_once __DIR__ . '/../DAO/ResultatDAO.php';
require_once __DIR__ . '/../DAO/CoursDAO.php'; // Inclusion de la DAO pour récupérer les cours
// Initialisation des variables
$message = "";
$error = "";
$etudiant = null;

// Connexion à la base de données
$bd = Database::getConnection();
$etudiantDAO = new EtudiantDAO($bd);
$resultatDAO = new ResultatDAO($bd);
$coursDAO = new CoursDAO($bd); // Instancier la DAO des cours
// Récupérer l'ID de l'étudiant depuis l'URL
if (isset($_GET['id'])) {
    $etudiantId = intval($_GET['id']);
    // Récupérer les informations de l'étudiant
    $etudiant = $etudiantDAO->GetEtudiantById($etudiantId);

    // Récupérer les résultats de l'étudiant
    $resultats = $resultatDAO->FindResultsByEtudiantId($etudiantId);
} else {
    $error = "Erreur : ID de l'étudiant non spécifié.";
}
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Détails de l'Étudiant</title>
        <link rel="stylesheet" href="../CSS/detailsEtudiant.css">
        <link rel="stylesheet" href="../CSS/MenuEtFooter.css">
        <script src="../JS/menuContextuel.js" defer></script>
    </head>
    <body>

        <!-- Bouton SVG pour afficher le menu -->
        <img src="../images/menu.svg" class="menu-icon" width="40" height="40" alt="menu" onclick="afficherMenu()" />

        <!-- Menu déroulant caché -->
        <div class="dropdown-menu" id="menuDropdown">
            <a href="../index.html">Accueil</a>
            <a href="gesEtudiant.php">Gestion des Étudiants</a>
            <a href="gesCours.php">Gestion des Cours</a>
            <a href="gesResultat.php">Gestion des Résultats</a>
        </div>

        <h1>Détails de l'Étudiant</h1>

        <div class="container">
            <!-- Partie gauche : Informations de l'étudiant -->
            <div class="student-details">
                <?php if ($etudiant !== null): ?>
                    <h2>Informations de l'Étudiant</h2>
                    <p><strong>ID Étudiant :</strong> <?php echo htmlspecialchars($etudiant->etudiantId); ?></p>
                    <p><strong>Prénom :</strong> <?php echo htmlspecialchars($etudiant->prenom); ?></p>
                    <p><strong>Nom :</strong> <?php echo htmlspecialchars($etudiant->nom); ?></p>
                    <p><strong>Adresse :</strong> <?php echo htmlspecialchars($etudiant->adresse); ?></p>
                    <p><strong>Ville :</strong> <?php echo htmlspecialchars($etudiant->ville); ?></p>
                    <p><strong>Pays :</strong> <?php echo htmlspecialchars($etudiant->pays); ?></p>
                    <p><strong>Téléphone :</strong> <?php echo htmlspecialchars($etudiant->telephone); ?></p>
                    <p><strong>Domaine :</strong> <?php echo htmlspecialchars($etudiant->domaine); ?></p>
                <?php else: ?>
                    <p class="error"><?php echo $error; ?></p>
                <?php endif; ?>
            </div>

            <!-- Partie droite : Notes de cours -->
            <div class="student-grades">
                <h2>Notes de Cours</h2>
                <?php if (!empty($resultats)): ?>
                    <form method="POST" action="modifResultat.php">
                        <input type="hidden" name="etudiantId" value="<?php echo $etudiantId; ?>">
                        <ul class="course-list">
                            <?php foreach ($resultats as $resultat): ?>
                                <?php
                                // Récupère le nom du cours correspondant
                                $cours = $coursDAO->GetCoursById($resultat->coursId);
                                ?>
                                <li>
                                    <span><strong>Cours :</strong> <?php echo htmlspecialchars($cours->nom); ?></span>
                                    <span><strong>Session :</strong> <?php echo htmlspecialchars($resultat->session); ?></span>
                                    <span><strong>Note :</strong> 
                                        <input type="text" name="notes[<?php echo $resultat->resultatId; ?>]" value="<?php echo htmlspecialchars($resultat->note); ?>" placeholder="Entrez la note">
                                    </span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        <button type="submit" class="btn">Mettre à jour les notes</button>
                    </form>
                <?php else: ?>
                    <p>Aucune note trouvée pour cet étudiant.</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Pied de page -->
        <footer class="Signature">
            <h5>Tous droit réservé | site créé par Matthieu Haineault et Jean Couturier | Bisous, caresse & pop-corn au chocolat</h5>
        </footer>

    </body>
</html>
