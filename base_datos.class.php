<?php
	/**
	* Esta clase se encarga del manejo de la base de datos.
	*/
	class Base_datos
	{

		private $host;
		private $usuario;
		private $clave;
		private $bd;

		function __construct($host, $usuario, $clave, $bd)
		{
			/**
			*Este es el constructor de la clase Base_datos;
			* */

			$this->host = $host;
			$this->usuario = $usuario;
			$this->clave = $clave;
			$this->bd = $bd;
		}

		function conectar_base_datos(){
			/**
			*Esta función booleana se conecta al servidor de base datos
			* y selecciona la base datos especificada. 
			* */

			if(mysql_connect($this->host, $this->usuario, $this->clave)){
				/**
				*Si se pudo conectar al servidor de base de datos selecciona la base
				* de datos, el juego de caracteres y retorna true
				* */
				mysql_select_db($this->bd);
				mysql_query("SET NAMES 'utf8'");

				return true;
			}else{
				/**
				*Si no se puede conecta a la base datos, retorna un false
				* */
				return false;
			}
		}

		function consultar_datos_usuario($correo){
			/**
			*Este método retorna los datos de un usuario (nombres, apellidos)
			* */

			$correo_limpio = mysql_real_escape_string($correo);

			$consulta = sprintf("SELECT id, nombre, apellido, correo FROM usuarios WHERE correo = '%s'",
				$correo_limpio);

			if($res_cons = mysql_query($consulta) and mysql_num_rows($res_cons) == 1){

				$fila = mysql_fetch_array($res_cons);

				return $fila;

			}else{
				return false;
			}
		}

		function agregar_registro($nombre, $apellido, $correo, $pass){

			/**
			*Esta función se encargará de procesar los datos y su posterior registro en
			* la base de datos. Retorna true si el proceso fue exitoso, o false en caso
			* contrario
			* */

			$nombre_limpio = mysql_real_escape_string($nombre);
			$apellido_limpio = mysql_real_escape_string($apellido);
			$correo_limpio = mysql_real_escape_string($correo);
			$pass_limpio = mysql_real_escape_string($pass);

			$pass_encriptada = sha1($pass_limpio);

			$consulta = "INSERT INTO usuarios (id, nombre, apellido, correo, pass) VALUES (null, '$nombre_limpio', '$apellido_limpio', '$correo_limpio', '$pass_encriptada')";

			if(mysql_query($consulta)){
				return true;
			}else{
				return false;
			}
		}

		function verificar_usuario_bd($correo){

			/**
			*Verifica la existencia de un usuario en la base datos mediante
			* el campo correo. Si el usuario existe, devuelve true. En caso contrario,
			* devuelve false
			* */

			$correo_limpio = mysql_real_escape_string($correo);

			$consulta = "SELECT correo FROM usuarios where correo = '$correo_limpio'";

			if( $paquete = mysql_query($consulta) and mysql_num_rows($paquete) == 1){
				return true;
			}else{
				return false;
			}
		}

		function autenticar_usuario($usuario, $contrasenia){
			/**
			*Esta función se encarga de autenticar al usuario comparando su nombre de
			* usuario con su contraseña. Si existe una coincidencia, retorna true. En caso contrario retorna false.
			* */

			$usuario_limpio = mysql_real_escape_string($usuario);
			$contrasenia_limpia = mysql_real_escape_string($contrasenia);
			
			$pass_encriptada = sha1($contrasenia_limpia);

			$consulta = sprintf("SELECT nombre FROM usuarios WHERE correo = '%s' and pass = '%s' ", $usuario_limpio, $pass_encriptada);

			if($paquete = mysql_query($consulta) and mysql_num_rows($paquete) == 1){
				return true;
			}else{
				return false;
			}
		}


	}
?>