// Funciton JS mail interne

// Fichier export de function
function FullScreenContainer(child, parent, LiNode) {
    const body = document.querySelector('body')

    const ContainerFullScreen = document.createElement('div')
    ContainerFullScreen.classList.add('ContainerFullScreen')
    const closeButton = document.createElement('div')
    closeButton.classList.add('closeButton')

    body.appendChild(ContainerFullScreen)
    ContainerFullScreen.appendChild(closeButton)
    ContainerFullScreen.appendChild(child)
    closeButton.addEventListener('click', () => {
        parent.appendChild(child) 
        ContainerFullScreen.remove()
        TriTableauMail(LiNode, parent);
    })
}

function TriTableauMail(ContenuContainerBase, ParentDeBase) {
    const Tab_ContenuContainerBase = Array.from(ContenuContainerBase)
    Tab_ContenuContainerBase.sort((a,b) => {
    const textA = a.textContent.toLowerCase();
    const textB = b.textContent.toLowerCase();

    return textA.localeCompare(textB);
    })
    ParentDeBase.innerHTML = '';
    Tab_ContenuContainerBase.forEach((element) => {
        ParentDeBase.appendChild(element);
    });
}

// FIN Function création fullscreen et switch <li>

const MailContainer = document.querySelector('.mail_container ul');
const ListMail = document.querySelectorAll('.mail_container ul li')
const MailContent = document.querySelectorAll('.mailStyle');
const body = document.querySelector('body')

for (let i = 0; i < MailContent.length; i++) {
    MailContent[i].addEventListener('click', () => {
        FullScreenContainer(MailContent[i], MailContainer);
            });
}

const OpenMailButton = document.querySelector('.top_mail_container a')

OpenMailButton.addEventListener('click', () => {
    const body = document.querySelector('body')

    const ContainerFullScreen = document.createElement('div')
    ContainerFullScreen.classList.add('ContainerFullScreen')
    const closeButton = document.createElement('div')
    closeButton.classList.add('closeButton')

    //Création formulaire send mail
    const formMailSend = document.createElement('div')
    formMailSend.classList.add('write_mail_container')
    const Container1MailFullScreen = document.createElement('div')
    Container1MailFullScreen.classList.add('Container1MailFull')
    const Label1Adresse = document.createElement('label')
    Label1Adresse.classList.add('adresse_send')
    Label1Adresse.innerHTML = 'À'
    const Input1Adresse = document.createElement('input')
    Input1Adresse.classList.add('input_for_adresse')

    const Container2MailFullScreen = document.createElement('div')
    Container2MailFullScreen.classList.add('Container2MailFull')
    const Label2Object = document.createElement('label')
    Label2Object.classList.add('object_send')
    Label2Object.innerHTML = "Objet :"
    const Input2Object = document.createElement('input')
    Input2Object.classList.add('input_for_object_send')

    const Container3MailFullScreen = document.createElement('div')
    Container3MailFullScreen.classList.add('Container3MailFull')
    const Label3Contenu = document.createElement('label')
    Label3Contenu.innerHTML = "Contenu du mail :"
    Label3Contenu.classList.add('contenu_send')
    const Input3Contenu = document.createElement('input')
    Input3Contenu.classList.add('input_for_contenu_mail')

    const ButtonForMailSend = document.createElement('button')
    ButtonForMailSend.classList.add('buttonForMailSend')

    body.appendChild(ContainerFullScreen)
    ContainerFullScreen.appendChild(formMailSend)
    // Part 1 Container mail fullscreen
    formMailSend.appendChild(Container1MailFullScreen)
    Container1MailFullScreen.appendChild(Label1Adresse)
    Container1MailFullScreen.appendChild(Input1Adresse)
    // Part 2 Container mail fullscreen
    formMailSend.appendChild(Container2MailFullScreen)
    Container2MailFullScreen.appendChild(Label2Object)
    Container2MailFullScreen.appendChild(Input2Object)
    // Part 3 Container mail fullscreen
    formMailSend.appendChild(Container3MailFullScreen)
    Container3MailFullScreen.appendChild(Label3Contenu)
    Container3MailFullScreen.appendChild(Input3Contenu)

    formMailSend.appendChild(ButtonForMailSend)
    ContainerFullScreen.appendChild(closeButton)
    closeButton.addEventListener('click', () => {
        ContainerFullScreen.remove()
    })
})
