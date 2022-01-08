<?php
    session_start();
    if ($_SERVER['REQUEST_METHOD'] == "GET") {
        if (isset($_REQUEST['id'])) {
            $_SESSION['user'] = $_REQUEST['id'];
            header('location:http://kamgaro.com/Vendor/business');
        }
        else if (isset($_REQUEST['aid'])) {
            $_SESSION['agent'] = $_REQUEST['aid'];
            header('location:http://kamgaro.com/Agent/profile');
        }
        else if (isset($_REQUEST['cid'])) {
            $_SESSION['customer'] = $_REQUEST['cid'];
            header('location:http://kamgaro.com/Customer/profile');
        }
        else if (isset($_REQUEST['aaid'])) {
            $_SESSION['freelancer'] = $_REQUEST['aaid'];
            header('location:http://kamgaro.com/Freelancer/dashboard');
        }
        else if (isset($_REQUEST['acid'])) {
            $_SESSION['agency'] = $_REQUEST['acid'];
            header('location:http://kamgaro.com/Agency/dashboard');
        }
        else {
            header('location:http://kamgaro.com/Authority/dashboard');
        }
    }
?>