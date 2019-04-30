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
        <!-- Contenedor principal -->
        <div class="container-fluid">
            <!-- Header -->
            <embed src="http://localhost/AllChancesAdmin/header.php" width="100%"/>
            <!-- Fin Header -->
            <!-- Cuerpo -->
            <div>
                <div>
                    <a href="http://localhost/AllChancesAdmin/create.php" class="btn btn-primary" role="button" aria-pressed="true">Nuevo</a>
                     <- Haga click aquí para agregar un sorteo a la lista.
                </div>
                <br>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr >
                            <th scope="col">
                                Título
                            </th >
                            <th scope="col">
                                Inicio
                            </th>
                            <th scope="col">
                                Fin
                            </th>
                            <th scope="col">
                                Categoría
                            </th>
                            <th scope="col" >
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require "db/DBSingleton.php";
                        $dbSingleton = DBSingleton::getInstance();
                        $db = $dbSingleton->getRedBean();
                        
                        $retorno = '';
                        $raffles = $db->getAll(
                           'SELECT raffles.*,categories.category_name FROM raffles
                            INNER JOIN categories 
                            on raffles.category_id = categories.id');

                        foreach ($raffles as $raffle) {
                            $resaltar='';
                            if($raffle['highlighted']){
                                $resaltar='style="background-color: yellow;"';
                            }
                            $retorno = $retorno . '<tr '.$resaltar.'>'
                            . '<td>' . $raffle['title'] . '</td>' 
                            . '<td>' . date("d-m-Y", strtotime(substr ( $raffle['raffle_start'], 0 , 10 ) )) . '</td>' 
                            . '<td>' . date("d-m-Y", strtotime(substr ( $raffle['raffle_end'], 0 , 10 ) )) . '</td>' 
                            . '<td>' . $raffle['category_name'] . '</td>' 
                            . '<td>  <a href="http://localhost/AllChancesAdmin/edit.php?id='. $raffle['id'] .'" class="btn btn-success btn-xs" role="button" aria-pressed="true">Editar</a> '
                            . '<button type="button" class="btn btn-danger btn-xs" onClick="deleteRaffle('. $raffle['id'] . ')">Borrar </button> </td>';
                         
                            $retorno = $retorno . "</tr>";
                        }
                        echo $retorno;
                        ?> 
                    </tbody>
                </table>

            </div>
            <!-- Fin Cuerpo -->
        </div>
        <!-- Fin Contenedor principal -->
    </body>
    <script type="text/javascript" src="js/jquery-2.1.1.js"></script><!-- Jquery -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script><!-- Bootstrap -->
    <script type="text/javascript" language="javascript">
        function deleteRaffle(id){
            if (confirm("¿Confirma que desea eliminar el sorteo?")) {
                $.post("POST/deleteRaffle.php", {idRaffle: id}, 
                                                function(retorno){
                                                    if(retorno="1"){
                                                        parent.window.location='list.php';
                                                    }else{
                                                        alert("Se produjo un error al intentar borrar el sorteo.");
                                                    }
                                                });
                console.log(id);                                    
            } 
        };
    </script>
</html>
