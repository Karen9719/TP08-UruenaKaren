<?php
	session_start();
	if(!empty($_SESSION['username']) && !empty($_GET['id'])){
		
		if(empty($_SESSION['carrito'])){
			$_SESSION['carrito'] = array();
			
		}
	}
	if (empty($_SESSION['carrito'][$_GET['id']])){//verifico si no esta
		$_SESSION['carrito'][$_GET['id']] = 1 ;
		
	}else{
		$_SESSION['carrito'][$_GET['id']]++;
	}
	echo ('<h3>Se guarda un producto en el carrito</h3>');
	print_r($_SESSION);
	header('refresh:1;url=articulo_listado.php');
	
?>