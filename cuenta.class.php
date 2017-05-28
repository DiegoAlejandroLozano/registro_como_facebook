<?php
	/**
	* Esta clase crea un objeto, encargado de la administración de la cuenta
	*/
	class Cuenta
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

		function registrar_usuario($nombre, $apellido, $email, $contrasenia){

			/**
			*Esta función registra a un nuevo usuario en la en el sistema. Si la
			* operación es exitosa, retorna true. En caso contrario, false.
			* */

			if($this->objeto_bd->agregar_registro($nombre, $apellido, $email, $contrasenia))
			{
				return true;
			}else{
				return false;
			}
		}
	}
?>