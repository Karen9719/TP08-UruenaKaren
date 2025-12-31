<?php
	$ruta = '../';
	require("encabezado.php");
	require_once 'conexion.php';
	$conexion = conectar();
	
	if ($conexion && !empty($_GET['id'])) {
		$id = $_GET['id'];

		// Traer el nombre del artículo
		$consulta = 'SELECT nombre, categoria, precio FROM articulo WHERE id_articulo = ?';
		$sentencia = mysqli_prepare($conexion, $consulta);
		mysqli_stmt_bind_param($sentencia, 'i', $id);
		mysqli_stmt_execute($sentencia);
		mysqli_stmt_bind_result($sentencia, $nombre, $categoria, $precio);
		mysqli_stmt_store_result($sentencia);
		$cantFilas = mysqli_stmt_num_rows($sentencia);
		if($cantFilas>0){
			echo '<main class="container-fluid" style="background-color:#6FA8A1; min-height:70vh;">
				<section class="row justify-content-center">
					<section class="col-12 col-md-6 text-center py-5">

						<h2 class="text-white mb-4">Eliminar artículo</h2>';
			while(mysqli_stmt_fetch($sentencia)){
				echo '
					<p class="text-white fs-5">
						¿Está seguro que quiere eliminar el artículo 
						<strong>' . $nombre . '</strong>?
					</p>

					<section class="mt-4">
						<a href="articulo_eliminar_ok.php?id=' . $id . '" 
						   class="btn btn-primary px-4 me-3">Aceptar</a>
						<a href="articulo_listado.php" 
						   class="btn btn-secondary px-4">Cancelar</a>
					</section>
				';
			}

			echo '
					</section>
				</section>
			</main>
			';
		}
		
		desconectar($conexion);
	}

?>

<?php require("pie.php"); ?>
