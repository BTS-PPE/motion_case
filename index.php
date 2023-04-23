<?php 
    require_once("pages/db.php");
    session_start();
    $requestSqlForGetItems = "SELECT * FROM `coque` JOIN `motif` ON coque.Id_motif = motif.Id_motif JOIN `modele` ON coque.Id_modele = modele.Id_modele";
    $result = mysqli_query($db_connec, $requestSqlForGetItems);
    // if(!isset($_SESSION["login"])){
    //     header("Location: pages/login.php");
    //     exit(); 
    // }
    include("pages/functions.php");
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="assets/css/main.css?=1584529395">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Baloo Bhai">
        <title>Motion Case | Main</title>
    </head>
    <body>
        <nav>
            <div class="navbar-container">
                <div class="logo">
                    <a href="index.php"><h1>Motion Case</h1></a>
                </div>
                <div class="search">
                    <form method="post">
                        <i class="fas fa-search"></i>
                        <input name="searchBar" type="text" placeholder="Search...">
                    </form>
                </div>
                <ul>
                    <li><a href="pages/login.php"><i class="fas fa-user-alt"></i></a></li>
                    <li><a href="pages/cart.php"><i class="fas fa-shopping-cart"></i></a></li>
                </ul>
            </div>
        </nav>
        <div class="main-container">
            <!-- <div class="item">
                <div class="item-img">
                    <img src="assets/images/items/1/principal.jpg">
                </div>
                <div class="item-info">
                    <h2>Naruto</h2>
                    <p>Apple iPhone 11 Pro Max 256GB - Midnight Green</p>
                    <p>Prix: 1.299,00€</p>
                </div>
                <button type="submit">Ajouter au panier</button>
            </div> -->

            <?php
                if (isset($_POST["login"])) {
                    CreateNewUser();
                } 

                if (isset($_POST["username"])) {
                    LoginUser();
                    $_SESSION["login"] = "";
                }

                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="item">';
                    echo '<div class="item-img">';
                    echo '<img src="assets/images/items/'.$row['Id_Coque'].'/principal.jpg">';
                    echo '</div>';
                    echo '<div class="item-info">';
                    echo '<h2>'.$row['motif'].'</h2>';
                    echo '<p>'.$row['modele'].'</p>';
                    echo '<p>Prix: '.$row['Prix'].'€</p>';
                    echo '</div>';
                    echo '<button type="submit">Ajouter au panier</button>';
                    echo '</div>';
                }
            ?>
        </div>
        <script src="../assets/js/main.js"></script>
    </body>
</html>