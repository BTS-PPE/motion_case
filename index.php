<?php 
    require_once("pages/db.php");
    session_start();
    $id_session = session_id();
    // $requestSqlForGetItems = "SELECT * FROM `coque` JOIN `motif` ON coque.Id_motif = motif.Id_motif JOIN `modele` ON coque.Id_modele = modele.Id_modele";
    $requestSqlForGetItems = "CALL GetItems";
    // $result = mysqli_execute($requestSqlForGetItems);
    $result = mysqli_query($db_connec, $requestSqlForGetItems);
    // $result = mysqli_fetch($requestSqlForGetItems);
    $_SESSION["login"] = "";
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
                    <li><a id="login" href="pages/login.php"><i class="fas fa-user-alt"></i></a></li>
                    <li><a id="cart" href="pages/cart.php"><i class="fas fa-shopping-cart"></i></a></li>
                </ul>
            </div>
        </nav>
        <div class="main-container">
            <?php
                // echo "Ici : " . $result;

                if (isset($_POST["login"])) {
                    CreateNewUser();
                } 

                if (isset($_POST["username"])) {
                    LoginUser();
                    $_SESSION['login'] = $_POST['username'];
                }

                if (isset($_POST["searchBar"])) {
                    $request = $_POST["searchBar"];
                    $sql = "SELECT * FROM `coque` JOIN `motif` ON coque.Id_motif = motif.Id_motif AND motif.motif LIKE '%$request%' JOIN `modele` ON coque.Id_modele = modele.Id_modele";
                    $result = mysqli_query($db_connec, $sql);
                    if (mysqli_num_rows($result) == 0) {
                        echo '<div class="titleError">Aucun résultat pour votre recherche</div>';
                    }
                }

                // if $_SESSION["login"] != "" {
                //     echo '<script>document.getElementById("login").innerHTML = "<i class="fas fa-user-alt"></i> '.$_SESSION["login"].'";</script>';
                // }

                // echo "Session " . $_SESSION["login"];

                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="item">';
                    echo '<div class="item-img">';
                    echo '<a href="pages/item.php?id='.$row['Id_Coque'].'">';
                    echo '<img src="assets/images/items/'.$row['motif'].'/principal.jpg">';
                    echo '</a>';
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