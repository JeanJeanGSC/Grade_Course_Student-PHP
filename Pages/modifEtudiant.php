<?php
require_once __DIR__ . '/../ServerConfig.php'; // Inclusion de la configuration de la base de données
require_once __DIR__ . '/../DAO/EtudiantDAO.php';  // Inclusion de la DAO
// Initialisation des variables
$message = "";
$error = "";
$etudiant = null;

// Connexion à la base de données
$bd = Database::getConnection();
$etudiantDAO = new EtudiantDAO($bd);

// Récupérer l'ID de l'étudiant depuis l'URL
if (isset($_GET['id'])) {
    $etudiantId = intval($_GET['id']);
    // Récupérer les informations de l'étudiant correspondant
    $etudiant = $etudiantDAO->GetEtudiantById($etudiantId);

    if ($etudiant === false) {
        $error = "Erreur : Étudiant non trouvé.";
    }

//    var_dump($etudiant);
}

// Si le formulaire est soumis pour modification
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $etudiantId = htmlspecialchars(trim($_POST['etudiantId']));
    $prenom = htmlspecialchars(trim($_POST['prenom']));
    $nom = htmlspecialchars(trim($_POST['nom']));
    $adresse = htmlspecialchars(trim($_POST['adresse']));
    $ville = htmlspecialchars(trim($_POST['ville']));
    $pays = htmlspecialchars(trim($_POST['pays']));
    $telephone = htmlspecialchars(trim($_POST['telephone']));
    $domaine = htmlspecialchars(trim($_POST['domaine']));

    // Vérification des champs obligatoires
    if (!empty($prenom) && !empty($nom) && !empty($adresse) && !empty($ville) && !empty($pays) && !empty($telephone) && !empty($domaine)) {
        // Appel de la méthode de modification dans la DAO
        $modificationReussie = $etudiantDAO->ModifierEtudiant($etudiantId, $prenom, $nom, $adresse,
                $ville, $pays, $telephone, $domaine);

        if ($modificationReussie) {
            $message = "L'étudiant a été modifié avec succès!";
            $etudiant->prenom = $prenom;
            $etudiant->nom = $nom;
            $etudiant->adresse = $adresse;
            $etudiant->ville = $ville;
            $etudiant->pays = $pays;
            $etudiant->telephone = $telephone;
            $etudiant->domaine = $domaine;
        } else {
            $error = "Erreur lors de la modification de l'étudiant. Veuillez réessayer.";
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
        <title>Modifier un Étudiant</title>
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

        <h1>Modifier un Étudiant</h1>

        <?php if ($etudiant !== null): ?>
            <form method="POST" action="">
                <!-- ID de l'étudiant en readonly -->
                <input type="text" name="etudiantId" class="textbox" placeholder="ID Étudiant" value="<?php echo htmlspecialchars($etudiant->etudiantId); ?>" readonly>
                <input type="text" name="prenom" class="textbox" placeholder="Prénom" value="<?php echo htmlspecialchars($etudiant->prenom); ?>" required>
                <input type="text" name="nom" class="textbox" placeholder="Nom" value="<?php echo htmlspecialchars($etudiant->nom); ?>" required>
                <input type="text" name="adresse" class="textbox" placeholder="Adresse" value="<?php echo htmlspecialchars($etudiant->adresse); ?>" required>
                <input type="text" name="ville" class="textbox" placeholder="Ville" value="<?php echo htmlspecialchars($etudiant->ville); ?>" required>
                <input type="text" name="pays" class="textbox" placeholder="Pays" value="<?php echo htmlspecialchars($etudiant->pays); ?>" required>
                <input type="text" name="telephone" class="textbox" placeholder="Téléphone" value="<?php echo htmlspecialchars($etudiant->telephone); ?>" required>
                <input type="text" name="domaine" class="textbox" placeholder="Domaine" value="<?php echo htmlspecialchars($etudiant->domaine); ?>" required>

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