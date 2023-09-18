<?php
//LINK DATA BASE HARRISON
$db_host = 'localhost';
$db_name = 'cube3CESI';
$db_user = 'admin_cube3';
$db_password = 'root';
//

// function pour executé des requêtes PDO
function executeQuery($pdo, $sql)
{
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die('Erreur : ' . $e->getMessage());
    }
};
//

