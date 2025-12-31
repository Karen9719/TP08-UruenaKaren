<?php
    $ruta = '../';
    require('encabezado.php');
	require ('conexion.php');
	
?>
	<header class="w-100 d-flex justify-content-between align-items-center p-2 mb-4">
		<a href="configuracion.php">
			<img src="../img/engranaje.png" 
				 alt="Configuración" 
				 style="width:32px; height:32px;">
		</a>

		<section class="d-flex align-items-center me-3">
			<span class="text-white me-2"><?php echo $_SESSION['username'] ; ?></span>
			<?php
			  
				if ($_SESSION['foto'] != '') {
					// si el usuario tiene foto en la base de datos
				?>
					<img src="../img/usuarios/<?php echo $_SESSION['foto']; ?>" 
						 alt="Usuario" 
						 class="rounded-circle"
						 style="width:32px; height:32px; object-fit:cover;">
					<?php
				} else {
					// si no tiene foto cargada
					?>
					<img src="../img/usuarios/usuario_default.png" 
						 alt="Usuario" 
						 class="rounded-circle"
						 style="width:32px; height:32px; object-fit:cover;">
					<?php
				}
			?>
			<a href='logueo_cierre.php' class="btn btn-primary px-4 py-2">Cerrar Sesion</a>
		</section>
	</header>

<?php	

	
?>

<main class="container">
    <section class="row">
        <form action="" method="get" class="p-5 d-flex justify-content-start align-items-center">
            <label for="categoria" class="form-label me-3">Filtrar por categoría:</label>
            <select id="categoria" name="categoria" class="form-select w-25 me-3">
                <option value="">Ninguna</option>
                <option value="Celulares">Celulares</option>
                <option value="Electrodomésticos">Electrodomésticos</option>
                <option value="Televisores">Televisores</option>
            </select>
            <input type="text" name="busqueda" placeholder="Buscar..." class="form-control w-25 me-3">
            <button type="submit" class="btn btn-primary">Buscar</button>
        </form>
    </section>
<?php
	$conexion = conectar();

	//capturar filtros
	$categoria = "";
	$busqueda  = "";

	if (!empty($_GET['categoria'])) {
		$categoria = $_GET['categoria'];
	}

	if (!empty($_GET['busqueda'])) {
		$busqueda = $_GET['busqueda'];
	}

	//armar consulta según filtros

	//sin filtros
	if ($categoria == "" && $busqueda == "") {
		$consulta = "SELECT id_articulo, nombre, categoria, precio, foto FROM articulo";
		$sentencia = mysqli_prepare($conexion, $consulta);
	}

	//solo categoría
	elseif ($categoria != "" && $busqueda == "") {
		$consulta = "SELECT id_articulo, nombre, categoria, precio, foto FROM articulo
					 WHERE categoria = ?";
		$sentencia = mysqli_prepare($conexion, $consulta);
		mysqli_stmt_bind_param($sentencia, "s", $categoria);
	}

	//solo búsqueda por nombre
	elseif ($categoria == "" && $busqueda != "") {
		$consulta = "SELECT id_articulo, nombre, categoria, precio, foto FROM articulo
					 WHERE nombre LIKE ?";//LIKE permite buscar un texto aunque no coincida exactamente, sino que contenga una parte del texto que escribio el usuario, ej 'tel', sale telefono, televisor
		$buscado = "%".$busqueda."%"; // % es un comodin, cualquier cosa antes o cualquier cosa despues
		$sentencia = mysqli_prepare($conexion, $consulta);
		mysqli_stmt_bind_param($sentencia, "s", $buscado);
	}

	//categoría + nombre
	else {
		$consulta = "SELECT id_articulo, nombre, categoria, precio, foto FROM articulo
					 WHERE categoria = ? AND nombre LIKE ?";
		$buscado = "%".$busqueda."%";
		$sentencia = mysqli_prepare($conexion, $consulta);
		mysqli_stmt_bind_param($sentencia, "ss", $categoria, $buscado);
	}

	mysqli_stmt_execute($sentencia);//ejecuta la consulta preparada anteriormente, le pide a mysql que procese el SELECT, ir a la base de datos y traer las filas que coinciden con la consulta (aun no da valores, solo los ejecuta)
	mysqli_stmt_bind_result($sentencia, $id_articulo,$nombre, $categoria, $precio, $foto);//indica donde guardar los datos que mysql devuelve
	mysqli_stmt_fetch($sentencia);//avanza a la primera fila del resultado y copia los valores en las variables anteriores, en este caso como hay mas de una fila usamos do-while mas abajo para mostrar los resultados
