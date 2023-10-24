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

    <title>ERP CESI - Page d'inscription</title>

</head>

<body>

    <?php
    require_once('../backend/config.php');

    // Requête SQL Formulaire d'inscription
    if (isset($_POST['SubmitFormInscription'])) {
        try {

            //Banque variable formulaire
            $numeroDeBadge = strip_tags($_POST['numeroDeBadge']);
            $email = strip_tags($_POST['email']);
            $nom = strip_tags($_POST['nom']);
            $prenom = strip_tags($_POST['prenom']);
            $nomDeCompte = strip_tags($_POST['nomDeCompte']);
            $motDePasse = strip_tags($_POST['motDePasse']);
            $motDePasse2 = strip_tags($_POST['motDePasse2']);

            if (
                isset($_POST['numeroDeBadge']) && isset($_POST['email']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['nomDeCompte']) && isset($_POST['motDePasse']) && isset(($_POST['motDePasse2']))
            ) {
                if (
                    !empty($_POST['numeroDeBadge']) && !empty($_POST['email']) && !empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['nomDeCompte']) && !empty($_POST['motDePasse']) && !empty($_POST['motDePasse2'])
                ) {
                    $NumBadgeValid = htmlspecialchars($numeroDeBadge);

                    if ($NumBadgeValid < 6 && $NumBadgeValid > 6) {
                        echo '<div class="alert_container">Numéro de badge invalide</div>';
                    } else {
                        $MdpUser1 = strip_tags($motDePasse);
                        $MdpUser2 = strip_tags($motDePasse2);

                        if ($MdpUser1 === $MdpUser2) {

                            $passwordHash = password_hash($MdpUser1, PASSWORD_BCRYPT);

                            $sql = "INSERT INTO utilisateur (numeroDeBadge, email, nom, prenom, nomDeCompte, motDePasse) VALUES (:numeroDeBadge, :email, :nom, :prenom, :nomDeCompte, :motDePasse)";
                            $stmt = $pdo->prepare($sql);

                            $stmt->bindParam(':numeroDeBadge', $numeroDeBadge);
                            $stmt->bindParam(':email', $email);
                            $stmt->bindParam(':nom', $nom);
                            $stmt->bindParam(':prenom', $prenom);
                            $stmt->bindParam(':nomDeCompte', $nomDeCompte);
                            $stmt->bindParam(':motDePasse', $passwordHash);

                            $result = $stmt->execute();

                            if ($result) {
                                header('Location: ../login.php');
                                exit();
                            } else {
                                echo '<div class="alert_container">L\'inscription a échoué</div>';
                            }
                        } else {
                            echo '<div class="alert_container">Vos mots de passe ne correspondent pas</div>';
                        }
                    }
                } else {
                    echo '<div class="alert_container">Veuillez renseigner tout les champs demander</div>';
                }
            } else {
                echo '<div class="alert_container">Veuillez renseigner tout les champs demander</div>';
            }
        } catch (PDOException $e) {
            echo '<div class="alert_container">Erreur avec la base de donnée</div>';
        }
    }
    ?>

    <!-- HTML pour l'nscription -->
    <main>
        <form class="registrer_container" method="POST">
            <div class="information_container">
                <div class="left_container">
                    <div class="badge_container">
                        <label for="numeroDeBadge">Votre numéro de badge :</label>
                        <input type="text" name="numeroDeBadge" placeholder="Numéro de badge..." required>
                    </div>
                    <div class="email_container">
                        <label for="email">Email :</label>
                        <input type="email" name="email" placeholder="Email..." required>
                    </div>
                    <div class="name_container">
                        <label for="nom">Votre nom :</label>
                        <input type="text" name="nom" placeholder="Nom..." required>
                    </div>
                    <div class="firstname_container">
                        <label for="prenom">Votre prénom :</label>
                        <input type="text" name="prenom" placeholder="Prénom..." required>
                    </div>
                </div>
                <div class="right_container">
                    <div class="username_container">
                        <label for="nomDeCompte">Nom de compte :</label>
                        <input type="text" name="nomDeCompte" placeholder="Nom de compte..." required>
                    </div>
                    <div class="password_container">
                        <label for="motDePasse">Mot de passe :</label>
                        <input type="password" name="motDePasse" placeholder="Mot de passe..." required>
                    </div>
                    <div class="password_container_2">
                        <label for="motDePasse2">Mot de passe une 2ème fois:</label>
                        <input type="password" name="motDePasse2" placeholder="Mot de passe..." required>
                    </div>
                </div>
            </div>
            <button type="submit" name="SubmitFormInscription">S'inscrire</button>
            <p>Vous possédez déjà un compte, <a class="link_switch_1" href="../login.php">cliquez ici</a></p>
        </form>
    </main>

    <script src=" ../javascript/navBar.js"></script>

</body>

</html>