<?php

require_once('../backend/config.php');

try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erreur de connexion : ' . $e->getMessage());
}

if (isset($_POST['submitForChangePassword'])) {
    try {
        if (isset($_POST['submitForChangePassword'])) {
            $newPassword1 = htmlspecialchars($_POST['newMotDePasse1']);
            $newPassword2 = htmlspecialchars($_POST['newMotDePasse2']);

            if ($newPassword1 != $newPassword2) {
                echo '<div class="alert_container">Les 2 mots de passe ne sont pas identique.</div>';
            } else {

                $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }

            $sqlChangePassword = 'UPDATE utilisateur SET motDePasse =WHERE id = 1234;';
        }
    } catch (PDOException $e) {
        echo '<div class="alert_container">Erreur avec la base de donnée 2.</div>';
    }
}

echo '<main>
    <div class="options_user">
        <div class="options_container">
            <h3>Changement de mot de passe :</h3>
            <div class="separation_bar"></div>
            <form class="form_options" method="POST">
<label for="newMotDePasse">Entrer votre nouveau mot de passe :</label>
<input type="text" name="newMotDePasse1" placeholder="Nouveau mot de passe...">
<label for="newMotDePasse">Entrer une nouvelle fois votre nouveau mot de passe :</label>
<input type="text" name="newMotDePasse2" placeholder="Nouveau mot de passe...">
<button
type="submit"
name="submitForChangePassword">
Changement de mot de passe
</button>
</form>
</div>
</div>
</main>';
