// VARIABLES SWITCH PAGE
linkSwitch = [
    document.querySelector('.link_switch_1'),
    document.querySelector('.link_switch_2')
];

ComponantsLogin = [
    document.querySelector('.registrer_container'),
    document.querySelector('.login_container')
];
//

// EVENT CLICK linkSwitch

for (let i = 0; i < linkSwitch.length; i++) {
    linkSwitch[i].addEventListener('click', ToggleFormLog)
}

//

// FUNCTION TOGGLE
function ToggleFormLog() {
    if (this === linkSwitch[0]) {
        ComponantsLogin[0].style.display = 'none'
        ComponantsLogin[1].style.display = 'flex'
    } else if (this === linkSwitch[1]) {
        ComponantsLogin[0].style.display = 'flex'
        ComponantsLogin[1].style.display = 'none'
    }
}

//