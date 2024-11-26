function suppCours(coursId) {
    if (confirm("Êtes-vous sûr de vouloir supprimer ce cours ?")) {
        fetch(`suppCours.php?id=${coursId}`, {
            method: 'GET',
        })
        .then(response => response.text())
        .then(data => {
            if (data.trim() === "success") {
                alert("Cours supprimé avec succès");
                setTimeout(() => {
                    window.location.href = "gesCours.php";
                }, 1000); 
            } else {
                alert("Erreur lors de la suppression du cours");
            }
        })
        .catch(error => {
            console.error("Erreur:", error);
            alert("Une erreur s'est produite.");
        });
    }
}
