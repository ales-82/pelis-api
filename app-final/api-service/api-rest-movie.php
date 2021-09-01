<?php
class apiRestMovie{

	//method GET
	public static function getMovies($conexion){
		$sql = $conexion->prepare("SELECT * FROM pelicula ORDER BY id DESC");
		$sql->execute();
		//$sql->setFetchMode(PDO::FETCH_ASSOC);
		$datos=$sql->fetchAll(PDO::FETCH_ASSOC);

		echo json_encode($datos);
	}

	//method GET and Id
	public static function getIdMovie($conexion, $id){
		$sql = $conexion->prepare("SELECT * FROM pelicula WHERE id =:id");
		$sql->bindValue(':id',$id);
		$sql->execute();
		$datos=$sql->fetchAll(PDO::FETCH_ASSOC);
		echo json_encode($datos);
	}

	//METHOD POST
	public static function postMovie($conexion, $nombre, $year, $genero, $precio, $imagen){
		

		$sql = $conexion->prepare("INSERT INTO pelicula (nombre, year, genero, precio, imagen) VALUES(:nombre,:year,:genero,:precio,:imagen)");
		$sql->bindValue(':nombre',$nombre);
		$sql->bindValue(':year',$year);	
		$sql->bindValue(':genero',$genero);	
		$sql->bindValue(':precio',$precio);
		$sql->bindValue(':imagen',$imagen);
		$sql->execute();
	}

	//METODO ACTUALIZAR
	public static function updateMovie($conexion, $nombre, $year, $genero, $precio, $imagen, $id)
	{
		$sql = $conexion->prepare("UPDATE pelicula SET nombre=:nombre, year=:year, genero=:genero, precio=:precio, imagen=:imagen WHERE id=:id");
		$sql->bindValue(':nombre',$nombre);
		$sql->bindValue(':year',$year);
		$sql->bindValue(':genero',$genero);
		$sql->bindValue(':precio',$precio);
		$sql->bindValue(':imagen',$imagen);
		$sql->bindValue(':id',$id);
		$sql->execute();
		exit;
	}

	//METHOD ELIMINAR
	public static function deleteMovie($conexion, $id){
		$sql = $conexion->prepare("DELETE FROM pelicula where id=:id");
		$sql->bindValue(':id',$_GET['id']);
		echo  $sql->execute();
		exit();
	}
}