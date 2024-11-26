<?php
require_once __DIR__ . '/../ServerConfig.php'; // Inclusion de la configuration de la base de données
require_once __DIR__ . '/../DAO/EtudiantDAO.php';  // Inclusion de la DAO
// Initialisation des variables pour stocker les messages d'erreur et de confirmation
$message = "";
$error = "";

// Si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bd = Database::getConnection();
    $etudiantDAO = new EtudiantDAO($bd);

    // Récupération des champs du formulaire avec sécurité
    $prenom = htmlspecialchars(trim($_POST['prenom']));
    $nom = htmlspecialchars(trim($_POST['nom']));
    $adresse = htmlspecialchars(trim($_POST['adresse']));
    $ville = htmlspecialchars(trim($_POST['ville']));
    $pays = htmlspecialchars(trim($_POST['pays']));
    $telephone = htmlspecialchars(trim($_POST['telephone']));
    $domaine = htmlspecialchars(trim($_POST['domaine']));

    // Vérification des champs obligatoires
    if (!empty($prenom) && !empty($nom) && !empty($adresse) && !empty($ville) && !empty($pays) && !empty($telephone) && !empty($domaine)) {
        // Appel de la méthode d'ajout dans la DAO
        $ajoutReussi = $etudiantDAO->AjouterEtudiant($prenom, $nom, $adresse,
                $ville, $pays, $telephone, $domaine);

        if ($ajoutReussi) {
            $message = "L'étudiant a été ajouté avec succès !";
        } else {
            $error = "Erreur lors de l'ajout de l'étudiant. Veuillez réessayer.";
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
        <title>Ajouter un Étudiant</title>

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
            <input type="text" name="prenom" class="textbox" placeholder="Prénom" required>
            <input type="text" name="nom" class="textbox" placeholder="Nom" required>
            <input type="text" name="adresse" class="textbox" placeholder="Adresse" required>
            <input type="text" name="ville" class="textbox" placeholder="Ville" required>
            <input type="text" name="pays" class="textbox" placeholder="Pays" required>
            <input type="text" name="telephone" class="textbox" placeholder="Téléphone" required>
            <input type="text" name="domaine" class="textbox" placeholder="Domaine" required>

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
