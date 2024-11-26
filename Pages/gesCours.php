<?php
require_once __DIR__ . '/../ServerConfig.php'; // Inclusion de la configuration de la base de données
require_once __DIR__ . '/../DAO/CoursDAO.php';  // Inclusion de la DAO
// Connexion à la base de données
$bd = Database::getConnection();
$CoursDAO = new CoursDAO($bd);

// Récupère la liste des Resultat
$cours = $CoursDAO->FindAllCours();
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">        
        <link rel="stylesheet" href="../CSS/listes.css">
        <link rel="stylesheet" href="../CSS/MenuEtFooter.css">
        <script src="../JS/menuContextuel.js" defer></script>
        <script src="../JS/suppCours.js" defer></script>

       
        <title>Liste des cours</title>
    </head>
    <body>

        <!-- Bouton SVG pour afficher le menu -->
        <img src="../images/menu.svg" class="menu-icon" width="40" height="40" alt="menu" onclick="afficherMenu()" />

        <!-- Menu déroulant caché -->
        <div class="dropdown-menu" id="menuDropdown">
            <a href="../index.html">Acceuil</a>
            <a href="gesEtudiant.php">Gestion des Étudiants</a>
            <a href="gesResultat.php">Gestion des Résultats</a>
        </div>

        <h1>Liste des Cours</h1>
        <a class="create-button" href="ajoutCours.php">Créer un Nouveau cours</a>

        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Nombre de crédit</th>
                    <th class="action-links">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Affiche chaque cours récupéré de la base de données
                foreach ($cours as $c) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($c->nom) . "</td>";
                    echo "<td>" . htmlspecialchars($c->nombre_credits) . "</td>";
                    

                    echo "<td class='action-links'>
                    <a href='modifCours.php?id=" . $c->coursId ."'>Edit</a>
                    <a href='#' onclick='suppCours(" . $c->coursId . ")'>Supprimer</a>
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
