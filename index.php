<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>CRM CESI - LOGIN</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100;200;300;400;500;600;700;800;900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/loginForm.css">

</head>

<body>

    <main>

        <!-- // LOGIN CONTAINER -->

        <?php

        require_once('backend/config.php');

        try {
            $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Erreur de connexion : ' . $e->getMessage());
        }


        if (isset($_POST['SubmitFormLogin'])) {
            try {
                $nomDeCompte = $_POST['nomDeCompte'];
                $motDePasse = $_POST['motDePasse'];

                $sql = 'SELECT * FROM utilisateur WHERE nomDeCompte = ?';
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(1, $nomDeCompte);
                $stmt->execute();

                if ($stmt->rowCount() >= 1) {
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    $motDePasseBDD = $row['motDePasse'];
                    if ($motDePasseBDD == $motDePasse) {
                        if ($nomDeCompte == 'admin') {
                            header('Location: pages/dashBoardAdmin.php');
                            exit();
                        } else {
                            header('Location: pages/dashBoardUser.php');
                            exit();
                        }
                    } else {
                        echo "Mot de passe incorrect.";
                    }
                } else {
                    echo "Nom de compte incorrect ou mot de passe incorrect.";
                }
            } catch (PDOException $e) {
                die('Erreur de requête : ' . $e->getMessage());
            }
        }

        echo '<main>
        <form class="login_container" method="POST">
            <div class="logo_container">
                <img src="" alt="">
            </div>
            <div class="username_container">
                <label for="nomDeCompte">Nom de compte :</label>
                <input
                type="text"
                name="nomDeCompte"
                placeholder="Nom de compte...">
            </div>
            <div class="password_container">
                <label for="motDePasse">Mot de passe :</label>
                <input
                type="password"
                name="motDePasse"
                placeholder="Mot de passe...">
            </div>
            <button
            type="submit"
            name="SubmitFormLogin">Se connecter</button>
            <p>Vous souhaitez vous inscrire, <a class="link_switch_2" href="pages/registrerForm.php">cliquez ici</a></p>
        </form>
        </main>'
        ?>
    </main>

</body>

<script src="javascript/loginScript.js"></script>

</html>