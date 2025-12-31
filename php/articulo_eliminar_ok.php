<?php
	require_once 'conexion.php';
	$conexion = conectar();
	if($conexion && !empty($_GET['id'])){
		$id = $_GET['id'];
		$consulta = 'DELETE FROM articulo WHERE  id_articulo = ?';
		$sentencia = mysqli_prepare ($conexion, $consulta);
		mysqli_stmt_bind_param($sentencia, 'i', $id);
		$resultado = mysqli_stmt_execute($sentencia);
		
		if($resultado){
			echo '<p>Eliminacion exitosa</p>';
			header('refresh:2;url=articulo_listado.php');
		}else{
			echo '<p>No se pudo eliminar</p>';
			header('refresh:2;url=articulo_listado.php');
		}
		desconectar($conexion);
						
		
	}else{
		echo '<p>No se realizo la eliminacion</p>';
		header('refresh:2;url=articulo_listado.php');
	}


?>
