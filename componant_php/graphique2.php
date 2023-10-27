<?php
require_once('../backend/config.php');

try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT nb_jours, nb_vente FROM vente";
    $result = $pdo->query($sql);

    if (!$result) {
        die("La requête SQL a échoué : " . $pdo->errorInfo()[2]);
    }

    $barWidth = 50;
    $spacing = 15;
    $x = 40;

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $nb_jours = $row['nb_jours'];
        $nb_vente = $row['nb_vente'];

        echo "<svg width='fit-content' height='fit-content'><rect class='bar' x='$x' y='" . (200 - $nb_vente) . "' width='$barWidth' height='$nb_vente'></rect></svg>";
        $x += $barWidth + $spacing;
    }
} catch (PDOException $e) {
    echo '<div class="alert_container">Erreur avec la base de données.</div>';
}
