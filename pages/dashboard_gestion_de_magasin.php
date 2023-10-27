<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Links Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100;200;300;400;500;600;700;800;900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <!-- Links CSS -->
    <link rel="stylesheet" href="../css/index.css">

    <title>ERP CESI - Gestion de magasin</title>

</head>

<body>

    <?php

    require_once('../backend/config.php');

    if (!isset($_SESSION['admin']) || !isset($_SESSION['user'])) {
        header('Location: ../index.php');
        exit();
    } else if (isset($_SESSION['id_utilisateur'])) {

        $StatutUser = $_SESSION['admin'] ? 'admin' : 'user';
        $idUser = $_SESSION['id_utilisateur'];
    }

    try {
        $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //Requête SQL de pour importer tous les produits
        $sqlSelectProduits = "SELECT * FROM produits";
        $stmtSelectProduits = $pdo->prepare($sqlSelectProduits);
        $stmtSelectProduits->execute();
        $AllProduits = $stmtSelectProduits->fetchAll(PDO::FETCH_ASSOC);

        //Requête SQL pour importer les stats
        $sqlStats = "SELECT * FROM stats";
        $stmtStats = $pdo->prepare($sqlStats);
        $stmtStats->execute();
        $AllStats = $stmtStats->fetchAll(PDO::FETCH_ASSOC);

        // Requête SQL pour Submit le formlaire d'ajout d'un produit
        if (isset($_POST['submitAddProduit'])) {

            $refProduit = strip_tags($_POST['reference_produit']);
            $nomProduit = strip_tags($_POST['nom_produit']);
            $descriptProduit = strip_tags($_POST['description_produit']);
            $prixProduit = strip_tags($_POST['prix_produit']);
            $categorieProduit = strip_tags($_POST['categorie_produit']);
            $stockProduit = strip_tags($_POST['stock_produit']);

            $sqlAddProduct = "INSERT INTO produits (id_produits, reference, nom, description, prix, categorie, stock) VALUES (:id_produits, :reference, :nom, :description, :prix, :categorie, :stock)";

            $stmtAddProduit = $pdo->prepare($sqlAddProduct);

            $stmtAddProduit->bindParam(':id_produits', $idProduit);
            $stmtAddProduit->bindParam(':reference', $refProduit);
            $stmtAddProduit->bindParam(':nom', $nomProduit);
            $stmtAddProduit->bindParam(':description', $descriptProduit);
            $stmtAddProduit->bindParam(':prix', $prixProduit);
            $stmtAddProduit->bindParam(':categorie', $categorieProduit);
            $stmtAddProduit->bindParam(':stock', $stockProduit);

            $stmtAddProduit->execute();
        }
    } catch (PDOException $e) {
        echo '<div class="alert_container">Erreur avec la base de donnée.</div>';
    }
    ?>

    <?php
    include '../componant_php/navBarV2.php';
    ?>

    <!-- Code HTML pour la gestion du magasin -->
    <main>
        <!-- // Fullscreen container HTML -->
        <div class="fullscreen_stock">
            <div class="top_stock_search">
                <div class="searchProduitContainer">
                    <input class="searchProduit" type="search" name="searchProduit">
                    <div class="result_search"></div>
                </div>
                <div class="filtreProduit">
                    <p>Filtre</p>
                    <svg width="25" height="25" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#000000" stroke-width="0.00024000000000000003">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path d="M5.70711 9.71069C5.31658 10.1012 5.31658 10.7344 5.70711 11.1249L10.5993 16.0123C11.3805 16.7927 12.6463 16.7924 13.4271 16.0117L18.3174 11.1213C18.708 10.7308 18.708 10.0976 18.3174 9.70708C17.9269 9.31655 17.2937 9.31655 16.9032 9.70708L12.7176 13.8927C12.3271 14.2833 11.6939 14.2832 11.3034 13.8927L7.12132 9.71069C6.7308 9.32016 6.09763 9.32016 5.70711 9.71069Z" fill="currentColor"></path>
                        </g>
                    </svg>
                </div>
                <div class="content_filtre">
                    <p class="filtre_1">Les plus récents</p>
                    <p class="filtre_2">Prix : décroissant</p>
                    <p class="filtre_3">Prix : croissant</p>
                    <p class="filtre_4">Par stock</p>
                </div>
                <div class="closeButton"></div>
            </div>
            <table class="containerStock">
                <thead>
                    <th class="id_col">ID</th>
                    <th class="reference_col">Référence</th>
                    <th class="nom_col">Nom</th>
                    <th class="description_col">Description</th>
                    <th class="prix_col">Prix (€)</th>
                    <th class="categorie_col">Catégorie</th>
                    <th class="stock_col">Stock</th>
                    <th class="actions_col">Actions</th>
                </thead>
                <tbody>

                    <?php
                    //Utilisation de l'import des produits de la BDD
                    foreach ($AllProduits as $rowProduits) {
                        echo '<tr>
                            <td>' . $rowProduits['id_produits'] . '</td>
                            <td>' . $rowProduits['reference'] . '</td>
                            <td>' . $rowProduits['nom'] . '</td>
                            <td>' . $rowProduits['description'] . '</td>
                            <td>' . $rowProduits['prix'] . '</td>
                            <td>' . $rowProduits['categorie'] . '</td>
                            <td>' . $rowProduits['stock'] . '</td>
                            <td class="actions_case">
                            <a class="actions_details" href="details.php?id=' . $rowProduits['id_produits'] . '"><svg width="23" height="23" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M16 12C16 14.2091 14.2091 16 12 16C9.79086 16 8 14.2091 8 12C8 9.79086 9.79086 8 12 8C14.2091 8 16 9.79086 16 12ZM14 12C14 13.1046 13.1046 14 12 14C10.8954 14 10 13.1046 10 12C10 10.8954 10.8954 10 12 10C13.1046 10 14 10.8954 14 12Z" fill="currentColor" /><path fill-rule="evenodd" clip-rule="evenodd" d="M12 3C17.5915 3 22.2898 6.82432 23.6219 12C22.2898 17.1757 17.5915 21 12 21C6.40848 21 1.71018 17.1757 0.378052 12C1.71018 6.82432 6.40848 3 12 3ZM12 19C7.52443 19 3.73132 16.0581 2.45723 12C3.73132 7.94186 7.52443 5 12 5C16.4756 5 20.2687 7.94186 21.5428 12C20.2687 16.0581 16.4756 19 12 19Z" fill="currentColor" /></svg></a>
                            <a class="actions_edit" href="edit_produit.php?id=' . $rowProduits['id_produits'] . '"><svg width="23" height="23" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8 12C8 13.1046 7.10457 14 6 14C4.89543 14 4 13.1046 4 12C4 10.8954 4.89543 10 6 10C7.10457 10 8 10.8954 8 12Z" fill="currentColor" /><path d="M14 12C14 13.1046 13.1046 14 12 14C10.8954 14 10 13.1046 10 12C10 10.8954 10.8954 10 12 10C13.1046 10 14 10.8954 14 12Z" fill="currentColor" /><path d="M18 14C19.1046 14 20 13.1046 20 12C20 10.8954 19.1046 10 18 10C16.8954 10 16 10.8954 16 12C16 13.1046 16.8954 14 18 14Z" fill="currentColor" /></svg></a>
                            <a class="actions_delete" href="delete.php?id=' . $rowProduits['id_produits'] . '"><svg width="23" height="23" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6.2253 4.81108C5.83477 4.42056 5.20161 4.42056 4.81108 4.81108C4.42056 5.20161 4.42056 5.83477 4.81108 6.2253L10.5858 12L4.81114 17.7747C4.42062 18.1652 4.42062 18.7984 4.81114 19.1889C5.20167 19.5794 5.83483 19.5794 6.22535 19.1889L12 13.4142L17.7747 19.1889C18.1652 19.5794 18.7984 19.5794 19.1889 19.1889C19.5794 18.7984 19.5794 18.1652 19.1889 17.7747L13.4142 12L19.189 6.2253C19.5795 5.83477 19.5795 5.20161 19.189 4.81108C18.7985 4.42056 18.1653 4.42056 17.7748 4.81108L12 10.5858L6.2253 4.81108Z" fill="currentColor" /></svg></a>
                            </td>
                            </tr>';
                    }
                    ?>

                </tbody>
            </table>
        </div>

        <!-- // contenu HTML hors fullscreen -->
        <div class="gestionMagasinBoard">
            <div class="navGestionMagasin">
                <ul>
                    <li><a href="?options=statistique">Statistiques</a></li>
                    <hr class="separation_nav_gestion">
                    <li><a href="?options=ajouterproduit">Ajouter un produit</a></li>
                    <hr class="separation_nav_gestion">
                    <li><a href="?options=stock">Stock</a></li>
                    <hr class="separation_nav_gestion">
                    <li><a href="?options=demarchage">Démarchage mail</a></li>
                </ul>
            </div>
            <hr class="separation_gestion_container">

            <?php
            if (isset($_GET['options'])) {
                $contenuLink = strip_tags($_GET['options']);

                //Onglet par défaut Stats :
                switch ($contenuLink) {
                    default:
                        // $contenuLink = 'statistique';
                        $contenuContainer = '<div class="stats_container">
                                <h3>Statistiques :</h3>
                                <hr class="separation_gestion_content">
                                <table class="gestion_stats_content">
                                <thead class="line_stats_1">
                                <th>Date</th>
                                <th>Recette 24h (€)</th>
                                <th>Vente Unité 24h</th>
                                </thead>
                                <tbody class="tbody_stats">';

                        // ForEach pour l'importation des stats
                        foreach ($AllStats as $rowStats) {
                            echo '<tr class="line_stats">
                            <td>' . $rowStats['date'] . '</td>
                            <td>' . $rowStats['recette_24h'] . '</td>
                            <td>' . $rowStats['vente_par_unite'] . '</td>
                            </tr>';
                        }

                        echo '</tbody></table></div>';
                        break;

                        //Onglet Ajouter un produit :
                    case 'ajouterproduit':
                        $contenuContainer =
                            '<div class="add_produit_container">
                                <h3>Ajouter un produit :</h3>
                                <hr class="separation_gestion_content">
                                <div class="gestion_options_content">
                                <form method="POST" class="form_add_produit">
                                <div class="top_add">
                                <div class="left_add_produit_container">
                                    <div class="reference_container">
                                        <label for="refProduit">Référence du produit :</label>
                                        <input type="text" name="reference_produit" placeholder="Référence du produit...">
                                    </div>
                                    <div class="nom_container">
                                        <label for="nomProduit">Nom du produit :</label>
                                        <input type="text" name="nom_produit" placeholder="Nom du produit...">
                                    </div>
                                    <div class="description_container">
                                        <label for="descriptionProduit">Description du produit :</label>
                                        <input type="text" name="description_produit" placeholder="Description du produit...">
                                    </div>
                                </div>
                                <div class="right_add_produit_container">
                                    <div class="prix_container">
                                        <label for="prixProduit">Prix du produit :</label>
                                        <input type="text" name="prix_produit" placeholder="Prix du produit...">
                                    </div>
                                    <div class="marque_container">
                                        <label for="categorieProduit">Catégorie du produit :</label>
                                        <input type="text" name="categorie_produit" placeholder="Catégorie du produit...">
                                    </div>
                                    <div class="stock_container">
                                        <label for="stockProduit">Stock disponible du produit :</label>
                                        <input type="text" name="stock_produit" placeholder="Stock disponible du produit...">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="submitAddProduit">Ajouter un produit</button>
                                </form>
                                </div></div>';
                        break;

                        //Onglet Stock :
                    case 'stock':
                        $contenuContainer =
                            '<div class="button_container_stock"><button class="OpenFullScreenStock">Ouvrir le panneau de stock</button></div>';
                        break;

                        //Onglet Démarchage :
                    case 'demarchage':
                        $contenuContainer =
                            '5';
                        break;
                }
                echo $contenuContainer;
            }
            ?>

        </div>
    </main>

    <script src="../javascript/navBar.js"></script>
    <script src="../javascript/gestionMagasin.js"></script>

</body>

</html>