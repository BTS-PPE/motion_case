<?php 
    require_once("db.php");
    $itemId = $_GET["id"];
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../assets/css/item.css?=1584529395">
        <link rel="stylesheet" href="../assets/css/main.css?=1584529395">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Baloo Bhai">
        <title><?= $itemId ?></title>
    </head>
    <body>
        <?php 
            // include("pages/header.php");
            include("functions.php");

            // $sql_ = "SELECT * FROM coque WHERE Id_Coque = " . $itemId;
            // $result_ = mysqli_query($db_connec, $sql_);
            // $row = mysqli_fetch_row($result_);

            // echo $row;
        ?>

        <nav>
            <div class="navbar-container">
                <div class="logo">
                    <a href="../index.php"><h1>Motion Case</h1></a>
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

        <div class="images">
            <img id='mainImage' class='image' src='../assets/images/items/<?= $itemId ?>/principal.jpg'>
            <img class='image' src='../assets/images/items/<?= $itemId ?>/principal.jpg'>
            <img class='image' src='../assets/images/items/<?= $itemId ?>/second.jpg'>
            <img class='image' src='../assets/images/items/<?= $itemId ?>/third.jpg'>
            <img class='image' src='../assets/images/items/<?= $itemId ?>/fourth.jpg'>
            <img class='image' src='../assets/images/items/<?= $itemId ?>/fifth.jpg'>
        </div>
        <script src="../assets/js/item.js?=1584529395"></script>
        <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
    </body>
</html>