<?php
	session_start();
	if(!empty($_POST) && !empty($_SESSION['username'])){
		$unido = implode ('-', $_POST);
		$usuario = $_SESSION['username'];
		$tiempo_expira = time() + 30 + 24 * 60 +60;
		setcookie($usuario, $unido, $tiempo_expira, '/');
		// Redirigir al listado 
		header("refresh:1;url=articulo_listado.php");
	}
	
?>