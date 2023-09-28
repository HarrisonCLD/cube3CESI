<?php
session_start();

if (!isset($_SESSION['admin']) || !isset($_SESSION['user'])) {
    header('Location: ../index.php');
    exit();
} else if (isset($_SESSION['id_utilisateur'])) {

    $StatutUser = $_SESSION['admin'] ? 'admin' : 'user';
    $idUser = $_SESSION['id_utilisateur'];

    require_once "../backend/config.php";

    try {
        $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if (isset($_GET['id'])) {
            $idToDelete = $_GET['id'];

            // Requête pour supprimer un produit du stock
            $sqlDeleteStock = "DELETE FROM produits WHERE id_produits = :id";

            $stmtDeleteStock = $pdo->prepare($sqlDeleteStock);
            $stmtDeleteStock->bindParam(':id', $idToDelete, PDO::PARAM_INT);

            if ($stmtDeleteStock->execute()) {
                header('Location: pages/gestionMagasin.php?options=stock');
                exit();
            } else {
                echo "La suppression a échoué.";
            }
        } else {
            echo "Paramètre 'id' non défini dans l'URL.";
        }
    }

    //Catch si il y a une erreur avec la BDD
    catch (PDOException $e) {
        echo "Erreur SQL : " . $e->getMessage();
    }
}
