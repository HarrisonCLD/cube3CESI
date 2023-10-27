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

    <title>ERP CESI - Édition droits utilisateur</title>

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

        if (isset($_GET['id'])) {

            $id_badge = strip_tags($_GET['badge']);

            // Requête pour obtenir tout les statuts de compte disponible de la BDD :

            // Requête pour afficher les informations de l'utilisateur voulu :
            $sqlSelectUser = "SELECT * FROM utilisateur WHERE numeroDeBadge = :badge";
            $stmtSelectUser = $pdo->prepare($sqlSelectUser);
            $stmtSelectUser->bindParam(':badge', $id_badge);
            $stmtSelectUser->execute();

            $resultUser = $stmtSelectUser->fetch(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        echo '<div class="alert_container">Erreur avec la base de donnée.</div>';
    }
    ?>

    <?php
    include '../componant_php/navBarV2.php';
    ?>

    <!-- Code HTML pour l'édition des droits utilisateur -->
    <main>
        <h3>Édition des droits utilisateur :</h3>
        <hr>
        <div class="edit_user_left_container">
            <p><strong>Id utilisateur : </strong><?= $resultUser['id_utilisateur'] ?></p>
            <p><strong>Numéro de badge : </strong><?= $resultUser['numeroDeBadge'] ?></p>
            <p><strong>Email : </strong><?= $resultUser['email'] ?></p>
            <p><strong>Nom : </strong><?= $resultUser['nom'] ?></p>
            <p><strong>Prénom : </strong><?= $resultUser['prenom'] ?></p>
            <p><strong>Privilèges : </strong><?= $resultUser['statut'] ?></p>
        </div>
        <div class="edit_user_right_container">
            <form method="POST">
                <div>
                    <label for="numeroDeBadge">Numéro de badge :</label>
                    <input type="text" name="numeroDeBadge" placeholder="Modifier le numéro de badge..." required>
                </div>
                <div>
                    <label for="nom">Nom :</label>
                    <input type="text" name="nom" placeholder="Modifier le nom..." required>
                </div>
                <div>
                    <label for="prenom">Prénom :</label>
                    <input type="text" name="prenom" placeholder="Modifier le prénom..." required>
                </div>
                <div>
                    <label for="email">Email :</label>
                    <input type="text" name="email" placeholder="Modifier l'email" required>
                </div>
                <div>
                    <label for="statut">Statut :</label>
                    <input type="text" name="statut" placeholder="Modifier le statut" required>
                </div>
                <div>
                    <select name="statut_open">
                        <option value="admin">Administrateur</option>
                        <option value="user">Utilisateur</option>
                    </select>
                </div>
                <button class="SubmitEditUser" type="submit" name="SubmitEditUser">Modifier les informations de l'utilisateur</button>
            </form>
        </div>
    </main>

    <script src="../javascript/navBar.js"></script>

</body>

</html>