const tab_SVG_DarkNLight = [
    document.querySelector('.sunSVG'),
    document.querySelector('.moonSVG')
];

const h3All = document.querySelectorAll('h3')
const pAll = document.querySelectorAll('p')
const liAll = document.querySelectorAll('li')
const svgAll = document.querySelectorAll('svg')
const separationBar = document.querySelectorAll('.separation_bar')
const tdAll = document.querySelectorAll('td')
const thAll = document.querySelectorAll('th')
const labelAll = document.querySelectorAll('label')
const inputAll = document.querySelectorAll('input')
const h4All = document.querySelectorAll('h4')
const AProfilContainer = document.querySelectorAll('.profil_options_content a')

const Tab_Overlay = []

function DarkMod() {
    const body = document.querySelector('body');
    const Dashboard = document.querySelector('.dashBoard_user');
    const LastOverlay = [
        document.querySelector('.annonce_container'),
        document.querySelector('.planning_container'),
        document.querySelector('.cp_container'),
        document.querySelector('.heure_container'),
        document.querySelector('.profil_options_content')
    ];

    let Overlay_1_created = false
    let Overlay_2_created = false

    const ulAnnonceContent = document.querySelectorAll('.annonce_content ul')
    const liAnnonceContent = document.querySelectorAll('.annonce_content ul li')
    //body z index 0
    body.classList.toggle('dark_theme_for_body')

    //overlay_1 z index 1
    if (!Overlay_1_created) {
        const Overlay_1 = document.createElement('div')
        Overlay_1.classList.add('overlay_1')
        body.appendChild(Overlay_1)
        Tab_Overlay.push(Overlay_1)
        Overlay_1_created = true
    }

    //tab z index 4
    for (let i = 0; i < LastOverlay.length; i++) {
        LastOverlay[i].classList.toggle('dark_theme_for_container')
        if (!Overlay_2_created) {
            const Overlay_2 = document.createElement('div')
            Overlay_2.classList.add('overlay_2')
            Tab_Overlay.push(Overlay_2)
            LastOverlay[i].appendChild(Overlay_2)
        }
    }
    Overlay_2_created = true

    const Profil_container = document.querySelector('.profil_options_content')
    Profil_container.classList.remove('dark_theme_for_container')
    Profil_container.classList.toggle('.dark_theme_for_profil_container')


    //Boucle H3 color white
    for (let i = 0; i < h3All.length; i++) {
        h3All[i].classList.toggle('dark_theme_for_content')
    }
    for (let i = 0; i < pAll.length; i++) {
        pAll[i].classList.toggle('dark_theme_for_content')
    }
    for (let i = 0; i < liAll.length; i++) {
        liAll[i].classList.toggle('dark_theme_for_content')
    }
    for (let i = 0; i < svgAll.length; i++) {
        svgAll[i].classList.toggle('dark_theme_for_content')
    }
    for (let i = 0; i < separationBar.length; i++) {
        separationBar[i].classList.toggle('dark_theme_for_separation')
    }
    for (let i = 0; i < tdAll.length; i++) {
        tdAll[i].classList.toggle(('dark_theme_for_th_and_td'))
    }
    for (let i = 0; i < thAll.length; i++) {
        thAll[i].classList.toggle(('dark_theme_for_th_and_td'))
    }
    for (let i = 0; i < labelAll.length; i++) {
        labelAll[i].classList.toggle(('dark_theme_for_content'))
    }
    for (let i = 0; i < inputAll.length; i++) {
        inputAll[i].classList.toggle(('dark_theme_for_input'))
    }
    for (let i = 0; i < h4All.length; i++) {
        h4All[i].classList.toggle(('dark_theme_for_content'))
    }
    for (let i = 0; i < AProfilContainer.length; i++) {
        AProfilContainer[i].classList.toggle(('dark_theme_for_profil_a'))
    }
    for (let i = 0; i < ulAnnonceContent.length; i++) {
        ulAnnonceContent[i].addEventListener('mouseover', (e) => {
            ulAnnonceContent[i].classList.add('dark_theme_for_annonce_ul_1')
            for (let k = 0; k < h4All.length; k++) {
                h4All[k].classList.add('dark_theme_for_')
            }
        })
        ulAnnonceContent[i].addEventListener('mouseout', () => {
            ulAnnonceContent[i].classList.remove('dark_theme_for_annonce_ul_1')
            // for (let k = 0; k < h4All.length; k++) {
            //     h4All[k].classList.remove('dark_theme_for_annonce_li')
            // }
        })
    }
}

for (let i = 0; i < tab_SVG_DarkNLight.length; i++) {
    tab_SVG_DarkNLight[i].addEventListener('click', () => {

        if (tab_SVG_DarkNLight[0].classList.contains('active1SVG') && tab_SVG_DarkNLight[1].classList.contains('active2SVG')) {

            tab_SVG_DarkNLight[0].classList.remove('active1SVG');
            setTimeout(() => {
                tab_SVG_DarkNLight[0].style.display = 'none'
            }, 200)
            setTimeout(() => {
                tab_SVG_DarkNLight[1].style.display = 'block';
            }, 300)
            setTimeout(() => {
                tab_SVG_DarkNLight[1].classList.remove('active2SVG')
            }, 400);
            DarkMod();
            for (let i = 0; i < Tab_Overlay.length; i++) {
                Tab_Overlay[i].remove()
            }

        } else {
            tab_SVG_DarkNLight[1].classList.add('active2SVG');
            setTimeout(() => {
                tab_SVG_DarkNLight[1].style.display = 'none'
            }, 200)
            setTimeout(() => {
                tab_SVG_DarkNLight[0].style.display = 'block';
            }, 300)
            setTimeout(() => {
                tab_SVG_DarkNLight[0].classList.add('active1SVG')
            }, 400);
            DarkMod();
        }
    })
}

const ContentOptionsOff = document.querySelector('.profil_options');
const ContentOptionsOn = document.querySelector('.profil_options_content');

const SVGProfil = document.querySelector('.profil_options svg');

ContentOptionsOff.addEventListener('click', () => {
    SVGProfil.classList.toggle('active_profil_effect');
    ContentOptionsOn.classList.toggle('active_options');
})