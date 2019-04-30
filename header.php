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
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta name="robots" content="noindex">
        <meta name="googlebot" content="noindex">
        <meta charset="UTF-8">

        <title>All Chances</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" /><!-- Bootstrap -->   
 
    </head>
    <body>
        <div class="page-header">    <!-- Header -->
            <h1>All-Chances</h1>
            <div style="text-align: right ">
                   Hola 
                   <b>
                   <?php
                   if (isset($_SESSION["usuario"][0]["ApeNom"])) {
                       echo $_SESSION["usuario"][0]["ApeNom"];
                   } else {
                       echo "usuario";
                   }
                   ?>  
                   
                   </b>
                   |
                   <a style="cursor:pointer;" onClick="logout()">Salir</a>
            </div>
        </div> 

        <!-- Fin Header -->
    </body>
        <!-- Cerrar sesion -->
    <script type="text/javascript" language="javascript">
        function logout(){
            if (confirm("¿Confirma que desea salir?")) {
              parent.window.location='index.php';
            } 
        };
    </script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script><!-- Bootstrap -->

</html>
