<?php
require "../db/DBSingleton.php";
$dbSingleton = DBSingleton::getInstance();
$db = $dbSingleton->getRedBean();
if (isset($_POST["usuario"]) && isset($_POST["pass"])) {
    $user = $db->getAll('select email, ApeNom from USER_ADMIN where email="' . $_POST["usuario"] . '" and pass="' . $_POST["pass"] . '"');
    if ($user) {
        session_start();
        $_SESSION['usuario'] = $user;
        header('Location: http://localhost/AllChancesAdmin/list.php');
        exit();
    } else {
        header('Location: http://localhost/AllChancesAdmin/error.php?error=login');
        exit();
    }
} else {
    header('Location: http://localhost/AllChancesAdmin/error.php');
    exit();
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

