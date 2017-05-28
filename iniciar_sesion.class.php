<?php
	/**
	* Clase encargada de gestionar todo lo relacionado con el inicio
	* de sesión
	*/
	class Iniciar_sesion
	{
		
		private $objeto_bd;

		function __construct(&$bd)
		{
			$this->objeto_bd = $bd;
		}

		function comprobar_existencia_usuario($correo){

			/**
			*Esta función comprueba que el usuario no este registrado con anterioridad en el
			* sistema. Si el usuario existe, retorna true. En caso contrario, retorna false
			* */

			if($this->objeto_bd->verificar_usuario_bd($correo)){
				return true;
			}else{
				return false;
			}
		}

		function comparar_usuario_pass($correo, $contrasenia){

			/**
			*Compara la contraseña y el usuario ingresado. Si la comparación es positiva, 
			* retorna true. En caso contrario, retorna false.
			* */

			if($this->objeto_bd->autenticar_usuario($correo, $contrasenia)){
				return true;
			}else{
				return false;
			}
		}

		function obtener_datos_usuario($correo){
			/**
			*Obtiene los datos del usuario: Nombre y Apellido
			* */

			$datos = $this->objeto_bd->consultar_datos_usuario($correo);
			return $datos;
		}
	}
?>