<?php
	session_start();
	
	if(!empty($_SESSION['username'])){
		header('refresh:1; ../index.php');
		echo '<h2>Está saliendo de la sesión</h2>';
		session_destroy();
	}else{
		header('refresh:1; ../index.php');
		echo '<h2>No inicio sesión</h2>';
	}
?>
