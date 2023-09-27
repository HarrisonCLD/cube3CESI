// SCALE EFFECT FULL SCREEN

// Declaration de variables et mise en tableau des container pour une boucle
const svgFullScreen = document.querySelector('.top_content_planning svg');
const containerUser = [
    document.querySelector('.annonce_container'),
    document.querySelector('.planning_container'),
    document.querySelector('.cp_container'),
    document.querySelector('.heure_container')
];

const PlanningTableContent = document.querySelector('.planning_table');

let PlanningFullscreen = false;

svgFullScreen.addEventListener('click', () => {
    svgFullScreen.classList.toggle('active') // toggle class CSS
    setTimeout(() => {
        fullScreenContainer.appendChild(PlanningTableContent);
        fullScreenContainer.style.display = "flex"
        PlanningTableContent.classList.add('fullscreen_table')
        PlanningFullscreen = true;
    }, 300)
})

// BUTTON "DEMANDE CP" EFFECT

const buttonCP = document.querySelector('.cp_container button')

buttonCP.addEventListener('click', () => {
    buttonCP.classList.toggle('active_button') // toggle class CSS
})

// ANNONCES EFFECT LI

// DECLARATION VARIABLES
const annoncesUl = document.querySelectorAll('.annonce_content ul');

const fullScreenContainer = document.querySelector('.full_screen_container');
const annonceContent = document.querySelector('.annonce_content');
const closeButton = document.querySelector('.closeButton');

//

// BOUCLE POUR CREER UN EVENT CLICK SUR CHAQUE UL DE ANNONCE_CONTENT

let AnnoncesFullScreen = false;

for (let i = 0; i < annoncesUl.length; i++) {
    annoncesUl[i].addEventListener('click', () => {
        fullScreenContainer.appendChild(annoncesUl[i]); // UL -> Div en Fullscreen display none
        fullScreenContainer.style.display = "block"; //  Full screen display none -> display block
        AnnoncesFullScreen = true;
    });
}

// Condition de if pour vérifier que closeButton est bien existant et eviter un conflit

if (closeButton) {
    closeButton.addEventListener('click', () => {
        if (AnnoncesFullScreen == true) {
            const FullScreenUl = document.querySelector('.full_screen_container ul');
            annonceContent.appendChild(FullScreenUl);
            fullScreenContainer.style.display = 'none'; // Chemin inverse de l'ul fullscreen à annonce_content
            AnnoncesFullScreen = false;
            const tab_annoncesUl = Array.from(annoncesUl); // Node List à création d'un tableau 
            tab_annoncesUl.sort((a, b) => {
                const textA = a.textContent.toLowerCase();
                const textB = b.textContent.toLowerCase();
                return textA.localeCompare(textB); // tri du tableau des ul 
            });
            annonceContent.innerHTML = ''; // tableau trier réinjecter dans le DOM pour avoir les ul dans le bon ordre
            tab_annoncesUl.forEach((ulElement) => {
                annonceContent.appendChild(ulElement);
            });

        } else if (PlanningFullscreen == true) {
            const FullScreenPlannning = document.querySelector('.planning_content');
            FullScreenPlannning.appendChild(PlanningTableContent);
            fullScreenContainer.style.display = 'none'
            PlanningTableContent.classList.remove('fullscreen_table')
            PlanningFullscreen = false;
        }
    });
}
//

