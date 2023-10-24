<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Links Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100;200;300;400;500;600;700;800;900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <!-- Links CSS -->
    <link rel="stylesheet" href="../css/index.css">

    <title>ERP CESI - Mail</title>

</head>

<body>

    <?php

    require_once('../backend/config.php');

    if (!isset($_SESSION['admin']) || !isset($_SESSION['user'])) {
        header('Location: ../login.php');
        exit();
    } else if (isset($_SESSION['id_utilisateur'])) {

        $StatutUser = $_SESSION['admin'] ? 'admin' : 'user';
        $idUser = $_SESSION['id_utilisateur'];
    }

    try {
        $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //Requête import de toutes les annonces :
        $sqlSelectMailSend = "SELECT * FROM annonces";
        $stmtSelectMailSend = $pdo->prepare($sqlSelectMailSend);
        $stmtSelectMailSend->execute();
        $AllMailSend = $stmtSelectMailSend->fetchAll(PDO::FETCH_ASSOC);

        //Requête envois de mail :
        if (isset($_POST['SubmitForSendMail']) && !empty($AdresseMail) && !empty($ObjectMail) && !empty($ContenuMail)) {
            $AdresseMail = strip_tags($_POST['SendMailAdresse']);
            $ObjectMail = strip_tags($_POST['SendMailObject']);
            $ContenuMail = strip_tags($_POST['SendMailContenu']);

            $sqlSendMail = "INSERT INTO mail";
            $stmtSendMail = $pdo->prepare($sqlSendMail);
            $stmtSendMail->execute();
        }
    } catch (PDOException $e) { //Si erreur avec la requête a la BDD
        echo '<div class="alert_container">Erreur avec la base de donnée.</div>';
    }
    ?>

    <?php
    include "../componant_php/navBarV2.php";
    ?>

    <!-- Code HTML pour le composant d'écriture de mail -->
    <main>
        <div class="mail_container">
            <div class="top_mail_container">
                <h3>Mail</h3>
                <a><svg width="24" height="24" fill="currentColor" viewBox="-2 -2 24 24" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMinYMin" class="jam jam-write">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path d="M5.72 14.456l1.761-.508 10.603-10.73a.456.456 0 0 0-.003-.64l-.635-.642a.443.443 0 0 0-.632-.003L6.239 12.635l-.52 1.82zM18.703.664l.635.643c.876.887.884 2.318.016 3.196L8.428 15.561l-3.764 1.084a.901.901 0 0 1-1.11-.623.915.915 0 0 1-.002-.506l1.095-3.84L15.544.647a2.215 2.215 0 0 1 3.159.016zM7.184 1.817c.496 0 .898.407.898.909a.903.903 0 0 1-.898.909H3.592c-.992 0-1.796.814-1.796 1.817v10.906c0 1.004.804 1.818 1.796 1.818h10.776c.992 0 1.797-.814 1.797-1.818v-3.635c0-.502.402-.909.898-.909s.898.407.898.91v3.634c0 2.008-1.609 3.636-3.593 3.636H3.592C1.608 19.994 0 18.366 0 16.358V5.452c0-2.007 1.608-3.635 3.592-3.635h3.592z"></path>
                        </g>
                    </svg></a>
            </div>
            <div class="content_mail_container">
                <ul>

                    <?php
                    // ForEach de tout les mails de la BDD à afficher
                    foreach ($AllMailSend as $rowMailSend) {
                        echo '<li class="mailStyle">
                    <p class="titre_mail">' . $rowMailSend['titre'] . '</p>
                    <p class="contenu_mail">' . $rowMailSend['contenu'] . '</p>
                    <p class="auteur_mail">' . $rowMailSend['auteur'] . '</p>
                    <p class="date_mail">' . $rowMailSend['date_mail'] . '</p>
                    </li>';
                    }
                    ?>

                </ul>
            </div>
        </div>
    </main>

    <script src="../javascript/navBar.js"></script>
    <script src="../javascript/gestionMail.js"></script>

</body>

</html>