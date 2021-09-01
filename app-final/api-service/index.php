<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

include "conexion.php";

include "api-rest-movie.php";

conexion::OpenConexion();

$conx=conexion::getConexion();

if($_SERVER['REQUEST_METHOD']=='GET')
{
    if(isset($_GET['id']))
    {
        $id=$_GET['id'];        

        $api = apiRestMovie::getIdMovie($conx,$id);        
        
    }else{

        $api = apiRestMovie::getMovies($conx);

    }    
} 

if($_SERVER['REQUEST_METHOD']=='POST'){     

   $nombre = $_POST['nombre'];
   $year = $_POST['agno']; 
   $genero = $_POST['genero'];     
   $precio = $_POST['precio'];     
   $imagen = $_FILES['imagen']['name'];


     $target = "C:/xampp/htdocs/api-service/image/";

     $targetImg = $target.basename($imagen);

     $mover = move_uploaded_file($_FILES['imagen']['tmp_name'], $targetImg);
     

     // si existe un  id, actualizo el registro del producto
     // de lo contrario, solo inserto un producto mas
    if(isset($_GET['id'])){
        
        $id=$_GET['id'];

        apiRestMovie::updateMovie($conx,$nombre,$year,$genero,$precio,$imagen,$id);

    }else{

        apiRestMovie::postMovie($conx,$nombre,$year,$genero,$precio,$imagen);    
    }
}


if($_SERVER['REQUEST_METHOD']=='DELETE')
{
	if(isset($_GET['id']))
    {
        $id=$_GET['id'];        

        $api = apiRestMovie::deleteMovie($conx,$id);
        return $id;
        
    }
}

conexion::closeConexion();