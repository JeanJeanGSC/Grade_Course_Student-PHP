<?php
require_once __DIR__ . '/../ServerConfig.php'; // Inclusion de la configuration de la base de données
require_once __DIR__ . '/../DAO/CoursDAO.php';  // Inclusion de la DAO
// Initialisation des variables
$message = "";
$error = "";
$cours = null;

// Connexion à la base de données
$bd = Database::getConnection();
$coursDAO = new CoursDAO($bd);

// Récupérer l'ID du cours depuis l'URL
if (isset($_GET['id'])) {
    $coursId = intval($_GET['id']);
    // Récupérer les informations de l'étudiant correspondant
    $cours = $coursDAO->GetCoursById($coursId);

    if ($cours === false) {
        $error = "Erreur : Cours non trouvé.";
    }  
}

// Si le formulaire est soumis pour modification
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $coursId = htmlspecialchars(trim($_POST['coursId']));
    $nom = htmlspecialchars(trim($_POST['nom']));
    $nombre_credits = htmlspecialchars(trim($_POST['nombre_credits']));

    // Vérification des champs obligatoires
    if (!empty($nom) && !empty($nombre_credits)) {
        // Appel de la méthode de modification dans la DAO
        $modificationReussie = $coursDAO->ModifierCours($coursId, $nom, $nombre_credits);

        if ($modificationReussie) {
            $message = "Le cours a été modifié avec succès!";
            $cours->coursId = $coursId;
            $cours->nom = $nom;
            $cours->nombre_credits = $nombre_credits;
        } else {
            $error = "Erreur lors de la modification du cours. Veuillez réessayer.";
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
        <title>Modifier un Cours</title>
        <link rel="stylesheet" href="../CSS/ajout.css">
        <link rel="stylesheet" href="../CSS/MenuEtFooter.css">
        <script src="../JS/menuContextuel.js" defer></script>

    </head>
    <body>

        <!-- Bouton image pour afficher le menu -->
        <img src="../images/menu.svg" class="menu-icon" width="40" height="40" alt="menu" onclick="afficherMenu()" />

        <!-- Menu déroulant caché -->
        <div class="dropdown-menu" id="menuDropdown">
            <a href="../index.html">Accueil</a>
            <a href="gesEtudiant.php">Gestion des Étudiants</a>
            <a href="gesCours.php">Gestion des Cours</a>
            <a href="gesResultat.php">Gestion des Résultats</a>
        </div>

        <h1>Modifier un Cours</h1>

        <?php if ($cours !== null): ?>
            <form method="POST" action="">
   
                <input type="text" name="coursId" class="textbox" placeholder="ID" value="<?php echo htmlspecialchars($cours->coursId); ?>" readonly>

                <!-- ID du cours en readonly -->
                <input type="text" name="nom" class="textbox" placeholder="Nom" value="<?php echo htmlspecialchars($cours->nom); ?>" required>
                <input type="text" name="nombre_credits" class="textbox" placeholder="Nombre de Crédits" value="<?php echo htmlspecialchars($cours->nombre_credits); ?>" required>

                <div class="button-container">
                    <button type="submit" class="btn">Modifier</button>
                    <button type="reset" class="btn reset-btn">Réinitialiser</button>
                </div>
            </form>
        <?php else: ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>

        <?php if (!empty($message)): ?>
            <p class="message"><?php echo $message; ?></p>
        <?php elseif (!empty($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>

        <!-- Pied de page -->
        <footer class="Signature"> 
            <h5>Tous droit réservé | site créé par Matthieu Haineault et Jean Couturier | Bisous, caresse & pop-corn au chocolat</h5>
        </footer>

    </body>
</html>