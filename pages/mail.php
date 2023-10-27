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

        // Requête SQL pour récupérer les auteurs de mail disponible :
        $SQL_select_auteur = "SELECT * FROM poste_de_travail";
        $STMT_select_auteur = $pdo->prepare($SQL_select_auteur);
        $STMT_select_auteur->execute();
        $RESULT_select_auteur = $STMT_select_auteur->fetchAll();

        // Requête SQL pour récupérer les categorie de mail disponible :
        $SQL_select_categorie = "SELECT * FROM categorie_mail";
        $STMT_select_categorie = $pdo->prepare($SQL_select_categorie);
        $STMT_select_categorie->execute();
        $RESULT_select_categorie = $STMT_select_categorie->fetchAll();

        //Requête pour l'envoi d'annonce :
        if (isset($_POST['SubmitForSendMail']) && !empty($_POST['SendMailTitre']) && !empty($_POST['SendMailAuteur']) && !empty($_POST['SendMailContenu']) && (!empty($_POST['SendMailCategorie']))) {

            // Passage en strip_tags des données du formulaire :
            $ST_TitreAnnonce = strip_tags($_POST['SendMailTitre']);
            $ST_AuteurAnnonce = strip_tags($_POST['SendMailAuteur']);
            $ST_ContenuAnnonce = strip_tags($_POST['SendMailContenu']);
            $ST_CategorieAnnonce = strip_tags($_POST['SendMailCategorie']);

            // Passage en HtmlSpecialChars des données du formulaire :
            $HSC_TitreAnnonce = htmlspecialchars($ST_TitreAnnonce);
            $HSC_AuteurAnnonce = htmlspecialchars($ST_AuteurAnnonce);
            $HSC_ContenuAnnonce = htmlspecialchars($ST_ContenuAnnonce);
            $HSC_CategorieAnnonce = htmlspecialchars($ST_CategorieAnnonce);

            // Switch chaine de caractère en chiffre pour l'auteur :
            // Système à re travailler.
            if ($HSC_AuteurAnnonce == 'Directeur') {
                $HSC_AuteurAnnonce = 1;
            } else {
                $HSC_AuteurAnnonce = 2;
            }

            // Switch chaine de caractère en chiffre pour la categorie :
            // Système à re travailler.
            if ($HSC_CategorieAnnonce == 'Annonce') {
                $HSC_CategorieAnnonce = 1;
            } else if ($HSC_CategorieAnnonce == 'Nouvelle') {
                $HSC_CategorieAnnonce = 2;
            } else if ($HSC_CategorieAnnonce == 'Logistique') {
                $HSC_CategorieAnnonce = 3;
            } else if ($HSC_CategorieAnnonce == 'Administratif') {
                $HSC_CategorieAnnonce = 4;
            } else if ($HSC_CategorieAnnonce == 'Problème') {
                $HSC_CategorieAnnonce = 5;
            } else if ($HSC_CategorieAnnonce == 'Ressource humaine') {
                $HSC_CategorieAnnonce = 6;
            }

            $SQL_SendMail = "INSERT INTO annonces (titre, auteur, contenu, categorie_mail, date_mail) VALUES (:titre, :auteur, :contenu, :categorie, NOW())";
            $STMT_SendMail = $pdo->prepare($SQL_SendMail);
            $STMT_SendMail->bindParam(':titre', $HSC_TitreAnnonce, PDO::PARAM_STR);
            $STMT_SendMail->bindParam(':auteur', $HSC_AuteurAnnonce, PDO::PARAM_INT);
            $STMT_SendMail->bindParam(':contenu', $HSC_ContenuAnnonce, PDO::PARAM_STR);
            $STMT_SendMail->bindParam(':categorie', $HSC_CategorieAnnonce, PDO::PARAM_INT);
            $STMT_SendMail->execute();
            header('Location: mail.php');
            exit();
        }
    } catch (PDOException $e) { //Si erreur avec la requête a la BDD
        // echo '<div class="alert_container">Erreur avec la base de donnée.</div>';
        echo $e;
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
                        $MailAuteurSelect = $rowMailSend['auteur'];

                        if ($MailAuteurSelect == 1) {
                            $MailAuteurSelect = 'Directeur';
                        } else {
                            $MailAuteurSelect = 'Utilisateur';
                        }

                        echo '<li class="mailStyle">
                        <p class="titre_mail">' . $rowMailSend['titre'] . '</p>
                        <p class="contenu_mail">' . $rowMailSend['contenu'] . '</p>
                        <p class="auteur_mail">' . $MailAuteurSelect . '</p>
                        <p class="date_mail">' . $rowMailSend['date_mail'] . '</p>
                        </li>';
                    }

                    ?>

                </ul>
            </div>
        </div>

        <div class="ContainerFullScreen">
            <div class="closeButton"></div>
            <form class="write_mail_container" method="POST">
                <div class="Container1MailFull">
                    <label class="adresse_send" for="SendMailTitre">Titre :</label>
                    <input type="text" name="SendMailTitre" class="input_for_adresse">
                </div>
                <div class="Container2MailFull">
                    <div>
                        <label class="object_send" for="SendMailAuteur">Auteur :</label>
                        <select name="SendMailAuteur">
                            <?php
                            foreach ($RESULT_select_auteur as $auteur) {
                                echo '<option value="' . $auteur['Nom_poste_de_travail'] . '">' . $auteur['Nom_poste_de_travail'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div>
                        <label class="categorie_send" for="SendMailCategorie">Categorie :</label>
                        <select name="SendMailCategorie">
                            <?php
                            foreach ($RESULT_select_categorie as $categorie) {
                                echo '<option value="' . $categorie['Nom'] . '">' . $categorie['Nom'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="Container3MailFull">
                    <label class="contenu_send" for="SendMailContenu">Contenu du mail :</label>
                    <textarea class="textarea_for_contenu_mail" name="SendMailContenu"></textarea>
                </div>
                <button class="buttonForMailSend" type="submit" name="SubmitForSendMail">Envoyer</button>
            </form>
        </div>

    </main>

    <script src="../javascript/navBar.js"></script>
    <script src="../javascript/gestionMail.js"></script>

</body>

</html>