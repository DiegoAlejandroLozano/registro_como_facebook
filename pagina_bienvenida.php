<?php
	include("datos.php");
	include("base_datos.class.php");
	include("cuenta.class.php");
	include("iniciar_sesion.class.php");		
?>

<?php
	session_start();

	if(!isset($_SESSION["correo"])){
		// Si no esta presente la variable $_SESSION["correo"] es porque no han iniciado sessión, por lo tanto, se debe redireccionar al index.php

		header("location: index.php");
	}

	$base_datos = new Base_datos($host, $usuario, $clave, $bd);

	if($base_datos->conectar_base_datos()){
		/**
		*Si se pudo conectar a la base de datos, ejecuta esta sentencia
		* */
		$datos = $base_datos->consultar_datos_usuario($_SESSION["correo"]);
	}else{
		/**
		*Si no se pudo conectar, ejecuta esta sentencia
		* */
		$error = "No se pudo conectar a la base datos";
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Página bienvenida</title>
	<link rel="stylesheet" href="css/estilo.css">
</head>
<body>
	
	<h1>Bienvenido: <?php echo $datos["nombre"] ?></h1>
	<a href="cerrar_session.php">Cerrar sesión</a>
	<div>
		<p>
			<?php
				echo isset($error) ? $error : "";
			?>
		</p>
	</div>
</body>
</html>