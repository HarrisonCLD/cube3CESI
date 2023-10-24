<?php
session_start();
$_SESSION['admin'] = false;
$_SESSION['user'] = false;
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ERP CESI - Page de connexion</title>

    <!-- Links Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100;200;300;400;500;600;700;800;900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <!-- Links CSS -->
    <link rel="stylesheet" href="css/index.css">

</head>

<body>
    <main>

        <?php

        require_once('backend/config.php');

        try {
            //Try connexion PDO
            $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Requête SQL pour la connexion d'un utilisateur :
            if (isset($_POST['SubmitFormLogin'])) {

                $nomDeCompte = strip_tags($_POST['nomDeCompte']);
                $motDePasse = strip_tags($_POST['motDePasse']);

                $sql = 'SELECT id_utilisateur, nomDeCompte, motDePasse, statut FROM utilisateur WHERE nomDeCompte = :nomDeCompte';

                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':nomDeCompte', $nomDeCompte, PDO::PARAM_STR);
                $stmt->execute();
                $row = $stmt->fetch();

                // Déclaration des row
                $idUserBDD = $row['id_utilisateur'];
                $nomDeCompteBDD = $row['nomDeCompte'];
                $motDePasseBDD = $row['motDePasse'];
                $statutBDD = $row['statut'];

                //Logique de connexion
                if (isset($nomDeCompteBDD)) {
                    if ($nomDeCompteBDD == $nomDeCompte && password_verify($motDePasse, $motDePasseBDD)) {
                        if ($statutBDD == 'admin') {
                            $_SESSION['id_utilisateur'] = $idUserBDD;
                            $_SESSION['admin'] = true;
                            header('Location: pages/dashboard_admin.php');
                            exit();
                        } else if (is_null($statutBDD)) {
                            echo '<div class="alert_container">Aucun statut accordé pour cet utilisateur, Veuillez patienter qu\'un admin valide votre inscription.</div>';
                        } else {
                            $_SESSION['id_utilisateur'] = $idUserBDD;
                            $_SESSION['user'] = true;
                            header('Location: pages/dashboard_utilisateur.php');
                            exit();
                        }
                    }
                } else {
                    echo '<div class="alert_container">Erreur avec la base de donnée.</div>';
                }
            }
            // Catch PDO erreur
        } catch (PDOException $e) {
            echo '<div class="alert_container">Erreur avec la base de donnée.</div>';
        }
        ?>

        <!-- HTML pour la connexion -->
        <form class="login_container" method="POST">
            <div class="username_container">
                <label for="nomDeCompte">Nom de compte :</label>
                <input type="text" name="nomDeCompte" placeholder="Nom de compte...">
            </div>
            <div class="password_container">
                <label for="motDePasse">Mot de passe :</label>
                <input type="password" name="motDePasse" placeholder="Mot de passe...">
            </div>
            <button type="submit" name="SubmitFormLogin">Se connecter</button>
            <p>Vous souhaitez vous inscrire, <a class="link_switch_2" href="pages/registrer.php">cliquez ici</a></p>
        </form>

    </main>

</body>

<script src="javascript/loginScript.js"></script>
<script src="javascript/navBar.js"></script>

</html>