// Tableau des images de fond
const images = [
    './images/imgHome1.jpg',
    './images/imgHome2.jpg',
    './images/imgHome3.jpg',
    './images/imgHome4.jpg'
];

// Sélection de l'élément à modifier
const homeElement = document.querySelector('.Home');
let imgIndex = 0;

// Fonction pour changer l'image de fond
function changeBackground() {
    // Changer l'image de fond
    homeElement.style.backgroundImage = `url(${images[imgIndex]})`;
    
    // Passer à l'image suivante
    imgIndex = (imgIndex + 1) % images.length;
}

// Déclencher le changement toutes les 5 secondes
setInterval(changeBackground, 8000);

// Déclencher le premier changement immédiatement
changeBackground();