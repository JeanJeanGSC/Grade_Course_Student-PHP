<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <link rel="stylesheet" href="../CSS/listes.css">
        <link rel="stylesheet" href="../CSS/MenuEtFooter.css">
        <script src="../JS/menuContextuel.js" defer></script>
        
        <title>Sorry</title>
        
        <style>
            .sorry{
                display: flex;
                margin: 5%;
                height: 60%;
                width: 80%;
                justify-content: center;
                font-size: 2.4rem;
                font-weight: 600;
            }
        </style>
    </head>
    <body>

        <!-- Bouton SVG pour afficher le menu -->
        <img src="../images/menu.svg" class="menu-icon" width="40" height="40" alt="menu" onclick="afficherMenu()" />

        <div class="sorry">
            <p>Sorry, mais une fois minuit passé j'ai give up. Surtout apres avoir fait tous le reste en 24h avec Matt</p>
        </div>
        
        <!-- Menu déroulant caché -->
        <div class="dropdown-menu" id="menuDropdown">
            <a href="../index.html">Acceuil</a>
            <a href="gesEtudiant.php">Gestion des Étudiants</a>
            <a href="gesCours.php">Gestion des Cours</a>
        </div>

        
        <footer class="Signature"> 
            <h5>Tous droit réservé | site créé par Matthieu Haineault et Jean Couturier | Bisous, caresse & pop-corn au chocolat</h5>
        </footer>
    </body>
</html>
