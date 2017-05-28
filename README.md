# registro_como_facebook
Registro e inicio de sesión como facebook / Registration and login as facebook

Esta es una aplicación web desarrollada en PHP mediante POO, la cual simula el registro y login  utilizado en Facebook. Inicialmente, es necesario registrarse en la aplicación a través de un formulario donde se deben ingresar los siguientes datos: nombres, apellidos, correo electrónico y contraseña. Una vez los datos son ingresados, se procede a guardar estos datos en una base de datos; todos los datos son almacenados como los ingresa el usuario, excepto el campo de contraseña, el cual se almacena utilizando el método de encriptación sha1.

Una vez se ha registrado el usuario, es posible loguearse utilizando su correo y su contraseña. Si ingresa un correo y una contraseña que no coinciden, se muestra el siguiente mensaje en la parte inferior de la página: “La contraseña no coincide con el usuario”.  Si el correo y la contraseña coinciden, se redirecciona a una página de bienvenida donde se muestra un mensaje de bienvenida con el nombre del usuario, especificado en el campo de nombre en el formulario de registro. Para cerrar sesión, únicamente se presiona en un enlace donde se muestra un texto de cerrar sesión. 

Nota: No se han empleado ningún estilo ya que esta aplicación web se centra en el uso de PHP y POO.
