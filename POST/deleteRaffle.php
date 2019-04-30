<?php
session_start();
/* Si no hay una sesión creada, redireccionar al login. */
if (isset($_SESSION['usuario'])) {
//    echo "Usuario logueado \n: ";
//    print_r($_SESSION['usuario']);
    //$usuario = $_SESSION['usuario'];
} else {
    session_destroy();
    header('Location: http://localhost/AllChancesAdmin/index.php');
    exit();
}

require "../db/DBSingleton.php";
//GENERO CONEXION A LA BD POR MEDIO DE BEAN
$dbSingleton = DBSingleton::getInstance();
$db = $dbSingleton->getRedBean();

if(isset($_POST['idRaffle'])){
        $db->exec( 'DELETE FROM raffles WHERE id ='.$_POST['idRaffle']  );
        $db->exec( 'DELETE FROM showcase_images WHERE raffle_id ='.$_POST['idRaffle']  );

        echo "1";
        exit();
}

//if (isset($_POST["user"]) && isset($_POST["apeNom"]) && isset($_POST['idRaffle'])) {
//    $user = $db->getAll('select email, ApeNom from USER_ADMIN where email="' . $_POST["user"] . '" and ApeNom="' . $_POST["apeNom"] . '"');
//    if ($user) {
//        $db->exec( 'DELETE raffles WHERE id ='.$_POST['idRaffle']  );
//        $db->exec( 'DELETE showcase_images WHERE raffle_id ='.$_POST['idRaffle']  );
//
//        echo "1";
//        exit();
//    } 
//}

