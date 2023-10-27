<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ERP CESI - Gestion des droits</title>

    <!-- Links Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100;200;300;400;500;600;700;800;900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <!-- Links CSS -->
    <link rel="stylesheet" href="../css/index.css">

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
        //Try connexion PDO
        $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //Requête pour récupérer tous les utilisateurs dans la BDD :
        $sqlSelectUser = "SELECT * FROM utilisateur";
        $stmtSelectUser = $pdo->prepare($sqlSelectUser);
        $stmtSelectUser->execute();
        $user = $stmtSelectUser->fetchAll(PDO::FETCH_ASSOC);

        $userInfos = [];

        if (isset($_POST['SubmitForSearchUser'])) {

            $badgeUtilisateur = $_POST['searchUser'];

            //Requête pour récuperer les droits de l'utilisateur sélectionner :
            $sqlInfosUser = "SELECT * FROM utilisateur WHERE numeroDeBadge = :utilisateur";
            $stmtInfosUser = $pdo->prepare($sqlInfosUser);
            $stmtInfosUser->bindParam(':utilisateur', $badgeUtilisateur);
            $stmtInfosUser->execute();
            $userInfos = $stmtInfosUser->fetch(PDO::FETCH_ASSOC);

            $grantUser = $userInfos['privilege'];
        }

        // Catch PDO erreur
    } catch (PDOException $e) {
        echo '<div class="alert_container">Erreur avec la base de donnée.</div>';
    }
    ?>

    <?php
    include '../componant_php/navBarV2.php';
    ?>

    <!-- HTML pour la gestion des droits utilisateur -->

    <main>

        <div class="gestion_droit_container">
            <div class="top_gestion_droit">
                <h3>Gestion des droits utilisateurs :</h3>
                <div class="separation_bar"></div>
            </div>
            <form class="bottom_gestion_droit" method="POST">
                <div class="select_user_container">
                    <div class="search_droit_container">
                        <label for="user_select">Recherche d'un utilisateur :</label>
                        <input type="search" name="searchUser" placeholder="Recherche d'un utilisateur...">
                    </div>
                    <div class="button_droit_container">
                        <button type="submit" name="SubmitForSearchUser">Vérifier les droits</button>
                    </div>
                </div>

                <!-- Début du if pour vérifier si userInfos n'est pas null : -->
                <?php if (!empty($userInfos)) : ?>

                    <div class="list_droit_container">
                        <div class="top_droit_container">
                            <h4>Informations du compte :</h4>
                            <a href="">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8 12C8 13.1046 7.10457 14 6 14C4.89543 14 4 13.1046 4 12C4 10.8954 4.89543 10 6 10C7.10457 10 8 10.8954 8 12Z" fill="currentColor" />
                                    <path d="M14 12C14 13.1046 13.1046 14 12 14C10.8954 14 10 13.1046 10 12C10 10.8954 10.8954 10 12 10C13.1046 10 14 10.8954 14 12Z" fill="currentColor" />
                                    <path d="M18 14C19.1046 14 20 13.1046 20 12C20 10.8954 19.1046 10 18 10C16.8954 10 16 10.8954 16 12C16 13.1046 16.8954 14 18 14Z" fill="currentColor" />
                                </svg>
                            </a>
                        </div>
                        <hr>
                        <p><strong>Id utilisateur : </strong><?= $userInfos['id_utilisateur'] ?></p>
                        <p><strong>Numéro de badge : </strong><?= $userInfos['numeroDeBadge'] ?></p>
                        <p><strong>Email : </strong><?= $userInfos['email'] ?></p>
                        <p><strong>Nom : </strong><?= $userInfos['nom'] ?></p>
                        <p><strong>Prénom : </strong><?= $userInfos['prenom'] ?></p>
                        <p><strong>Privilèges : </strong><?= $userInfos['privilege'] ?></p>
                        <div class="grant_container">
                            <div>
                                <label for="admin_grant">Administrateur :</label>
                                <input type="checkbox" name="admin_grant" <?= ($grantUser === 1) ? 'checked' : '' ?>>
                            </div>
                            <div>
                                <label for="user_grant">Utilisateur :</label>
                                <input type="checkbox" name="user_grant" <?= ($grantUser === 2) ? 'checked' : '' ?>>
                            </div>
                            <div>
                                <label for="null_grant">Null :</label>
                                <input type="checkbox" name="null_grant" <?= ($grantUser === null) ? 'checked' : '' ?>>
                            </div>
                        </div>
                    </div>

                    <!-- Fin du if si la valeur de userInfos n'est pas null -->
                <?php endif; ?>

            </form>
        </div>

    </main>

</body>

<script src="../javascript/navBar.js"></script>

</html>