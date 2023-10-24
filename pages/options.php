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

    <title>ERP CESI - Options</title>

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

    if (isset($_POST['submitForChangePassword'])) {
        try {

            $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            if (isset($_POST['submitForChangePassword']) && isset($idUser)) {
                $newPassword1 = strip_tags($_POST['newMotDePasse1']);
                $newPassword2 = strip_tags($_POST['newMotDePasse2']);

                if ($newPassword1 != $newPassword2) {
                    echo '<div class="alert_container">Les 2 mots de passe ne sont pas identique.</div>';
                } else {
                    $newPasswordHash = password_hash($newPassword1, PASSWORD_BCRYPT);

                    $sqlChangePassword = 'UPDATE utilisateur SET motDePasse = :nouveauMotDePasse WHERE id_utilisateur = :id_utilisateur;';

                    $stmtChangePassword = $pdo->prepare($sqlChangePassword);
                    $stmtChangePassword->bindParam(':nouveauMotDePasse', $newPasswordHash);
                    $stmtChangePassword->bindParam(':id_utilisateur', $idUser);

                    $resultSwitchPassword = $stmtChangePassword->execute();

                    if ($resultSwitchPassword) {
                        echo '<div class="alert_container">Changement de mot de passe validé.</div>';
                    } else {
                        echo '<div class="alert_container">Erreur de changement de mot de passe.</div>';
                    }
                }
            }
        } catch (PDOException $e) {
            echo '<div class="alert_container">Erreur avec la base de donnée.</div>';
        }
    }
    ?>

    <!-- Importation du composant NavBar -->
    <?php
    include "../componant_php/navBarV2.php";
    ?>

    <!-- Code HTML pour la page options -->
    <main>
        <div class="options_user">
            <div class="options_container">
                <h3>Changement de mot de passe :</h3>
                <div class="separation_bar"></div>
                <form class="form_options" method="POST">
                    <label for="newMotDePasse">Entrer votre nouveau mot de passe :</label>
                    <input type="password" name="newMotDePasse1" placeholder="Nouveau mot de passe...">
                    <label for="newMotDePasse">Entrer une nouvelle fois votre nouveau mot de passe :</label>
                    <input type="password" name="newMotDePasse2" placeholder="Nouveau mot de passe...">
                    <button type="submit" name="submitForChangePassword">
                        Changement de mot de passe
                    </button>
                </form>
            </div>
        </div>
    </main>

    <script src="../javascript/navBar.js"></script>

</body>

</html>