?>

    <section>
        <article class="row text-center">
            <section class="d-flex justify-content-center pt-3">
                <table class="table table-bordered table-hover table-striped w-auto">
                    <caption class="caption-top text-center">Listado de articulos</caption>
                    <tr>
                        <th>Foto</th>
                        <th>Producto</th>
                        <th>Categoria</th>
                        <th>Precio</th>
						<?php
							if($_SESSION['tipo'] == 'Administrador' ){
						?>
							<th>Modificar</th>
							<th>Eliminar</th>
						<?php
						}else{
						?>
							<th>Comprar</th>
						<?php
						 }
						?>
                    </tr>
                    
                    <?php
						
                        if(!empty($nombre)){
							if($_SESSION['tipo'] == 'Administrador'){
								do{ 
									?>
									<tr>
										<th>	
										<?php
											
											if ($foto != '') {
												// si el articulo tiene foto en la base de datos
											?>
												<img src="../img/articulos/<?php echo $foto;?>" 
													 alt="articulo" 
													 style="width:64px; height:64px; object-fit:cover;">
												<?php
											} else {
												// si no tiene foto cargada
												?>
												<img src="../img/articulos/sin_imagen.png" 
													 alt="articulo" 
													 style="width:64px; height:64px; object-fit:cover;">
												<?php
											}
										?></th>
										<th><?php echo $nombre ?></th>
										<th><?php echo $categoria ?></th>
										<th><?php echo $precio ?></th>
										
										<!-- Columna MODIFICAR -->
										<th>
											<a href="articulo_modificacion.php?id=<?php echo $id_articulo; ?>">
												<img src="../img/modificar.png" 
													 alt="Modificar" 
													 style="width:24px; height:24px;">
											</a>
										</th>

										<!-- Columna ELIMINAR -->
										<th>
											<a href="articulo_eliminar.php?id=<?php echo $id_articulo; ?>">
												<img src="../img/eliminar.png" 
													 alt="Eliminar" 
													 style="width:24px; height:24px;">
											</a>
										</th>
		
									</tr>
								<?php	
								}while(mysqli_stmt_fetch($sentencia));
								desconectar($conexion);
							}else{
								do{
									?>
									<tr>
										<th>	
										<?php
											
											if ($foto != '') {
												// si el articulo tiene foto en la base de datos
											?>
												<img src="../img/articulos/<?php echo $foto;?>" 
													 alt="articulo" 
													 style="width:64px; height:64px; object-fit:cover;">
												<?php
											} else {
												// si no tiene foto cargada
												?>
												<img src="../img/articulos/sin_imagen.png" 
													 alt="articulo" 
													 style="width:64px; height:64px; object-fit:cover;">
												<?php
											}
										?></th>
										<th><?php echo $nombre ?></th>
										<th><?php echo $categoria ?></th>
										<th><?php echo $precio ?></th>
										
									<!--columna COMPRAR -->
										<th >
											<a href="reservar.php?id=<?php echo $id_articulo; ?>">
												<img src="../img/carrito.png" 
													 alt="Comprar" 
													 style="width:24px; height:24px;">
											</a>
										</th>
								<?php
								}while(mysqli_stmt_fetch ($sentencia));
								desconectar($conexion);
							}
						}
                    ?>
                </table>
            </section>
        </article>
    </section>
	<section class="d-flex justify-content-center my-5">
		<?php
			if($_SESSION['tipo'] == 'Administrador'){  
		?>
		<a href="articulo_alta.php" class="btn btn-primary px-4 py-2">+Alta Artículo</a>
		<?php
		 }else{ 
		?>
		<a href="articulo_carrito.php" class="btn btn-primary px-4 py-2">Mi carrito</a>
		<?php
		 }
		?>
	</section>

</main>

<?php
    require("pie.php");
?>