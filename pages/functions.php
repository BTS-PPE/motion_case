<?php
    // function CreateCart() {
    //     if (!isset($_SESSION['cart'])) {
    //         $_SESSION['cart'] = array();
    //     }
    // }

    function GetCart() {
        return $_SESSION['cart'];
    }

    function GetAllImagesFromMotif($motif) {
        $images = array();
        $folder = "../assets/images/items/" . $motif . "/";
        $imagesFolder = glob($folder . "*.{png,jpg,gif}", GLOB_BRACE);
        foreach ($imagesFolder as $filename) {
            array_push($images, basename($filename));
        }
        return $images;
    }

    function AddToCart($id) {
        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]++;
        } else {
            $_SESSION['cart'][$id] = 1;
        }
    }

    function RemoveFromCart($id) {
        if (isset($_SESSION['cart'][$id])) {
            unset($_SESSION['cart'][$id]);
        }
    }

    function GetCartCount() {
        $count = 0;
        foreach ($_SESSION['cart'] as $key => $value) {
            $count += $value;
        }
        return $count;
    }

    function GetCartTotal() {
        $total = 0;
        foreach ($_SESSION['cart'] as $key => $value) {
            $total += $value * GetItemPrice($key);
        }
        return $total;
    }

    function IfUserIsLogin() {
        if (isset($_SESSION['user']['login'])) {
            return true;
        } else {
            return false;
        }
    }

    function CheckIfUserExist($type) {
        require("db.php");

        $password = hash('sha256', $_POST["password"]);
        $sql = "SELECT * FROM `customer` WHERE login = '" . $_POST[$type] . "' AND mdp = '" . $password . "'";
        $result = mysqli_query($db_customer, $sql);

        if (mysqli_num_rows($result) > 0) {
            return true;
        } else {
            return false;
        }
    }

    function LoginUser() {
        if (CheckIfUserExist("username")) {
            require("db.php");
            $password = hash('sha256', $_POST["password"]);
            $sql = "SELECT * FROM `customer` WHERE login = '" . $_POST["login"] . "' AND mdp = '" . $password . "'";
            $result = mysqli_query($db_customer, $sql);
            if ($result) {
                if (!isset($_SESSION["user"])) {
                    $_SESSION["user"] = array();
                }
                while ($row = mysqli_fetch_assoc($result)) {
                    $_SESSION["user"]["login"] = $row["login"];
                    $_SESSION["user"]["mail"] = $row["mail"];
                    $_SESSION["user"]["name"] = $row["nom"];
                    $_SESSION["user"]["admin"] = $row["admin"];
                }
                header("Location: index.php");
            } else {
                header("Location: pages/login.php");
            }

        } else {
            header("Location: pages/login.php");
        }
    }

    function CreateNewUser() {
        if (!CheckIfUserExist("login")) {
            require("db.php");
            $password = hash('sha256', $_POST["password"]);
            $sql = "INSERT INTO `customer` (login, mdp, mail, nom, prenom, admin) VALUES ('" . $_POST["login"] . "', '" . $password . "', '" . $_POST["email"] . "', '" . $_POST["name"] . "', 'Test', '0')";
            $result = mysqli_query($db_customer, $sql);
            if ($result) {
                if (!isset($_SESSION["user"])) {
                    $_SESSION["user"] = array();
                }
                while ($row = mysqli_fetch_assoc($result)) {
                    $_SESSION["user"]["login"] = $row["login"];
                    $_SESSION["user"]["mail"] = $row["mail"];
                    $_SESSION["user"]["name"] = $row["name"];
                    $_SESSION["user"]["admin"] = $row["admin"];
                };
                return true;
                header("Location: ../index.php");
            } else {
                return false;
                header("Location: pages/login.php");
            }
        } else {
            header("Location: pages/login.php");
        }
    }

    // Functions for the cart system (add, remove, get total, etc.)
    function CreateCart(){
        if (!isset($_SESSION['panier'])){
            $_SESSION['panier']=array();
            $_SESSION['panier']['libelleProduit'] = array();
            $_SESSION['panier']['qteProduit'] = array();
            $_SESSION['panier']['prixProduit'] = array();
            $_SESSION['panier']['verrou'] = false;
        }
        return true;
    }

    function AddItemToCart($libelleProduit,$qteProduit,$prixProduit){
        //Si le panier existe
        if (CreateCart() && !IsLocked()) {
           //Si le produit existe déjà on ajoute seulement la quantité
           $positionProduit = array_search($libelleProduit,  $_SESSION['panier']['libelleProduit']);
     
           if ($positionProduit !== false)
           {
              $_SESSION['panier']['qteProduit'][$positionProduit] += $qteProduit ;
           }
           else
           {
              //Sinon on ajoute le produit
              array_push( $_SESSION['panier']['libelleProduit'],$libelleProduit);
              array_push( $_SESSION['panier']['qteProduit'],$qteProduit);
              array_push( $_SESSION['panier']['prixProduit'],$prixProduit);
           }
        } else {
            echo "Un problème est survenu veuillez contacter l'administrateur du site.";
        }
    }

    function DeleteItemFromCart($libelleProduit){
        //Si le panier existe
        if (CreateCart() && !IsLocked()) {
           //Nous allons passer par un panier temporaire
           $tmp=array();
           $tmp['libelleProduit'] = array();
           $tmp['qteProduit'] = array();
           $tmp['prixProduit'] = array();
           $tmp['verrou'] = $_SESSION['panier']['verrou'];
     
           for($i = 0; $i < count($_SESSION['panier']['libelleProduit']); $i++)
           {
              if ($_SESSION['panier']['libelleProduit'][$i] !== $libelleProduit)
              {
                 array_push( $tmp['libelleProduit'],$_SESSION['panier']['libelleProduit'][$i]);
                 array_push( $tmp['qteProduit'],$_SESSION['panier']['qteProduit'][$i]);
                 array_push( $tmp['prixProduit'],$_SESSION['panier']['prixProduit'][$i]);
              }
     
           }
           //On remplace le panier en session par notre panier temporaire à jour
           $_SESSION['panier'] = $tmp;
           //On efface notre panier temporaire
           unset($tmp);
        } else {
            echo "Un problème est survenu veuillez contacter l'administrateur du site.";
        }
    }

    function EditQtqOfItem($libelleProduit,$qteProduit){
        //Si le panier existe
        if (CreateCart() && !IsLocked())
        {
           //Si la quantité est positive on modifie sinon on supprime l'article
           if ($qteProduit > 0)
           {
              //Recherche du produit dans le panier
              $positionProduit = array_search($libelleProduit,  $_SESSION['panier']['libelleProduit']);
     
              if ($positionProduit !== false)
              {
                 $_SESSION['panier']['qteProduit'][$positionProduit] = $qteProduit ;
              }
           }
           else
           DeleteItemFromCart($libelleProduit);
        }
        else
        echo "Un problème est survenu veuillez contacter l'administrateur du site.";
    }

    function MontantGlobal(){
        $total=0;
        for($i = 0; $i < count($_SESSION['panier']['libelleProduit']); $i++)
        {
           $total += $_SESSION['panier']['qteProduit'][$i] * $_SESSION['panier']['prixProduit'][$i];
        }
        return $total;
    }

    function IsLocked(){
        if (isset($_SESSION['panier']) && $_SESSION['panier']['verrou'])
            return true;
        else
            return false;
    }

    function CountItems() {
        if (isset($_SESSION['panier']))
            return count($_SESSION['panier']['libelleProduit']);
        else
            return 0;
    }

    function DeleteCart(){
        unset($_SESSION['panier']);
    }

?>