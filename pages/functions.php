<?php
    function CreateCart() {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }
    }

    function GetCart() {
        return $_SESSION['cart'];
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

    function CheckIfUserExist($type) {
        require("db.php");

        $sql = "SELECT * FROM `customer` WHERE login = '" . $_POST[$type] . "' AND mdp = '" . $_POST["password"] . "'";
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
            $sql = "SELECT * FROM `customer` WHERE login = '" . $_POST["login"] . "' AND mdp = '" . $_POST["password"] . "'";
            $result = mysqli_query($db_customer, $sql);
            if ($result) {
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
            $sql = "INSERT INTO `customer` (login, mdp, mail, nom, prenom, admin) VALUES ('" . $_POST["login"] . "', '" . $_POST["password"] . "', '" . $_POST["email"] . "', '" . $_POST["name"] . "', 'Test', '0')";
            $result = mysqli_query($db_customer, $sql);
            if ($result) {
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
?>