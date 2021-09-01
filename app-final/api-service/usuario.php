<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

include "conexion.php";

conexion::OpenConexion();

$conx=conexion::getConexion();

if($_POST['usuario'] && $_POST['password']){

    $sql="select * from usuario where nombre= :user and password= :pass";

    $setencia = $conx->prepare($sql);

    $user = $_POST["usuario"];
    $pass = $_POST["password"];

    $setencia->bindValue(":user",$user);
    $setencia->bindValue(":pass",$pass);

    $setencia->execute();

    $num_reg = $setencia->rowCount();



    if($num_reg===1){
    	$usuario = $setencia->fetchAll(PDO::FETCH_ASSOC);
    	
    	echo json_encode($usuario);

    }else{
		echo 0;
    }
}else{
	echo "no esta entrando en la condicion";
}

conexion::closeConexion();