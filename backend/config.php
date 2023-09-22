<?php
//LINK DATA BASE HARRISON
$db_host = 'localhost';
$db_name = 'cube3cesi';
$db_user = 'test';
$db_password = 'test';
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
