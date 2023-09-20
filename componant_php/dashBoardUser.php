<?php

require_once('../backend/config.php');

//Function jour de semaine de anglais a français
function jourSemaineEnFrancais($jourAnglais)
{
    $jours = [
        "Monday" => "lundi",
        "Tuesday" => "mardi",
        "Wednesday" => "mercredi",
        "Thursday" => "jeudi",
        "Friday" => "vendredi",
        "Saturday" => "samedi",
        "Sunday" => "dimanche"
    ];

    return $jours[$jourAnglais];
}
//

try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sqlAnnonces = "SELECT titre, categorie, contenu, auteur FROM annonces";
    $stmtAnnonces = $pdo->prepare($sqlAnnonces);
    $stmtAnnonces->execute();
    $annonces = $stmtAnnonces->fetchAll(PDO::FETCH_ASSOC);

    $sqlHeures = "SELECT date, horaireDebut, horaireFin FROM horaires";
    $stmtHeures  = $pdo->prepare($sqlHeures);
    $stmtHeures->execute();
    $dates = $stmtHeures->fetchAll(PDO::FETCH_ASSOC);

    // HTML simple
    echo '<main>
    <div class="full_screen_container">
    <div class="closeButton"></div>
    <h4 class="title_full_screen"></h4>
    <p class="categorie_full_screen"></p>
    <p class="contenu_full_screen"></p>
    <p class="auteur_full_screen"></p>
    </div>
    <div class="dashBoard_user">
        <div class="top_dashBoard_user">
            <div class="annonce_container">
                <div class="annonce_top_content">
                    <h3>ANNONCES :</h3>
                </div>
                <div class="separation_bar"></div>
                <div class="annonce_content">';
    foreach ($annonces as $rowAnnonces) {
        echo '<ul>';
        echo "<li><h4 class='title_small'>" . $rowAnnonces["titre"] . "</h4></li>";
        echo "<li><p class='categorie_small'>" . $rowAnnonces["categorie"] . "</p></li>";
        echo "<li><p class='contenu_small'>" . $rowAnnonces["contenu"] . "</p></li>";
        echo "<li><p class='auteur_small'>" . $rowAnnonces["auteur"] . "</p></li>";
        echo '</ul>';
    }
    echo '</div>
            </div>
            <div class="planning_container">
                <div class="top_content_planning">
                    <h3>PLANNING :</h3>
                    <svg width="25" height="25" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path d="M23 4C23 2.34315 21.6569 1 20 1H16C15.4477 1 15 1.44772 15 2C15 2.55228 15.4477 3 16 3H20C20.5523 3 21 3.44772 21 4V8C21 8.55228 21.4477 9 22 9C22.5523 9 23 8.55228 23 8V4Z" fill="currentColor"></path>
                            <path d="M23 16C23 15.4477 22.5523 15 22 15C21.4477 15 21 15.4477 21 16V20C21 20.5523 20.5523 21 20 21H16C15.4477 21 15 21.4477 15 22C15 22.5523 15.4477 23 16 23H20C21.6569 23 23 21.6569 23 20V16Z" fill="currentColor"></path>
                            <path d="M4 21H8C8.55228 21 9 21.4477 9 22C9 22.5523 8.55228 23 8 23H4C2.34315 23 1 21.6569 1 20V16C1 15.4477 1.44772 15 2 15C2.55228 15 3 15.4477 3 16V20C3 20.5523 3.44772 21 4 21Z" fill="currentColor"></path>
                            <path d="M1 8C1 8.55228 1.44772 9 2 9C2.55228 9 3 8.55228 3 8L3 4C3 3.44772 3.44772 3 4 3H8C8.55228 3 9 2.55228 9 2C9 1.44772 8.55228 1 8 1H4C2.34315 1 1 2.34315 1 4V8Z" fill="currentColor"></path>
                        </g>
                    </svg>
                </div>
                <div class="separation_bar"></div>
                <div class="planning_content">
                <table>
                <tr>
        <th></th>';

    $timeZone = date_default_timezone_set('Europe/Paris');
    $today = date('d-m');
    $todayExplode = explode('-', $today);
    $day = $todayExplode[0];
    $month = $todayExplode[1];

    echo '<th>' . $day . ' / ' . $month . '</th>';

    echo '</tr>
    <tr>';
    $heures = ['8h00', '9h00', '10h00', '11h00', '12h00', '13h00', '14h00', '15h00', '16h00', '17h00', '18h00', '19h00'];
    foreach ($heures as $heure) {

        echo '<td>' . $heure . '</td>';
        for ($j = 0; $j <= 15; $j++) {
            echo '<td></td>';
        }
        echo '</tr>';
    }


    echo '</table>
    </div>
            </div>
        </div>
        <div class="bottom_dashBoard_user">
            <div class="cp_container">
                <div class="top_content_cp">
                    <h3>CONGÉS PAYÉS :</h3>
                </div>
                <div class="separation_bar"></div>
                <div class="cp_content">
    <div>
        <p>Début des CP :</p>
        <input type="date">
    </div>
    <div>
        <p>Fin des CP :</p>
        <input type="date">
    </div>
</div>
                <button class="add_cp_but">Demande de CP</button>
            </div>
            <div class="heure_container">
                <div class="top_heure_content">
                    <h3>HEURES :</h3>
                </div>
                <div class="separation_bar"></div>
                <div class="heure_content">
                <div class="compteur_container">
    <p>Votre compteur d\'heures :</p>
</div>
                </div>
            </div>
        </div>
    </div>
</main>';
} catch (PDOException $e) { //Initialisation si erreur avec la requête a la BDD
    die('Erreur : ' . $e->getMessage());
};
