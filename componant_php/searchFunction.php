<?php
// search.php

// Récupérer le terme de recherche depuis l'URL
$searchTerm = $_GET['query'];

// Vous pouvez maintenant effectuer une recherche dans votre base de données
// ou une autre source de données, puis renvoyer les résultats au format JSON.

// Par exemple, supposons une recherche basique de correspondance de chaîne dans un tableau de données.
$data = ["Article 1", "Article 2", "Article 3", "Autre article"];

$results = [];
foreach ($data as $item) {
    if (stripos($item, $searchTerm) !== false) {
        $results[] = $item;
    }
}

// Renvoyer les résultats au format JSON
echo json_encode($results);
?>
