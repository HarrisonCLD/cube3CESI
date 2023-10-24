const OpenMailButton = document.querySelector('.top_mail_container a')
const body = document.querySelector('body')
const ContainerFullScreen = document.createElement('div');

// Fonction création d'une fenêtre full screen :
function ReadMailFullScreen(parent, enfant) {
    //Création du container de full screen :
    ContainerFullScreen.classList.add('ContainerFullScreen');
    const closeButton = document.createElement('div');
    closeButton.classList.add('closeButton');
    ContainerFullScreen.appendChild(closeButton)
    closeButton.addEventListener('click', () => {
    parent.appendChild(enfant)
    ContainerFullScreen.remove()
    // TriTab(Tab);
})
}

function TriTab(TabToSort) {
    TabToSort.sort((a, b) => {
        const textA = a.textContent.toLowerCase();
        const textB = b.textContent.toLowerCase();
        return textA.localeCompare(textB);
    });
}

// Fonction de la création du formulaire d'envois de mail :
function CreationFullScreenSendMail() {

        ReadMailFullScreen();
        body.appendChild(ContainerFullScreen)
    
        //Création formulaire send mail
        const formMailSend = document.createElement('form')
        formMailSend.classList.add('write_mail_container')
        formMailSend.setAttribute("method", "POST")
        const Container1MailFullScreen = document.createElement('div')
        Container1MailFullScreen.classList.add('Container1MailFull')
        const Label1Adresse = document.createElement('label')
        Label1Adresse.classList.add('adresse_send')
        Label1Adresse.innerHTML = 'À :'
        const Input1Adresse = document.createElement('input')
        Input1Adresse.setAttribute('type', 'text')
        Input1Adresse.setAttribute('name', 'SendMailAdresse')
        Input1Adresse.classList.add('input_for_adresse')
    
        const Container2MailFullScreen = document.createElement('div')
        Container2MailFullScreen.classList.add('Container2MailFull')
        const Label2Object = document.createElement('label')
        Label2Object.classList.add('object_send')
        Label2Object.innerHTML = "Objet :"
        const Input2Object = document.createElement('input')
        Input2Object.setAttribute('type', 'text')
        Input2Object.setAttribute('name', 'SendMailObject')
        Input2Object.classList.add('input_for_object_send')
    
        const Container3MailFullScreen = document.createElement('div')
        Container3MailFullScreen.classList.add('Container3MailFull')
        const Label3Contenu = document.createElement('label')
        Label3Contenu.innerHTML = "Contenu du mail :"
        Label3Contenu.classList.add('contenu_send')
        const TextArea3Contenu = document.createElement('textarea')
        TextArea3Contenu.setAttribute('name', 'SendMailContenu')
        TextArea3Contenu.classList.add('textarea_for_contenu_mail')
    
        const ButtonForMailSend = document.createElement('button')
        ButtonForMailSend.classList.add('buttonForMailSend')
        ButtonForMailSend.setAttribute('type', 'submit')
        ButtonForMailSend.setAttribute('name', 'SubmitForSendMail')
        ButtonForMailSend.innerHTML = "Envoyer";
    
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
        Container3MailFullScreen.appendChild(TextArea3Contenu)
    
        formMailSend.appendChild(ButtonForMailSend)
}

OpenMailButton.addEventListener('click', CreationFullScreenSendMail)

//Fullscreen à l'ouverture des mails :
const ParentMailBeforeFullScreen = document.querySelector('.content_mail_container ul')
const MailRead = document.querySelectorAll('.mailStyle');
const Tab_MailRead = Array.from(MailRead);

    for (let i = 0; i < Tab_MailRead.length; i++) {
        Tab_MailRead[i].addEventListener('click', () => {
                ReadMailFullScreen(ParentMailBeforeFullScreen, Tab_MailRead[i]);
                body.appendChild(ContainerFullScreen)
                ContainerFullScreen.appendChild(Tab_MailRead[i]);
            }
    )}