<?php
	session_start();

	// Determinar el tema según la cookie
	// valor por defecto
	if(!empty($_SESSION['username'])){
		$usuario = $_SESSION['username'];
		if (!empty($_COOKIE[$usuario])) {
			
			$tema = $_COOKIE[$usuario];
		}else{
		$tema = 'claro';
	 }
	}
	
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo $ruta ?>bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $ruta ?>css/estilo.css">
</head>
<body class="<?php echo $tema; ?>">
