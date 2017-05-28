<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>prueba rápida</title>
</head>
<body>

	<?php
		include("datos.php");
		include("base_datos.class.php");
		include("cuenta.class.php");
		include("iniciar_sesion.class.php");		
	?>
	
	<h1>
		<?php

			$base_datos = new Base_datos($host, $usuario, $clave, $bd);

			if($base_datos->conectar_base_datos()){
				
				// $cuenta = new Cuenta($base_datos);
				$iniciar_sesion = new Iniciar_sesion($base_datos);

				$datos =  $iniciar_sesion->obtener_datos_usuario("diego@hotmail.com");
				echo "El id = ". $datos["id"] ." El nombre: ". $datos["nombre"];

			}else{
				echo "No se pudo conectar a la base datos";
			}
		?>
	</h1>

</body>
</html>