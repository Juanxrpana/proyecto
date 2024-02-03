<?php 
	require_once 'conexion.php';
	$conexion = new Conexion(); // Crea una instancia de la clase Conexion
	$pdo = $conexion->conecta(); //

	session_start();
	
	$username = $_POST['username'];
	$password = $_POST['password'];
	$sentencia = $pdo->prepare('select * from usuarios where 
								username = ? and password = ?;');
	$sentencia->execute([$username, $password]);
	$datos = $sentencia->fetch(PDO::FETCH_OBJ);

	if ($datos === FALSE) {
		header('Location: ../vista/login.php');
	}elseif($sentencia->rowCount() == 1){
		 $_SESSION['nombre'] = $datos->username;
		 // Define la página a la que debe redirigirse después del inicio de sesión
		 echo "Cargando persona desde login";
		 $_SESSION['?pagina=materia_prima'] = 'principal';
		 header('Location: ../index.php');

	 }
	
?>