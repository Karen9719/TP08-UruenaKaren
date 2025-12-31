<?php
	function conectar()
	{
		$servidor='localhost:3307';
		$usuario = 'root';
		$clave ='';
		$nombreBaseDato = 'labo2';
		
		set_error_handler (function() {//establece una funcion controladora de errores
			throw new Exception("Error");
		});
		
		try{
			$conexion = mysqli_connect($servidor, $usuario, $clave, $nombreBaseDato);//conectar con base de datos
		}catch(Exception $e){ //atrapa el error
			$conexion = false;
		}
		
		return($conexion);
	}
	
	function desconectar($miConexion){
		if($miConexion){
			mysqli_close($miConexion); //desconectar
		}
	}
?>