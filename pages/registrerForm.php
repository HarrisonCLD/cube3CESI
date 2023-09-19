<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Document</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100;200;300;400;500;600;700;800;900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../css/index.css">

</head>

<body>

    <!-- // INSCRIPTION CONTAINER -->

    <?php
    require_once('../backend/config.php');

    try {
        $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die('Erreur de connexion : ' . $e->getMessage());
    }

    if (isset($_POST['SubmitFormInscription'])) {
        try {
            $numeroDeBadge = $_POST['numeroDeBadge'];
            $email = $_POST['email'];
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $nomDeCompte = $_POST['nomDeCompte'];
            $motDePasse = $_POST['motDePasse'];

            $sql = "INSERT INTO utilisateur (numeroDeBadge, email, nom, prenom, nomDeCompte, motDePasse) VALUES (:numeroDeBadge, :email, :nom, :prenom, :nomDeCompte, :motDePasse)";
            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':numeroDeBadge', $numeroDeBadge);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':prenom', $prenom);
            $stmt->bindParam(':nomDeCompte', $nomDeCompte);
            $stmt->bindParam(':motDePasse', $motDePasse);

            $result = $stmt->execute();

            if ($result) {
                header('Location: ../index.php');
                exit();
            } else {
                echo '<script>alert("Inscripton échoué !")</script>';
            }
        } catch (PDOException $e) {
            die('Erreur de requête : ' . $e->getMessage());
        }
    }

    echo '<main>
    <form class="registrer_container" method="POST">
            <div class="logo_container">
                <img src="" alt="">
            </div>
            <div class="information_container">
                <div class="left_container">
                    <div class="badge_container">
                        <label for="numeroDeBadge">Votre numéro de badge :</label>
                        <input 
                        type="text"
                        name="numeroDeBadge"
                        placeholder="Numéro de badge..."
                        required>
                    </div>
                    <div class="mail_container">
                        <label for="email">Email :</label>
                        <input 
                        type="text"
                        name="email"
                        placeholder="Email..."
                        required>
                    </div>
                    <div class="name_container">
                        <label for="nom">Votre nom :</label>
                        <input 
                        type="text"
                        name="nom"
                        placeholder="Nom..."
                        required>
                    </div>
                    <div class="firstname_container">
                        <label for="prenom">Votre prénom :</label>
                        <input 
                        type="text"
                        name="prenom"
                        placeholder="Prénom..."
                        required>
                    </div>
                </div>
                <div class="right_container">
                    <div class="username_container">
                        <label for="nomDeCompte">Nom de compte :</label>
                        <input 
                        type="text"
                        name="nomDeCompte"
                        placeholder="Nom de compte..."
                        required>
                    </div>
                    <div class="password_container">
                        <label for="motDePasse">Mot de passe :</label>
                        <input
                        type="password"
                        name="motDePasse"
                        placeholder="Mot de passe..."
                        required>
                    </div>
                </div>
            </div>
            <button 
            type="submit"
            name="SubmitFormInscription"
            >S\'inscrire</button>
            <p>Vous possédez déjà un compte, <a class="link_switch_1" href="../index.php"">cliquez ici</a></p>
        </form>
        </main>
        '
    ?>

    <script src="../javascript/navBar.js"></script>

</body>

</html>