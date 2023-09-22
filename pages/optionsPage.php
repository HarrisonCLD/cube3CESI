<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/index.css">

    <title>CRM CESI - Options</title>

</head>

<body>
    <?php
    if (!isset($_SESSION['admin']) || !isset($_SESSION['user'])) {
        header('Location: ../index.php');
        exit();
    } else if (isset($_SESSION['id_utilisateur'])) {

        $StatutUser = $_SESSION['admin'] ? 'admin' : 'user';
        $idUser = $_SESSION['id_utilisateur'];

        include "../componant_php/navBarV2.php";
        include "../componant_php/options.php";
    }
    ?>
</body>

</html>