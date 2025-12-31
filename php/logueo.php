<?php
	session_start();
	require_once'conexion.php';

	if (!empty($_POST['username']) && !empty($_POST['password'])){ 

		$conexion = conectar();
		if($conexion){
		
			$usuario = $_POST['username'];
			$clave = sha1($_POST['password']);
			$consulta = 'SELECT usuario, pass, tipo,  foto FROM usuario WHERE usuario = ? AND pass = ? ';
			$sentencia = mysqli_prepare($conexion, $consulta);//preparo la consulta
			mysqli_stmt_bind_param($sentencia, 'ss', $usuario, $clave);//vincular variables de entrada, agrega variables a una sentencia preparada
			$q=mysqli_stmt_execute ($sentencia); //tengo las respuestas
			mysqli_stmt_bind_result($sentencia, $usuBD, $cla, $tipoBD, $fotoBD);
			mysqli_stmt_fetch($sentencia);
			if($usuBD == $usuario && $cla == $clave){
				echo '<h2>Logueo exitoso</h2>';
				$_SESSION['username'] = $usuBD;
				$_SESSION['foto'] = $fotoBD;
				$_SESSION['tipo'] = $tipoBD;
				header('refresh:2;url=articulo_listado.php');
			}else {
            echo "<p>Usuario o contraseña incorrectos</p>";
            header("refresh:2;url=../index.php");
        }
			desconectar($conexion);
		}
	}else{
		header('refresh:2;url=../index.php');
	}

?>