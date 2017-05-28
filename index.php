<!-- Agregando los includes -->
<?php
	include("datos.php");
	include("base_datos.class.php");
	include("cuenta.class.php");
	include("iniciar_sesion.class.php");		
?>

<!-- Controlador -->
<?php

	session_start();

	if(isset($_SESSION["correo"])){
		/**
		*Si está presenta la variable $_SESSION["correo"] es porque ya se inició sesión, 
		* por lo tanto, se debe redireccionar a pagina_bienvenidad.php
		* */
		header("location: pagina_bienvenida.php");
	}
	
	$base_datos = new Base_datos($host, $usuario, $clave, $bd);

	if($base_datos->conectar_base_datos()){
		// Si se pudo conectar a la base de datos de ejecuta esta sentencias

		if(isset($_POST["form_ini_sesion"]) and $_POST["form_ini_sesion"] <> "" ){
			/**
			*Si se envió el formulario de inicion de sesión, se ejecuta esta sentencia.
			* */

			$ini_sesion = new Iniciar_sesion($base_datos);

			// Verificando la exitencia del usuario en la base de datos
			if(!$ini_sesion->comprobar_existencia_usuario($_POST["correo"])){			
				
				// Si el usuario no existe:

				$mensajes = utf8_encode("El usuario No existe");

			}else{

				// Si el usuario existe, se compara el correo y la contraseña especificada

				if(!$ini_sesion->comparar_usuario_pass($_POST["correo"], $_POST["pass"])){

					// Si el correo y la contraseña no coinciden:
					$mensajes = utf8_encode("La contraseña no coincide con el usuario");

				}else{
					$datos = $ini_sesion->obtener_datos_usuario($_POST["correo"]);

					$_SESSION["correo"] = $datos["correo"];
					header("location: pagina_bienvenida.php");
				}	
			}
		}

		if(isset($_POST["form2_crear_cuenta"]) and $_POST["form2_crear_cuenta"] <> "" ){
			/**
			*Si se envió el formulario de crear cuenta, se ejecuta esta sentencia.
			* */	

			$cuenta = new Cuenta($base_datos);		

			if($cuenta->comprobar_existencia_usuario($_POST["correo_electronico"])){
				// Si el correo se encuentra registrado

				$mensajes = utf8_encode("El usuario ya se encuentra registrado");

			}else{
				// Si el correo no se encuentra registrado				
				
				if($cuenta->registrar_usuario($_POST["nombre"], $_POST["apellido"], 
					$_POST["correo_electronico"], $_POST["password"]))
				{
					// Usuario registrado con éxito
					$mensajes = utf8_encode("Usuario registrado con éxito");
				}else{
					//Error al registrar el usuario
					$mensajes = utf8_encode("Error al registrar al nuevo usuario");
				}
			}
		}

	}else{
		$mensajes = utf8_encode("Error en la conexión a la base de datos");
	}
		
?>

<!-- Vista -->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Registro como facebook</title>
	<link rel="stylesheet" href="css/estilo.css">
</head>
<body>
	
	<form action="" method="post">
		<fieldset>
			<legend>Iniciar sesión</legend>
			<input type="hidden" name="form_ini_sesion" value="1">
			
			<div>
				<label for="">Correo electrónico</label>
				<input type="email" name="correo" required>
			</div>
			
			<div>
				<label for="">Contraseña</label>
				<input type="password" name="pass" required>
			</div>
			
			<div>
				<input type="submit" value="Ingresar">
			</div>
			
			<div class="error_form_inicar_sesion">
				
			</div>
			
		</fieldset>
	</form>
	
	<form action="" method="post">
		<fieldset>
			<legend>Crear cuenta</legend>
			<input type="hidden" name="form2_crear_cuenta" value="2">
			
			<div>
				<label for="">nombres</label>
				<input type="text" name="nombre" required pattern="[^0-9]+" title="nombre inválido">
			</div>
			
			<div>
				<label for="">Apellidos</label>
				<input type="text" name="apellido" required pattern="\D+" title="Apellidos inválidos">
			</div>
			
			<div>
				<label for="">Correo electrónico</label>
				<input type="email" name="correo_electronico" required>
			</div>
			
			<div>
				<label for="">Contraseña</label>
				<input type="password" name="password" required>
			</div>
			
			<div>
				<input type="submit" value="Crear cuenta">
			</div>
			
			<div class="error_form_crear_cuenta">
				
			</div>
			
		</fieldset>
	</form>

	<div class="mensajes">
		<p>
			<?php
				echo isset($mensajes) ? utf8_decode($mensajes) : "";
			?>
		</p>
	</div>
	
	
</body>
</html>