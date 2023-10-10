// Fichier export de function
export function FullScreenContainer(child, parent, LiNode) {
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

export function TriTableauMail(ContenuContainerBase, ParentDeBase) {
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