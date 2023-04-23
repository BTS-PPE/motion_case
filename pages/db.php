<?php 
    $db_connec = mysqli_connect("localhost", "root", "", "motion_case");
    $db_connec->set_charset("utf8");
    $db_customer = mysqli_connect("localhost", "root", "", "motion_case_customers");
    $db_customer->set_charset("utf8");
    if (!$db_connec && !$db_customer) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>