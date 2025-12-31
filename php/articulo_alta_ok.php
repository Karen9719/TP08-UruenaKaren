<?php
	session_start();

	if (empty($_SESSION['username'])) {
		header("refresh:2;url=../index.php");
	}
	require_once 'conexion.php';
	
	if(!empty($_POST['nombre']) && !empty($_POST['categoria']) && !empty($_POST['precio']) && !empty($_FILES['imagen']['size'])){
		
		$conexion = conectar();
		if($conexion){//controla que se haya creado la conexion
			$nombre = $_POST['nombre'];
			$categoria = $_POST['categoria'];
			$precio = $_POST['precio'];
			$foto_nombre = $_FILES['imagen']['name'];
			
			$temporal = $_FILES['imagen']['tmp_name'];

			//mover imagen a carpeta
			move_uploaded_file($temporal, "../img/articulos/" . $foto_nombre);		
		
			$consulta = 'INSERT INTO articulo(nombre, categoria, precio, foto) VALUES (?, ?, ?, ?)';
			
			$sentencia = mysqli_prepare ($conexion, $consulta); //preparo consulta
			mysqli_stmt_bind_param($sentencia, 'ssds',$nombre, $categoria, $precio, $foto_nombre);
			$q = mysqli_stmt_execute($sentencia); //ejecuto consulta
			if($q){
				echo '<p>guardado exitoso</p>';
				header('refresh:2;url=articulo_listado.php');
			}else{
				echo '<p>error al guardar</p>';
			}
			desconectar($conexion);
		}
	}else{
		echo'<p>Debe ingresar datos al formulario</p>';
		header('refresh:3;url=articulo_alta.php');
	}

?>