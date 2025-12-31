<?php
    $ruta = '../';
    require("encabezado.php");
	require('conexion.php');
	$conexion = conectar();
	
	//verifico si llego un id 
	if(!empty($_GET['id']) && $conexion){
		$id= $_GET['id'];
		
		//traer datos del articulo
		$consulta = 'SELECT nombre, categoria, precio, foto FROM articulo WHERE id_articulo = ?';
		$sentencia = mysqli_prepare($conexion, $consulta);
		mysqli_stmt_bind_param($sentencia, "i", $id);
		mysqli_stmt_execute($sentencia);
		mysqli_stmt_bind_result($sentencia, $nombre, $categoria, $precio, $foto);
		mysqli_stmt_store_result($sentencia);
		$cantFilas = mysqli_stmt_num_rows($sentencia);
		if ($cantFilas > 0) {
			mysqli_stmt_fetch($sentencia);
		} else {
			echo "<p>No se encontró el artículo</p>";
		}

		desconectar($conexion);
		
	}
?>

<main class="container py-3">
        <section class="d-flex justify-content-center">
            <form class="p-4 border rounded w-50" action="articulo_modificacion_ok.php" method="POST" enctype="multipart/form-data">
                <fieldset>
                    <legend class="text-center mb-4">Modificación de Artículo</legend>

                    <input type="hidden" name="id_articulo" value="<?php echo $id;?>">

                    <label for="nombre" class="form-label">Nombre del artículo</label>
                    <input type="text" id="nombre" name="nombre" class="form-control mb-3" required value="<?php echo $nombre;?>">

                    <label for="categoria" class="form-label">Categoría</label>
                    <input type="text" id="categoria" name="categoria" class="form-control mb-3" required value="<?php echo $categoria;?>">

                    <label for="precio" class="form-label">Precio</label>
                    <input type="number" step="0.01" id="precio" name="precio" class="form-control mb-3" required value="<?php echo $precio;?>">

                    <label for="imagen" class="form-label">Subir imagen del artículo</label>
                    <input type="file" id="imagen" name="imagen" class="form-control mb-4">
					
					<!-- guardar el nombre de la foto original -->
					<input type="hidden" name="foto_original" value="<?php echo $foto; ?>">

                    <button type="submit" class="btn btn-primary w-100">Modificar</button>
                </fieldset>
            </form>
        </section>
    </main>

<?php
    require("pie.php");
?>