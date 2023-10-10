<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100;200;300;400;500;600;700;800;900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../css/index.css">

    <title>CRM CESI - Details</title>

</head>

<body>

    <?php
    if (!isset($_SESSION['admin']) || !isset($_SESSION['user'])) {
        header('Location: ../index.php');
        exit();
    } else if (isset($_SESSION['id_utilisateur'])) {

        $StatutUser = $_SESSION['admin'] ? 'admin' : 'user';
        $iUser = $_SESSION['id_utilisateur'];

        include '../componant_php/navBarV2.php';
        include '../componant_php/detailsDashBoard.php';
    }
    ?>
    <script src="../javascript/navBar.js"></script>

</body>

</html>