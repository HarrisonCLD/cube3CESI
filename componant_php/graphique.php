<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Graphique sans bibliothèque</title>
    <style>
        /* Style pour les barres du graphique */
        .bar {
            fill: blue;
        }
    </style>
</head>

<body>
    <svg width="400" height="200">
        <?php
        // Code PHP pour récupérer les données de la base de données
        require_once('../backend/config.php');

        try {
            $pdo = new PDO("mysql:localhost=$db_host;dbname=$db_name", $db_user, $db_password);
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

                echo "<rect class='bar' x='$x' y='" . (200 - $nb_vente) . "' width='$barWidth' height='$nb_vente'></rect>";
                $x += $barWidth + $spacing;
            }
        } catch (PDOException $e) {
            // echo '<div class="alert_container">Erreur avec la base de donnée.</div>';
        }
        ?>
    </svg>
</body>

</html>