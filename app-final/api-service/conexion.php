<?php

class conexion{

	private static $conexion;	

	public static function OpenConexion()
	{
		if(!isset(self::$conexion)){
			try{
				define('DB_HOST','localhost');
				define('DB_USER','root');
				define('DB_PASS','');
				define('DB_DATABASE','api-service');
				define('DB_CHARSET','utf8');
				self::$conexion = new PDO('mysql:host=' . DB_HOST . "; dbname=" . DB_DATABASE, DB_USER, DB_PASS);
				self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				self::$conexion->exec("SET CHARACTER SET " . DB_CHARSET);
			}catch(PDOException $e){
				print "ERROR: " . $e->getMessage() . "<br>";
				exit();
			}
		}
	}

	public static function getConexion()
	{
		return self::$conexion;
	}

	public static function closeConexion()
	{
		if(isset(self::$conexion)){			
			self::$conexion = null;
		}
	}
}




