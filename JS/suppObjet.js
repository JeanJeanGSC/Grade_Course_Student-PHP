function suppObjet(etudiantId) {
    if (confirm("Voulez-vous vraiment supprimer cet étudiant ?")) {
        // Envoyer la requête de suppression via Ajax
        fetch(`suppEtudiant.php?id=${etudiantId}`, {
            method: 'GET'
        }).then(response => response.text()).then(data => {
            // Afficher un pop-up de confirmation après la suppression
            alert("L'étudiant a été supprimé avec succès !");
            
            // Recharger la liste des étudiants ou supprimer la ligne correspondante
            location.reload(); // Recharge la page pour mettre à jour la liste
        }).catch(error => {
            console.error("Erreur lors de la suppression :", error);
            alert("Erreur lors de la suppression. Veuillez réessayer.");
        });
    }
}
