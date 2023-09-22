<?php

require_once('../backend/config.php');

if (isset($_POST['submitForChangePassword'])) {
    try {

        $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if (isset($_POST['submitForChangePassword']) && isset($idUser)) {
            $newPassword1 = htmlspecialchars($_POST['newMotDePasse1']);
            $newPassword2 = htmlspecialchars($_POST['newMotDePasse2']);

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
        echo '<div class="alert_container">Erreur avec la base de données : ' . $e->getMessage() . '</div>';
    }
}

echo '<main>
    <div class="options_user">
        <div class="options_container">
            <h3>Changement de mot de passe :</h3>
            <div class="separation_bar"></div>
            <form class="form_options" method="POST">
<label for="newMotDePasse">Entrer votre nouveau mot de passe :</label>
<input type="password" name="newMotDePasse1" placeholder="Nouveau mot de passe...">
<label for="newMotDePasse">Entrer une nouvelle fois votre nouveau mot de passe :</label>
<input type="password" name="newMotDePasse2" placeholder="Nouveau mot de passe...">
<button
type="submit"
name="submitForChangePassword">
Changement de mot de passe
</button>
</form>
</div>
</div>
</main>';
