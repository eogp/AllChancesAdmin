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

//print_r($_POST);

//VERIFICO QUE EL ORIGEN DEL POST
if (isset($_POST['createRaffle'])) {

    //GENERO UN BEAN DE NOMBRE RAFFLES
    $raffles = $db->dispense("raffles");
    
    //CARGO COLUMNAS Y VALORES AL BEAN
    $raffles->category_id = $_POST['category'];
//    $raffles->coupon_id = null;
//    $raffles->sponsor_id = null;
    $raffles->title = $_POST['title'];
    $raffles->tagline = $_POST['tagline'];
    $raffles->description = $_POST['description'];
    $raffles->price = $_POST['price'];
    $raffles->raffle_start = date("Y-m-d",strtotime($_POST['raffle_start']));
    $raffles->raffle_end = date("Y-m-d",strtotime($_POST['raffle_end']));
    $raffles->highlighted = $_POST['highlighted'];
//    $raffles->winner_number = null;
    $raffles->created_at = date("Y-m-d H:i:s");
//     $raffles->updated_at = null;
     
    //GUARDO EL RAFFLES
    $id_raffles = $db->store($raffles);
    
    if(isset($id_raffles) && $id_raffles!=0){
        
        //SI NO SUBE LA IMAGEN BORRA EL RAFFLE Y TERMINA EL PROCESO
        $url_imagen=subirImagen($id_raffles);

        //GENERO UN BEAN DE NOMBRE showcase_images
        $db->exec( "INSERT INTO showcase_images (raffle_id,low,med,high,thumb,created_at)"
                . "VALUES(".$id_raffles.",'".$url_imagen."','".$url_imagen."','".$url_imagen."','".$url_imagen."','".date("Y-m-d H:i:s")."');" );
//        $showcase_image = $db->dispense("showcaseimages");
//        $showcase_image->raffle_id = $id_raffles;
//        $showcase_image->low = $url_imagen;
//        $showcase_image->med = $url_imagen;
//        $showcase_image->high = $url_imagen;
//        $showcase_image->thumb = $url_imagen;
//        $showcase_image->created_at = date("Y-m-d H:i:s");;
//        //    $showcase_images->updated_at = null;
        
        //GUARDO EL BEAN EN LA BD 
//        $id_showcase_images =$db->store($showcase_image);
        $id_showcase_image=$db->getInsertID();
        if(!isset($id_showcase_image) || $id_showcase_image==0){
            header('Location: http://localhost/AllChancesAdmin/error.php?error=guardarimagen');
            exit();
        }
    }
    else{
        
        header('Location: http://localhost/AllChancesAdmin/error.php?error=sorteo');
        exit();
    }
    //si guardo todo actualizo highlighted para los otros raffles
    if($_POST['highlighted']){
        $db->exec( 'UPDATE raffles SET highlighted=0 WHERE id !='.$id_raffles  );
    }
    //exito
    header('Location: http://localhost/AllChancesAdmin/list.php');
    exit();
}

//SUBIR IMAGENES Y RETORNAR RUTA EN SERVIDOR
function subirImagen($id_raffle) {
    // MODIFICAR RUTA AL SUBIR AL HOSTING
    $dir_subida = '/Applications/XAMPP//htdocs/AllChancesAdmin/showcase_image/';
    if (isset($_FILES['imagen'])) {
        //GUARDADO  DE IMAGEN
        $filename= $_FILES["imagen"]["name"];
        $file_ext = pathinfo($filename,PATHINFO_EXTENSION);
        
        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $dir_subida . 'imagen_raffle_id_' . $id_raffle . '.'.$file_ext)) {
            //return $dir_subida.'imagen_pantalla_id_'.$id_patalla;
            return 'http://localhost/AllChancesAdmin/showcase_image/' . 'imagen_raffle_id_' . $id_raffle.  '.'.$file_ext;
        }else{
            $raffle=$db->findOne( 'raffles', ' id = ? ', [$id_raffle]);
            $db->trash( $raffle );
            header('Location: http://localhost/AllChancesAdmin/error.php?error=moverimagen');
            exit();
        }
    }
    else{
        header('Location: http://localhost/AllChancesAdmin/error.php?error=subirimagen');
        exit();
        
    }
}