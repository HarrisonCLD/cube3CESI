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

        <?php
        echo '<form class="registrer_container">
            <div class="logo_container">
                <img src="" alt="">
            </div>
            <div class="information_container">
                <div class="left_container">
                    <div class="badge_container">
                        <label for="">Votre numéro de badge :</label>
                        <input type="text" placeholder="Numéro de badge..." required>
                    </div>
                    <div class="mail_container">
                        <label for="">Email :</label>
                        <input type="text" placeholder="Email..." required>
                    </div>
                    <div class="name_container">
                        <label for="">Votre nom :</label>
                        <input type="text" placeholder="Nom..." required>
                    </div>
                    <div class="firstname_container">
                        <label for="">Votre prénom :</label>
                        <input type="text" placeholder="Prénom..." required>
                    </div>
                </div>
                <div class="right_container">
                    <div class="photo_container">
                        <label for="">Photo utilisateur :</label>
                        <input type="file" accept="image/png image/jpeg" required>
                    </div>
                    <div class="username_container">
                        <label for="">Nom de compte :</label>
                        <input type="text" placeholder="Nom de compte..." required>
                    </div>
                    <div class="password_container">
                        <label for="">Mot de passe :</label>
                        <input type="password" placeholder="Mot de passe..." required>
                    </div>
                </div>
            </div>
            <button type="submit">S\'inscrire</button>
            <p>Vous possédez déjà un compte, <a class="link_switch_1" onClick="ToggleFormLog()">cliquez ici</a></p>
        </form>'
        ?>

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