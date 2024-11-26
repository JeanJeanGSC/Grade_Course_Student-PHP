<?php
require_once __DIR__ . '/../ServerConfig.php'; // Inclusion de la configuration de la base de données
require_once __DIR__ . '/../DAO/EtudiantDAO.php';  // Inclusion de la DAO
// Connexion à la base de données
$bd = Database::getConnection();
$etudiantDAO = new EtudiantDAO($bd);

// Récupère la liste des étudiants
$etudiants = $etudiantDAO->FindAllEtudiants();

//var_dump($etudiants);
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="../CSS/listes.css">
        <link rel="stylesheet" href="../CSS/MenuEtFooter.css">
        <script src="../JS/menuContextuel.js" defer></script>
        <script src="../JS/suppObjet.js" defer></script>

        <title>Liste des Étudiants</title>
    </head>
    <body>

        <!-- Bouton SVG pour afficher le menu -->
        <img src="../images/menu.svg" class="menu-icon" width="40" height="40" alt="menu" onclick="afficherMenu()" />

        <!-- Menu déroulant caché -->
        <div class="dropdown-menu" id="menuDropdown">
            <a href="../index.html">Acceuil</a>
            <a href="gesCours.php">Gestion des Cours</a>
            <a href="gesResultat.php">Gestion des Résultats</a>
        </div>

        <h1>Liste des Étudiants</h1>
        <a class="create-button" href="ajoutEtudiant.php">Créer un Nouvel Étudiant</a>

        <table>
            <thead>
                <tr>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Ville</th>
                    <th>Domaine</th>
                    <th class="action-links">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Affiche chaque étudiant récupéré de la base de données
                foreach ($etudiants as $etudiant) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($etudiant->prenom) . "</td>";
                    echo "<td>" . htmlspecialchars($etudiant->nom) . "</td>";
                    echo "<td>" . htmlspecialchars($etudiant->ville) . "</td>";
                    echo "<td>" . htmlspecialchars($etudiant->domaine) . "</td>";
                    echo "<td class='action-links'>
                        <a href='modifEtudiant.php?id=" . $etudiant->etudiantId . "'>Modifier</a>
                        <a href='detailsEtudiant.php?id=" . $etudiant->etudiantId . "'>Details</a>
                        <a href='#' onclick='suppObjet(" . $etudiant->etudiantId . ")'>Supprimer</a>
                    </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <footer class="Signature"> 
            <h5>Tous droit réservé | site créé par Matthieu Haineault et Jean Couturier | Bisous, caresse & pop-corn au chocolat</h5>
        </footer>
    </body>
</html>
