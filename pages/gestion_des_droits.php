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
        $iUser = $_SESSION['id_utilisateur'];
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
            <div class="bottom_gestion_droit">
                <label for="user_select">Selectionner un utilisateur :</label>
                <select name="user">

                    <?php
                    foreach ($user as $rowUser) {
                        echo '<option value="' . $rowUser['nom'] . '" id="' . $rowUser['numeroDeBadge'] . '">' . $rowUser['nom'] . '</option>';
                    }
                    ?>

                </select>
            </div>
        </div>

    </main>

</body>

<script src="../javascript/navBar.js"></script>

</html>