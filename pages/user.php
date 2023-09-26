<?php 
    require_once('db.php');
    require_once('functions.php');
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="assets/css/user.css?=1584529395">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Baloo Bhai">
        <title>Motion Case | User</title>
    </head>
    <body>
        <div class="main-container">
            <?php
                if (IfUserIsLogin()) {
                    echo '<h1>Welcome ' . $_SESSION['user']['login'] . '</h1>';
                    echo '<h2>Here is your informations :</h2>';
                    echo '<h3>Name : ' . $_SESSION['user']['name'] . '</h3>';
                    echo '<h3>Mail : ' . $_SESSION['user']['mail'] . '</h3>';
                    echo '<h3>Admin : ' . $_SESSION['user']['admin'] . '</h3>';
                    echo '<a href="pages/logout.php">Logout</a>';
                } else {
                    echo '<h1>ERROR !</h1>';
                }
            ?>
        </div>
        <script src="../assets/js/user.js"></script>
    </body>
</html>