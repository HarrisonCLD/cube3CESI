<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Site de Gestion - Cube3CESI</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100;200;300;400;500;600;700;800;900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/loginForm.css">

</head>

<body>

    <main>

        <!-- // REGISTRER CONTAINER -->

        <?php

        require_once('../backend/config.php');

        try {
            $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Erreur de connexion : ' . $e->getMessage());
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            try {
                $nomDeCompte = $_POST['nomDeCompte'];
                $motDePasse = $_POST['motDePasse'];

                $sql = "INSERT INTO utilisateur (numeroDeBadge, email, nom, prenom, photo, nomDeCompte, motDePasse) VALUES (:numeroDeBage, :email, :nom, :prenom, :photo, :nomDeCompte, :motDePasse)";
                $stmt = $pdo->prepare($sql);

                $stmt->bindParam(':nomDeCompte', $nomDeCompte);
                $stmt->bindParam(':motDePasse', $motDePasse);

                $result = $stmt->execute();

                // if ($result) {
                //     echo 'Inscription réussie !';
                // } else {
                //     echo 'Erreur lors de l\'inscription.';
                // }
            } catch (PDOException $e) {
                die('Erreur de requête : ' . $e->getMessage());
            }
        }


        echo '<form class="registrer_container">
            <div class="logo_container">
                <img src="" alt="">
            </div>
            <div class="information_container">
                <div class="left_container">
                    <div class="badge_container">
                        <label for="">Votre numéro de badge :</label>
                        <input 
                        type="text"
                        name="numeroDeBadge"
                        placeholder="Numéro de badge..."
                        required>
                    </div>
                    <div class="mail_container">
                        <label for="">Email :</label>
                        <input 
                        type="text"
                        name="email"
                        placeholder="Email..."
                        required>
                    </div>
                    <div class="name_container">
                        <label for="">Votre nom :</label>
                        <input 
                        type="text"
                        name="nom"
                        placeholder="Nom..."
                        required>
                    </div>
                    <div class="firstname_container">
                        <label for="">Votre prénom :</label>
                        <input 
                        type="text"
                        name="prenom"
                        placeholder="Prénom..."
                        required>
                    </div>
                </div>
                <div class="right_container">
                    <div class="photo_container">
                        <label for="">Photo utilisateur :</label>
                        <input 
                        type="file"
                        name="photo"
                        accept="image/png image/jpeg"
                        required>
                    </div>
                    <div class="username_container">
                        <label for="">Nom de compte :</label>
                        <input 
                        type="text"
                        name="nomDeCompte"
                        placeholder="Nom de compte..."
                        required>
                    </div>
                    <div class="password_container">
                        <label for="">Mot de passe :</label>
                        <input
                        type="password"
                        name="motDePasse"
                        placeholder="Mot de passe..."
                        required>
                    </div>
                </div>
            </div>
            <button type="submit">S\'inscrire</button>
            <p>Vous possédez déjà un compte, <a class="link_switch_1" onClick="ToggleFormLog()">cliquez ici</a></p>
        </form>'
        ?>

        <!-- // LOGIN CONTAINER -->

        <?php
        echo '<form class="login_container">
            <div class="logo_container">
                <img src="" alt="">
            </div>
            <div class="username_container">
                <label for="">Nom de compte :</label>
                <input type="text" placeholder="Nom de compte...">
            </div>
            <div class="password_container">
                <label for="">Mot de passe :</label>
                <input type="password" placeholder="Mot de passe...">
            </div>
            <button type="submit">Se connecter</button>
            <p>Vous souhaitez vous inscrire, <a class="link_switch_2" onClick="ToggleFormLog()">cliquez ici</a></p>
        </form>'
        ?>
    </main>

</body>

<script src="javascript/loginScript.js"></script>

</html>