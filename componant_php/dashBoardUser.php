<?php

require_once('../backend/config.php');

try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // REQUÊTE POUR CONTAINER ANNONCE MAIL INTERNE
    $sqlAnnonces = "SELECT titre, categorie, contenu, auteur FROM annonces";
    $stmtAnnonces = $pdo->prepare($sqlAnnonces);
    $stmtAnnonces->execute();
    $annonces = $stmtAnnonces->fetchAll(PDO::FETCH_ASSOC);

    //REQUÊTE POUR CONTAINER PLANNING SALARIÉ
    $sqlDateTime = "SELECT date FROM horaires";
    // WHERE date >= CURDATE()
    // ORDER BY date ASC";
    $stmtDateTime  = $pdo->prepare($sqlDateTime);
    $stmtDateTime->execute();
    $datetime_strings = $stmtDateTime->fetchAll(PDO::FETCH_COLUMN);
} catch (PDOException $e) { //Si erreur avec la requête a la BDD
    echo '<div class="alert_container">Erreur avec la base de donnée.</div>';
}

// HTML simple
echo '<main>
    <div class="full_screen_container">
    <div class="closeButton"></div>
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
                 <table class="planning_table">
             <tr>
        <th></th>';

$timeZone = date_default_timezone_set('Europe/Paris');
$today = date('d-m');
$todayExplode = explode('-', $today);
$day = $todayExplode[0];
$month = $todayExplode[1];

echo '<th>' . $day . '/' . $month . '</th>';

for ($i = 0; $i < 14; $i++) {
    $day++;

    if (($day > 31 && ($month == '01' || $month == '03' || $month == '05' || $month == '07' || $month == '08' || $month == '10' || $month == '12')) ||
        ($day > 30 && ($month == '04' || $month == '06' || $month == '09' || $month == '11')) ||
        ($day > 28 && $month == '02')
    ) {
        $day = 01;
        $month++;
        echo '<th>' . $day . '/' . $month . '</th>';
    } else {
        echo '<th>' . $day . '/' . $month . '</th>';
    }
}

echo '</tr>';



$heures = ['8h00', '9h00', '10h00', '11h00', '12h00', '13h00', '14h00', '15h00', '16h00', '17h00', '18h00', '19h00'];

for ($k = 0; $k < count($heures); $k++) {
    echo '<tr>';
    echo '<td class="heure_container_planning">' . $heures[$k] . '</td>';

    for ($j = 0; $j < 15; $j++) {
        if (isset($datetime_strings[$j])) {
            $datetime = new DateTime($datetime_strings[$j]);
            $heureTimeBDD = $datetime->format('H');
            $datetimeBDD = $datetime->format('d');
            $monthTimeBDD = $datetime->format('m');
            $dateToday = date('d');
            $monthToday = date('m');

            $heuresString = substr($heures[$k], 0, 2);

            $dateIncremente = $dateToday;

            if ($dateIncremente === $datetimeBDD && $monthToday === $monthTimeBDD && $heuresString === $heureTimeBDD) {
                echo '<td class="occuped"></td>';
                $dateIncremente++;
            } else {
                echo '<td></td>';
                $dateIncremente++;
            }
        } else {
            echo '<td></td>';
        }
    }

    echo '</tr>';
}

echo '</tr>
    </table>
    </div>
            </div>
        </div>
        <div class="bottom_dashBoard_user">
            <div class="cp_container">
                <div class="top_content_cp">
                    <h3>CONGÉS PAYÉS :</h3>
                </div>
                <div class="separation_bar"></div>';

if (isset($_POST['submitDemandeCP'])) {
    $debutCP = $_POST['debutCP'];
    $finCP = $_POST['finCP'];
    try {
        $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //REQUÊTE POUR CONTAINER CONGÉS PAYÉS
        $sqlCP = "INSERT INTO congesPaye (debutCP, finCP) VALUES (:debutCP, :finCP)";
        $stmtCP = $pdo->prepare($sqlCP);

        $stmtCP->bindParam(':debutCP', $debutCP);
        $stmtCP->bindParam(':finCP', $finCP);

        $stmtCP->execute();
    } catch (PDOException $e) { //Si erreur avec la requête a la BDD
        echo '<div class="alert_container">Erreur avec la base de donnée.</div>';
    }
}

echo '<form class="cp_content" method="POST">
<div class="heures_enter_form">
    <div>
        <label>Début des CP :</label>
        <input class="onChange1" type="date" name="debutCP">
    </div>
    <div>
        <label>Fin des CP :</label>
        <input class="onChange2" type="date" name="finCP" onChange="CalculDifferenceJour()">
    </div>
    </div>
<div><span class="diff_heure_container"></span></div>
                <button class="add_cp_but"
                type="submit"
                name="submitDemandeCP"
                >Demande de CP</button>
            </div>
            </form>
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
