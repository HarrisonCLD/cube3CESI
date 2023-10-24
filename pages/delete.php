<?php
session_start();

require_once "../backend/config.php";

// Page Php avec fonctionnalité de suppression d'un produit du stock, aucun HTML :
if (!isset($_SESSION['admin']) || !isset($_SESSION['user'])) {
    header('Location: ../login.php');
    exit();
} else if (isset($_SESSION['id_utilisateur'])) {

    $StatutUser = $_SESSION['admin'] ? 'admin' : 'user';
    $idUser = $_SESSION['id_utilisateur'];

    // Requête SQL pour supprimer le produit du stock :
    try {
        $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if (isset($_GET['id'])) {
            $idToDelete = strip_tags($_GET['id']);

            $sqlDeleteStock = "DELETE FROM produits WHERE id_produits = :id";

            $stmtDeleteStock = $pdo->prepare($sqlDeleteStock);
            $stmtDeleteStock->bindParam(':id', $idToDelete, PDO::PARAM_INT);

            if ($stmtDeleteStock->execute()) {
                header('Location: pages/dashboard_gestion_de_magasin.php');
                exit();
            } else {
                echo "La suppression a échoué.";
            }
        } else {
            echo "Paramètre 'id' non défini dans l'URL.";
        }
    } catch (PDOException $e) {
        echo '<div class="alert_container">Erreur avec la base de donnée.</div>';
    }
}
