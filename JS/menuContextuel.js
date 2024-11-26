// Fonction pour afficher / masquer le menu
function afficherMenu() {
    var menu = document.getElementById("menuDropdown");
    if (menu.style.display === "block") {
        menu.style.display = "none";
    } else {
        menu.style.display = "block";
    }
}

// Ferme le menu si on clique à l'extérieur
window.onclick = function (event) {
    if (!event.target.matches('.menu-icon')) {
        var menu = document.getElementById("menuDropdown");
        if (menu.style.display === "block") {
            menu.style.display = "none";
        }
    }
}