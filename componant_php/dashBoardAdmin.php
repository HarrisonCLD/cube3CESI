<?php

require_once "../backend/config.php";

try {
  $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Requête SQL pour les informations de l'utilisateur :
  $SQL_select_user = "SELECT * FROM utilisateur WHERE id_utilisateur = :id";
  $STMT_select_user = $pdo->prepare($SQL_select_user);
  $STMT_select_user->bindParam(':id', $idUser);
  $STMT_select_user->execute();
  $RESULT_select_user = $STMT_select_user->fetch();
} catch (PDOException $e) {
  echo '<div class="alert_container">Erreur avec la base de donnée.</div>';
}
?>
<main>
  <div class="dashBoard_admin">
    <div class="col_1">
      <div class="graphique">
        <h3 class="titre_graphique">Evolution des ventes</h3>
        <div class="separation_bar"></div>
        <div class="forme-graphique">
          <!-- <?php include 'graphique2.php'; ?> -->
        </div>
      </div>
      <div class="vente">
        <h3 class="dernieresVentes">Dernières ventes</h3>
        <div class="separation_bar"></div>
        <p>Lorem ipsum dolor sit amet,<br>consectetur adipiscing elit,<br>sed eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
      </div>
    </div>
    <div class="col_2">
      <div class="commentaire">
        <h3 class="clients">Derniers commentaires des clients</h3>
        <div class="separation_bar"></div>
        <div class="derniers">
          <p>Lorem ipsum dolor sit amet,<br>consectetur adipiscing elit,<br>sed eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
      </div>
      <div class="compte">
        <h3>Information du compte</h3>
        <div class="separation_bar"></div>
        <div class="description">
          <p>Numéro de badge : <?= $RESULT_select_user['numeroDeBadge'] ?></p>
          <p>Nom : <?= $RESULT_select_user['nom'] ?></p>
          <p>Prénom : <?= $RESULT_select_user['prenom'] ?></p>
          <p>Nom du compte : <?= $RESULT_select_user['nomDeCompte'] ?></p>
          <p>E-mail : <?= $RESULT_select_user['email'] ?></p>
          <p>Rôle : <?= $RESULT_select_user['privilege'] ?></p>
        </div>
      </div>
    </div>
  </div>
</main>