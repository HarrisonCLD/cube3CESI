<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Links Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100;200;300;400;500;600;700;800;900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <!-- Links CSS -->
    <link rel="stylesheet" href="../css/index.css">

    <title>ERP CESI - Édition</title>

</head>

<body>

    <?php

    require_once('../backend/config.php');

    if (!isset($_SESSION['admin']) || !isset($_SESSION['user'])) {
        header('Location: ../login.php');
        exit();
    } else if (isset($_SESSION['id_utilisateur'])) {

        $StatutUser = $_SESSION['admin'] ? 'admin' : 'user';
        $iUser = $_SESSION['id_utilisateur'];
    }

    try {
        $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Requête SQL pour la selection du produit en fonction de l'id indiqué dans l'url :
        if (isset($_GET['id'])) {

            $idSelecton = strip_tags($_GET['id']);

            $sqlSelect = "SELECT * FROM produits WHERE id_produits = :id";

            $stmtSelectProduit = $pdo->prepare($sqlSelect);

            //Param de la requête SQL
            $stmtSelectProduit->bindParam(':id', $idSelecton, PDO::PARAM_INT);

            $stmtSelectProduit->execute();

            $resultSelection = $stmtSelectProduit->fetch(PDO::FETCH_ASSOC);

            // Banque de varible de la requête SQL
            $idProduit = $resultSelection['id_produits'];
            $refProduit = $resultSelection['reference'];
            $nomProduit = $resultSelection['nom'];
            $descriptionProduit = $resultSelection['description'];
            $catProduit = $resultSelection['categorie'];
            $prixProduit = $resultSelection['prix'];
            $stockProduit = $resultSelection['stock'];
        }

        // Requête SQL pour modifier le contenu de la BDD par rapport au produit selectionné :
        if (isset($_POST['submitForEdit'])) {

            $idEdit = strip_tags($_GET['id']);

            // Banque de variable de la requête SQL
            $ref = strip_tags($_POST['inputForRef']);
            $nom = strip_tags($_POST['inputForName']);
            $description = strip_tags($_POST['inputForDescription']);
            $categorie = strip_tags($_POST['inputForCategorie']);
            $prix = strip_tags($_POST['inputForPrix']);
            $stock = strip_tags($_POST['inputForStock']);

            $sqlEdit = "UPDATE produits SET ";
            $updates = array();

            if (!empty($ref)) {
                $updates[] = "reference = '$ref'";
            }
            if (!empty($nom)) {
                $updates[] = "nom = '$nom'";
            }
            if (!empty($categorie)) {
                $updates[] = "categorie = '$categorie'";
            }
            if (!empty($description)) {
                $updates[] = "description = '$description'";
            }
            if (!empty($prix)) {
                $updates[] = "prix = '$prix'";
            }
            if (!empty($stock)) {
                $updates[] = "stock = '$stock'";
            }

            // Vérifiez s'il y a des mises à jour à effectuer
            if (!empty($updates)) {
                var_dump($updates);
                $sqlEdit .= implode(", ", $updates);
                $sqlEdit .= " WHERE id_produits = '$idEdit'";

                $stmtSqlEdit = $pdo->prepare($sqlEdit);
                $stmtSqlEdit->execute();
            }
        }
    } catch (PDOException $e) {
        echo '<div class="alert_container">Erreur avec la base de donnée.</div>';
    }
    ?>

    <?php
    include '../componant_php/navBarV2.php';
    ?>

    <!-- Code HTML pour l'édition de produit -->
    <main>
        <div class="edit_container">

            <div class="card_left_container">
                <div class="identite_produit">
                    <? echo '<p>' . $idProduit . '</p>'; ?>
                    <? echo '<p class="reference_edit_produit">' . $refProduit . '</p>' ?>
                </div>
                <hr>
                <? echo '<h3>' . $nomProduit . '</h3>'; ?>
                <? echo '<p>' . $descriptionProduit . '</p>'; ?>
                <? echo '<p class="categorie_edit_produit">' . $catProduit . '</p>'; ?>
                <hr>
                <div class="stock_produit">
                    <? echo '<p>Prix : ' . $prixProduit . ' €</p>'; ?>
                    <? echo '<p>' . $stockProduit . ' en stock</p>'; ?>
                </div>
            </div>
            <form class="card_right_container" method="POST">
                <p>Modifier le nom :</p>
                <div>
                    <input type="text" name="inputForName" placeholder="Nom...">
                    <svg width="23" height="23" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6.2253 4.81108C5.83477 4.42056 5.20161 4.42056 4.81108 4.81108C4.42056 5.20161 4.42056 5.83477 4.81108 6.2253L10.5858 12L4.81114 17.7747C4.42062 18.1652 4.42062 18.7984 4.81114 19.1889C5.20167 19.5794 5.83483 19.5794 6.22535 19.1889L12 13.4142L17.7747 19.1889C18.1652 19.5794 18.7984 19.5794 19.1889 19.1889C19.5794 18.7984 19.5794 18.1652 19.1889 17.7747L13.4142 12L19.189 6.2253C19.5795 5.83477 19.5795 5.20161 19.189 4.81108C18.7985 4.42056 18.1653 4.42056 17.7748 4.81108L12 10.5858L6.2253 4.81108Z" fill="currentColor" />
                    </svg>
                </div>
                <p>Modifier la réference :</p>
                <div>
                    <input type="text" name="inputForRef" placeholder="Référence...">
                    <svg width="23" height="23" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6.2253 4.81108C5.83477 4.42056 5.20161 4.42056 4.81108 4.81108C4.42056 5.20161 4.42056 5.83477 4.81108 6.2253L10.5858 12L4.81114 17.7747C4.42062 18.1652 4.42062 18.7984 4.81114 19.1889C5.20167 19.5794 5.83483 19.5794 6.22535 19.1889L12 13.4142L17.7747 19.1889C18.1652 19.5794 18.7984 19.5794 19.1889 19.1889C19.5794 18.7984 19.5794 18.1652 19.1889 17.7747L13.4142 12L19.189 6.2253C19.5795 5.83477 19.5795 5.20161 19.189 4.81108C18.7985 4.42056 18.1653 4.42056 17.7748 4.81108L12 10.5858L6.2253 4.81108Z" fill="currentColor" />
                    </svg>
                </div>
                <p>Modifier la description :</p>
                <div>
                    <input type="text" name="inputForDescription" placeholder="Description...">
                    <svg width="23" height="23" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6.2253 4.81108C5.83477 4.42056 5.20161 4.42056 4.81108 4.81108C4.42056 5.20161 4.42056 5.83477 4.81108 6.2253L10.5858 12L4.81114 17.7747C4.42062 18.1652 4.42062 18.7984 4.81114 19.1889C5.20167 19.5794 5.83483 19.5794 6.22535 19.1889L12 13.4142L17.7747 19.1889C18.1652 19.5794 18.7984 19.5794 19.1889 19.1889C19.5794 18.7984 19.5794 18.1652 19.1889 17.7747L13.4142 12L19.189 6.2253C19.5795 5.83477 19.5795 5.20161 19.189 4.81108C18.7985 4.42056 18.1653 4.42056 17.7748 4.81108L12 10.5858L6.2253 4.81108Z" fill="currentColor" />
                    </svg>
                </div>
                <p>Modifier la catégorie :</p>
                <div>
                    <input type="text" name="inputForCategorie" placeholder="Catégorie...">
                    <svg width="23" height="23" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6.2253 4.81108C5.83477 4.42056 5.20161 4.42056 4.81108 4.81108C4.42056 5.20161 4.42056 5.83477 4.81108 6.2253L10.5858 12L4.81114 17.7747C4.42062 18.1652 4.42062 18.7984 4.81114 19.1889C5.20167 19.5794 5.83483 19.5794 6.22535 19.1889L12 13.4142L17.7747 19.1889C18.1652 19.5794 18.7984 19.5794 19.1889 19.1889C19.5794 18.7984 19.5794 18.1652 19.1889 17.7747L13.4142 12L19.189 6.2253C19.5795 5.83477 19.5795 5.20161 19.189 4.81108C18.7985 4.42056 18.1653 4.42056 17.7748 4.81108L12 10.5858L6.2253 4.81108Z" fill="currentColor" />
                    </svg>
                </div>
                <p>Modifier le prix :</p>
                <div>
                    <input type="text" name="inputForPrix" placeholder="Prix...">
                    <svg width="23" height="23" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6.2253 4.81108C5.83477 4.42056 5.20161 4.42056 4.81108 4.81108C4.42056 5.20161 4.42056 5.83477 4.81108 6.2253L10.5858 12L4.81114 17.7747C4.42062 18.1652 4.42062 18.7984 4.81114 19.1889C5.20167 19.5794 5.83483 19.5794 6.22535 19.1889L12 13.4142L17.7747 19.1889C18.1652 19.5794 18.7984 19.5794 19.1889 19.1889C19.5794 18.7984 19.5794 18.1652 19.1889 17.7747L13.4142 12L19.189 6.2253C19.5795 5.83477 19.5795 5.20161 19.189 4.81108C18.7985 4.42056 18.1653 4.42056 17.7748 4.81108L12 10.5858L6.2253 4.81108Z" fill="currentColor" />
                    </svg>
                </div>
                <p>Modfier le stock :</p>
                <div>
                    <input type="text" name="inputForStock" placeholder="Stock...">
                    <svg width="23" height="23" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6.2253 4.81108C5.83477 4.42056 5.20161 4.42056 4.81108 4.81108C4.42056 5.20161 4.42056 5.83477 4.81108 6.2253L10.5858 12L4.81114 17.7747C4.42062 18.1652 4.42062 18.7984 4.81114 19.1889C5.20167 19.5794 5.83483 19.5794 6.22535 19.1889L12 13.4142L17.7747 19.1889C18.1652 19.5794 18.7984 19.5794 19.1889 19.1889C19.5794 18.7984 19.5794 18.1652 19.1889 17.7747L13.4142 12L19.189 6.2253C19.5795 5.83477 19.5795 5.20161 19.189 4.81108C18.7985 4.42056 18.1653 4.42056 17.7748 4.81108L12 10.5858L6.2253 4.81108Z" fill="currentColor" />
                    </svg>
                </div>
                <button class="submitEdit" type="submit" name="submitForEdit">Modifier le contenu du produit</button>
            </form>
        </div>
    </main>

    <script src="../javascript/navBar.js"></script>

</body>

</html>