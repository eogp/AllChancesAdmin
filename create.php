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
        <link rel="stylesheet" href="css/preview.css" type="text/css" /><!-- Preview -->

    </head>
    <body>
        <!-- Contenedor principal -->
        <div class="container-fluid">
            <!-- Header -->
            <embed src="http://localhost/AllChancesAdmin/header.php" width="100%"/>
            <!-- Fin Header -->
            <!-- Cuerpo -->
            <div class="container">
                <h3>Complete el formulario para crear un nuevo sorteo.</h3>
                <br>
                <form action="POST/createRaffle.php"method="post" enctype="multipart/form-data"  id="formulario" role="form">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="selectCategories">Categorías</label>
                                        <select name="category" class="form-control" id="selectCategories" required>
                                            <?php 
                                            require "db/DBSingleton.php";
                                            $dbSingleton = DBSingleton::getInstance();
                                            $db = $dbSingleton->getRedBean();

                                            $retorno = '';
                                            $categorias = $db->findAll('categories', ' ORDER BY category_name ');
                                            foreach ($categorias as $categoria) {
                                                $retorno = $retorno . '<option  value="'.$categoria->id.'">'.$categoria->category_name.'</option>';
                                            }
                                            echo $retorno;
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="dateStart">Fecha de inicio.</label>
                                        <input type="date" name="raffle_start" id="start" class="form-control" id="dateStart" required/>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="dateEnd">Fecha de finalización.</label>
                                        <input type="date" name="raffle_end" id="end" class="form-control" id="dateEnd" required/>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group" >
                                        <label for="inputPrice">Importe.</label>
                                        <input type="number" name="price" min="1" step="0.25" placeholder="$ 100.00" class="form-control" id="inputPrice" required/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">                            
                                        <label for="textAreaTitle">Título</label>     
                                        <textarea name="title" rows="3" cols="50" maxlength="255" placeholder="Máximo 255 caracteres..." id="textAreaTitle" class="form-control" required></textarea>
                                    </div> 
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="textAreaTagLine">Tagline</label>
                                        <textarea name="tagline" rows="6" cols="50" maxlength="255" placeholder="Máximo 255 caracteres..." id="textAreaTagLine" class="form-control" required></textarea>                          
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group" id="image-preview">
                                <label for="image-label">Imagen</label>
                                <input type="file" accept=".png, .jpg, .jpeg" name="imagen" id="image-upload" class="form-control-file" required/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="textAreaDescription">Descripción</label>                            
                                <textarea name="description"rows="10" cols="50" maxlength="1000" placeholder="Máximo 1000 caracteres..." id="textAreaDescription" class="form-control" required ></textarea>                           
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            
                        </div>
                        <div class="col-lg-4" style="text-align: center">
                            <div class="form-check">
                                <label for="checkboxHighlighted" style="font-size: 18px">Destacado</label>
                                <input type="checkbox" class="form-check-input" value="1" name="highlighted" id="checkboxHighlighted">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            
                        </div>
                         <div class="col-lg-4">
                            <div class="form-group">
                                <input type="submit"  name="createRaffle" value="Crear" class="btn btn-primary btn-lg btn-block"/>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Fin Cuerpo -->
        </div>
        <!-- Fin Contenedor principal -->
    </body>
    <script type="text/javascript" src="js/jquery-2.1.1.js"></script><!-- Jquery -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script><!-- Bootstrap -->
    <script type="text/javascript" src="js/jquery.uploadPreview.min.js"></script><!-- Preview -->
    <script type="text/javascript" src="js/preview.js"></script><!-- Preview -->
    <script type="text/javascript" language="javascript"> 
        $("#formulario").on('submit', function(evt){         
            if($("#start").val()>$("#end").val()){
                evt.preventDefault(); 
                alert("La fecha de finalización no puede ser menor a la de inicio.");
            }
        });
    </script>
</html>
