function CalculDifferenceJour() {
    const inputOnChange1 = document.querySelector('.onChange1').value;
    const inputOnChange2 = document.querySelector('.onChange2').value;

    const containerDiffHeure = document.querySelector('.diff_heure_container');

    if (inputOnChange1 != '' && inputOnChange2 != '') {

        const inputOnChange1Date = new Date(inputOnChange1);
        const inputOnChange2Date = new Date(inputOnChange2);

        if (!isNaN(inputOnChange1Date) && !isNaN(inputOnChange2Date)) {
            const differenceEnMilliseconds = Math.abs(inputOnChange2Date - inputOnChange1Date);
            const differenceEnJours = differenceEnMilliseconds / (1000 * 60 * 60 * 24);

            containerDiffHeure.innerHTML = `Nombre de CP demandées : ${differenceEnJours.toFixed(0)}`;
        } else {
            containerDiffHeure.innerHTML = 'Dates invalides';
        }
    } else {
        containerDiffHeure.innerHTML = 'Veuillez remplir les deux champs de date.';
    }
}
