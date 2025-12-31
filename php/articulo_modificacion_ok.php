<?php
	session_start();

	if (empty($_SESSION['username'])) {
		header("refresh:2;url=../index.php");
	}
	require('conexion.php');
	$conexion = conectar();

	if ($conexion && !empty($_POST['id_articulo'])) {

		$id = $_POST['id_articulo'];
		$nombre = $_POST['nombre'];
		$categoria = $_POST['categoria'];
		$precio = $_POST['precio'];
		$foto_original = $_POST['foto_original'];

		//control foto
		if (!empty($_FILES['imagen']['name'])) {

			//nueva foto
			$nombre_foto = $_FILES['imagen']['name'];
			$ruta_temp = $_FILES['imagen']['tmp_name'];
			$ruta_final = "../img/articulos/" . $nombre_foto;

			// mover nueva foto
			move_uploaded_file($ruta_temp, $ruta_final);

			// eliminar foto anterior SOLO si existe
			if ($foto_original != "") {
				$ruta_anterior = "../img/articulos/" . $foto_original;
				if (file_exists($ruta_anterior)) {
					unlink($ruta_anterior);
				}
			}

		} else {
			// no se subio foto: guardar cadena vacía y borrar foto anterior
			$nombre_foto = "";

			if ($foto_original != "") {
				$ruta_anterior = "../img/articulos/" . $foto_original;
				if (file_exists($ruta_anterior)) {
					unlink($ruta_anterior);
				}
			}
		}

		$consulta = "UPDATE articulo 
					 SET nombre=?, categoria=?, precio=?, foto=? 
					 WHERE id_articulo=?";
		$sentencia = mysqli_prepare($conexion, $consulta);
		mysqli_stmt_bind_param($sentencia, "ssdsi", $nombre, $categoria, $precio, $nombre_foto, $id);

		$q = mysqli_stmt_execute($sentencia);

		if ($q) {
			echo "<p>modificacion exitoa</p>";
			header('refresh:2;url=articulo_listado.php');
		} else {
			echo "<p>no se pudo modificar el artículo</p>";
		}

		desconectar($conexion);

	} else {
		echo "<p>no se recibieron datos válidos</p>";
	}
?>

