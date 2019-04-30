<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" /><!-- Bootstrap -->      
        <link rel="stylesheet" href="css/index.css" type="text/css"/><!-- Style -->
    </head>
    <body>
        <div class="cuerpo">
            <div class="row">
                <div class="titulo">
                    <?php

                        switch ($_GET["error"]) {
                            case "login":
                                echo 'Usuario o contraseña incorrecta.';   

                                break;
                            case "subirimagen":
                                echo 'Ocurrio un error al subir la imagen.';   

                                break;
                            case "moverimagen":
                                echo 'Ocurrio un error al mover la imagen.';   

                                break;
                            case "guardarimagen":
                                echo 'Ocurrio un error al guardar la imagen.';   

                                break;
                            case "sorteo":
                                echo 'Ocurrio un error guardar el sorteo.';   

                                break;
                            default:
                                echo 'Ups, algo salio mal.';
                                break;
                        }


                    ?>
                </div>
                <br>
                <div>
                    <img src="images/error.png" width="150" height="150"/>
                </div>
            </div>
        </div>
    </body>
</html>
