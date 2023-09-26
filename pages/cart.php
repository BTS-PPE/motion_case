<?php
    session_start();
    include_once("functions.php");

    $erreur = false;

    $action = (isset($_POST['action'])? $_POST['action']:  (isset($_GET['action'])? $_GET['action']:null )) ;
    if($action !== null)
    {
    if(!in_array($action,array('ajout', 'suppression', 'refresh')))
    $erreur=true;

    //récupération des variables en POST ou GET
    $l = (isset($_POST['l'])? $_POST['l']:  (isset($_GET['l'])? $_GET['l']:null )) ;
    $p = (isset($_POST['p'])? $_POST['p']:  (isset($_GET['p'])? $_GET['p']:null )) ;
    $q = (isset($_POST['q'])? $_POST['q']:  (isset($_GET['q'])? $_GET['q']:null )) ;

    //Suppression des espaces verticaux
    $l = preg_replace('#\v#', '',$l);
    //On vérifie que $p est un float
    $p = floatval($p);

    //On traite $q qui peut être un entier simple ou un tableau d'entiers
        
    if (is_array($q)){
        $QteArticle = array();
        $i=0;
        foreach ($q as $contenu){
            $QteArticle[$i++] = intval($contenu);
        }
    }
    else
    $q = intval($q);
        
    }

    if (!$erreur){
    switch($action){
        Case "ajout":
            AddItemToCart($l,$q,$p);
            header('Location: cart.php');
            break;

        Case "suppression":
            DeleteItemFromCart($l);
            header('Location: cart.php');
            break;

        Case "refresh" :
            for ($i = 0 ; $i < count($QteArticle) ; $i++) {
                EditQtqOfItem($_SESSION['panier']['libelleProduit'][$i], round($QteArticle[$i]));
            }
            break;

        Default:
            break;
    }
    }

    echo '<?xml version="1.0" encoding="utf-8"?>';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
    <head>
        <link rel="stylesheet" href="../assets/css/cart.css?=1584529395">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Baloo Bhai">
        <title>Votre panier</title>
    </head>
    
    <body>
        <center><h1><a href="../index.php">Motion Case</a> | Votre panier</h1></center>
        <form method="post" action="cart.php">
            <div class="main-container">
                <?php 
                    if (CreateCart()) {
                        $nbArticles=count($_SESSION['panier']['libelleProduit']);
                        if ($nbArticles <= 0) {
                            echo "<span class='title'>Votre panier est vide</span>";
                        } else {
                            for ($i=0 ;$i < $nbArticles ; $i++) {
                                echo "<div class='item'>";
                                echo "<div class='item-img'>";
                                echo "<img src='../assets/images/items/".htmlspecialchars($_SESSION['panier']['libelleProduit'][$i])."/principal.jpg'>";
                                echo "</div>";
                                echo "<div class='item-info'>";
                                echo "<h2>".htmlspecialchars($_SESSION['panier']['libelleProduit'][$i])."</h2>";
                                echo "<h3>Prix du produit : ".htmlspecialchars($_SESSION['panier']['prixProduit'][$i])." €</h3>";
                                echo "<h3>Quantité : <input type=\"number\" size=\"4\" name=\"q[]\" value=\"".htmlspecialchars($_SESSION['panier']['qteProduit'][$i])."\"/></h3>";
                                echo "<h3> Prix : ".htmlspecialchars($_SESSION['panier']['prixProduit'][$i] * $_SESSION['panier']['qteProduit'][$i])." €</h3>";
                                echo "<a href=\"".htmlspecialchars("cart.php?action=suppression&l=".rawurlencode($_SESSION['panier']['libelleProduit'][$i]))."\"><i class='fa fa-times-circle' style='color: #0C0B0B;'></i></a>";
                                echo "</div>";
                                // echo "<td>".htmlspecialchars($_SESSION['panier']['libelleProduit'][$i])."</ td>";
                                // echo "<td><input type=\"text\" size=\"4\" name=\"q[]\" value=\"".htmlspecialchars($_SESSION['panier']['qteProduit'][$i])."\"/></td>";
                                // echo "<td>".htmlspecialchars($_SESSION['panier']['prixProduit'][$i])."</td>";
                                echo "<td></td>";
                                echo "</div>";
                            }

                            echo "<tr><td colspan=\"2\"> </td>";
                            echo "<td colspan=\"2\">";
                            echo "<h1>Total : ".MontantGlobal()." €</h1>";
                            echo "</td></tr>";

                            echo "<tr><td colspan=\"4\">";
                            echo "<input type=\"submit\" value=\"Rafraichir\"/>";
                            echo "<input type=\"hidden\" name=\"action\" value=\"refresh\"/>";
                            echo "</td></tr>";
                        }
                    }
                ?>
                <!-- <div class="item">
                    <div class="item-img">
                        <img src="../assets/images/items/Neutre/principal.jpg">
                    </div>
                    <div class="item-info">
                        <h2>Item name</h2>
                        <h3>Item price</h3>
                        <h3>Item quantity</h3>
                        <h3>Item total price</h3>
                        <i class="fa fa-times-circle" style="color: #0C0B0B;"></i>
                    </div>
                </div> -->
                <!-- <div class="item">
                    <div class="item-img">
                        <img src="../assets/images/items/Neutre/principal.jpg">
                    </div>
                    <div class="item-info">
                        <h2>Item name</h2>
                        <h3>Item price</h3>
                        <h3>Item quantity</h3>
                        <h3>Item total price</h3>
                        <input type="button" onclick="" value="Ajouter au panier">
                        <i class="fa fa-times-circle" style="color: #0C0B0B;"></i>
                    </div>
                </div> -->
                <?php
                    // if (CreateCart()) {
                    //     $nbArticles=count($_SESSION['panier']['libelleProduit']);
                    //     if ($nbArticles <= 0) {
                    //         echo "<tr><td>Votre panier est vide </td></tr>";
                    //     } else {
                    //         for ($i=0 ;$i < $nbArticles ; $i++)
                    //         {
                    //             echo "<tr>";
                    //             echo "<td>".htmlspecialchars($_SESSION['panier']['libelleProduit'][$i])."</ td>";
                    //             echo "<td><input type=\"text\" size=\"4\" name=\"q[]\" value=\"".htmlspecialchars($_SESSION['panier']['qteProduit'][$i])."\"/></td>";
                    //             echo "<td>".htmlspecialchars($_SESSION['panier']['prixProduit'][$i])."</td>";
                    //             echo "<td><a href=\"".htmlspecialchars("cart.php?action=suppression&l=".rawurlencode($_SESSION['panier']['libelleProduit'][$i]))."\">XX</a></td>";
                    //             echo "</tr>";
                    //         }

                    //         echo "<tr><td colspan=\"2\"> </td>";
                    //         echo "<td colspan=\"2\">";
                    //         echo "Total : ".MontantGlobal();
                    //         echo "</td></tr>";

                    //         echo "<tr><td colspan=\"4\">";
                    //         echo "<input type=\"submit\" value=\"Rafraichir\"/>";
                    //         echo "<input type=\"hidden\" name=\"action\" value=\"refresh\"/>";

                    //         echo "</td></tr>";
                    //     }
                    // }
                ?>
            </div>
            <!-- <table class='container' style="width: 400px">
                <tr>
                    <td colspan="4">Votre panier</td>
                </tr>
                <tr>
                    <td>Libellé</td>
                    <td>Quantité</td>
                    <td>Prix Unitaire</td>
                    <td>Action</td>
                </tr>

            </table> -->
        </form>
    </body>
</html>