<?php 
    require_once("db.php");
    $itemId = $_GET["id"];
    $sql = "SELECT * FROM coque JOIN `motif` ON coque.Id_motif = motif.Id_motif AND coque.Id_Coque = " . $itemId . " JOIN `modele` ON coque.Id_modele = modele.Id_modele";
    $itemResult = mysqli_query($db_connec, $sql);
    $item = mysqli_fetch_assoc($itemResult);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../assets/css/item.css?=1584529395">
        <link rel="stylesheet" href="../assets/css/main.css?=1584529395">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Baloo Bhai">
        <title>Motion Case | <?= $item["motif"] ?></title>
    </head>
    <body>
        <?php 
            // include("pages/header.php");
            include("functions.php");

            // $sql_ = "SELECT * FROM coque WHERE Id_Coque = " . $itemId;
            // $result_ = mysqli_query($db_connec, $sql_);
            // $row = mysqli_fetch_row($result_);

            // echo $row;
            if (isset($_POST["searchBar"])) {
                header("Location: ../index.php");
            }
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
                    <li><a id="login" href="login.php"><i class="fas fa-user-alt"></i></a></li>
                    <li><a id="cart" href="cart.php"><i class="fas fa-shopping-cart"></i></a></li>
                </ul>
            </div>
        </nav>

        <div class="container">
            <div class="images">
                <img id='mainImage' class='image' src='../assets/images/items/<?= $item["motif"] ?>/principal.jpg'>
                <img class='image' src='../assets/images/items/<?= $item["motif"] ?>/principal.jpg'>
                <img class='image' src='../assets/images/items/<?= $item["motif"] ?>/second.jpg'>
                <img class='image' src='../assets/images/items/<?= $item["motif"] ?>/third.jpg'>
                <img class='image' src='../assets/images/items/<?= $item["motif"] ?>/fourth.jpg'>
                <img class='image' src='../assets/images/items/<?= $item["motif"] ?>/fifth.jpg'>
            </div>

            <div class="details-container">
                <h2><?= $item["motif"] ?></h2>
                <p><?= $item["modele"] ?></p>
                <p>Prix : <?= $item["Prix"] ?>€</p>
                <p>Description : <?= $item['description'] ?></p>
                <?php echo '<input type="button" onclick="location.href=`cart.php?action=ajout&amp;l='.$item['motif'].'&amp;q=1&amp;p='.$item['Prix'].'`" value="Ajouter au panier">'; ?>
                <!-- <button type="submit">Ajouter au panier</button> -->
            </div>
        </div>

        <script src="../assets/js/item.js?=1584529395"></script>
        <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
    </body>
</html>