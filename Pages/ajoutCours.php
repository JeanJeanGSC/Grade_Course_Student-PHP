<?php
require_once __DIR__ . '/../ServerConfig.php'; // Inclusion de la configuration de la base de données
require_once __DIR__ . '/../DAO/CoursDAO.php';  // Inclusion de la DAO
// Initialisation des variables pour stocker les messages d'erreur et de confirmation
$message = "";
$error = "";

// Si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bd = Database::getConnection();
    $coursDAO = new CoursDAO($bd);

    // Récupération des champs du formulaire avec sécurité
    $nom = htmlspecialchars(trim($_POST['nom']));
    $nombre_credits = htmlspecialchars(trim($_POST['nombre_credits']));

    // Vérification des champs obligatoires
    if (!empty($nom) && !empty($nombre_credits)) {
        // Créer un nouvel objet Cours
        $cours = new Cours();
        $cours->nom = $nom;
        $cours->nombre_credits = $nombre_credits;

        // Appel de la méthode d'ajout dans la DAO
        $ajoutReussi = $coursDAO->AjouterCours($cours);

        if ($ajoutReussi) {
            $message = "Le cours a été ajouté avec succès !";
        } else {
            $error = "Erreur lors de l'ajout du cours. Veuillez réessayer.";
        }
    } else {
        $error = "Tous les champs sont requis.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ajouter un Cours</title>

        <link rel="stylesheet" href="../CSS/ajout.css">
        <link rel="stylesheet" href="../CSS/MenuEtFooter.css">
        <script src="../JS/menuContextuel.js" defer></script>
    </head>
    <body>

        <img src="../images/menu.svg" class="menu-icon" width="40" height="40" alt="menu" onclick="afficherMenu()" />

        <!-- Menu déroulant caché -->
        <div class="dropdown-menu" id="menuDropdown">
            <a href="../index.html">Acceuil</a>
            <a href="gesEtudiant.php">Gestion des Étudiants</a>
            <a href="gesCours.php">Gestion des Cours</a>
            <a href="gesResultat.php">Gestion des Résultats</a>
        </div>

        <h1>Ajouter un Nouvel Étudiant</h1>

        <form method="POST" action="">
            <input type="text" name="nom" class="textbox" placeholder="Nom" required>
            <input type="text" name="nombre_credits" class="textbox" placeholder="Credits" required>

            <div class="button-container">
                <button type="submit" class="btn">Valider</button>
                <button type="reset" class="btn reset-btn">Réinitialiser</button>
            </div>

            <?php if (!empty($message)): ?>
                <p class="message"><?php echo $message; ?></p>
            <?php elseif (!empty($error)): ?>
                <p class="error"><?php echo $error; ?></p>
            <?php endif; ?>
        </form>

        <footer class="Signature"> 
            <h5>Tous droit réservé | site créé par Matthieu Haineault et Jean Couturier | Bisous, caresse & pop-corn au chocolat</h5>
        </footer>

    </body>
</html>
