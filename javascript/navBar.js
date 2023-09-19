const tab_SVG_DarkNLight = [
    document.querySelector('.sunSVG'),
    document.querySelector('.moonSVG')
];

const h3All = document.querySelectorAll('h3')
const pAll = document.querySelectorAll('p')
const liAll = document.querySelectorAll('li')
const svgAll = document.querySelectorAll('svg')
const separationBar = document.querySelectorAll('.separation_bar')
const liAfter = document.querySelectorAll('li::after')

function DarkMod() {
    const body = document.querySelector('body');
    const Dashboard = document.querySelector('.dashBoard_user');
    const LastOverlay = [
        document.querySelector('.annonce_container'),
        document.querySelector('.planning_container'),
        document.querySelector('.cp_container'),
        document.querySelector('.heure_container')
    ];

    //body z index 0
    body.style.zIndex = '0';
    body.style.position = 'relative'

    //overlay_1 z index 1
    const Overlay_1 = document.createElement('div')
    Overlay_1.classList.add('overlay_1')
    body.appendChild(Overlay_1)

    //dashboard z index 2
    Dashboard.style.zIndex = '2';
    Dashboard.style.postion = 'relative'

    //overlay_2 z index 3
    const Overlay_2 = document.createElement('div')
    Overlay_2.classList.add('overlay_2')
    Dashboard.appendChild(Overlay_2)

    //tab z index 4
    for (let i = 0; i < LastOverlay.length; i++) {
        LastOverlay[i].style.zIndex = '4';
        LastOverlay[i].style.position = 'relative'
        LastOverlay[i].style.border = '0.5px solid white'
        const Overlay_3 = document.createElement('div')
        Overlay_3.classList.add('overlay_3')
        LastOverlay[i].appendChild(Overlay_3)
    }

    //Boucle H3 color white
    for (let i = 0; i < h3All.length; i++) {
        h3All[i].style.color = 'white'
        h3All[i].style.zIndex = '6'
        h3All[i].style.position = 'relative'
    }

    for (let i = 0; i < pAll.length; i++) {
        pAll[i].style.color = 'white'
        pAll[i].style.zIndex = '6'
        pAll[i].style.position = 'relative'
    }
    for (let i = 0; i < liAll.length; i++) {
        liAll[i].style.color = 'white'
        liAll[i].style.zIndex = '6'
        liAll[i].style.position = 'relative'
    }
    for (let i = 0; i < svgAll.length; i++) {
        svgAll[i].style.color = 'white'
        svgAll[i].style.zIndex = '6'
        svgAll[i].style.position = 'relative'
    }
    for (let i = 0; i < separationBar.length; i++) {
        separationBar[i].style.backgroundColor = 'white'
        separationBar[i].style.zIndex = '6'
        separationBar[i].style.position = 'relative'
    }
    for (let i = 0; i < liAfter.length; i++) {
        liAfter[i].style.backgroundColor = 'white'
        liAfter[i].style.zIndex = '6'
        liAfter[i].style.position = 'relative'
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
            }, 400)
            setTimeout(() => {
                tab_SVG_DarkNLight[1].classList.remove('active2SVG')
            }, 600);
            DarkMod();
        } else {
            tab_SVG_DarkNLight[1].classList.add('active2SVG');
            setTimeout(() => {
                tab_SVG_DarkNLight[1].style.display = 'none'
            }, 200)
            setTimeout(() => {
                tab_SVG_DarkNLight[0].style.display = 'block';
            }, 400)
            setTimeout(() => {
                tab_SVG_DarkNLight[0].classList.add('active1SVG')
            }, 600);
            DarkMod();
        }
    })
}

