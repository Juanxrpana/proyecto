<?php

require_once('Conexion.php');

class inicio extends Conexion
{
	private $usuario;
	private $nombres;
	private $apellidos;
	private $clave;
	private $cargo;
	private $id_pregunta_s;
	private $respuesta;


	function set_usuario($valor)
	{
		$this->usuario = $valor;
	}

	function set_clave($valor)
	{
		$this->clave = $valor;
	}

	function set_nombres($valor)
	{
		$this->nombres = $valor;
	}

	function set_apellidos($valor)
	{
		$this->apellidos = $valor;
	}

	function set_id_pregunta_s($valor)
	{
		$this->id_pregunta_s = $valor;
	}

	function set_respuesta($valor)
	{
		$this->respuesta = $valor;
	}

	function set_cargo($valor)
	{
		$this->cargo = $valor;
	}




	function get_clave()
	{
		return $this->clave;
	}

	function get_usuario()
	{
		return $this->usuario;
	}

	function get_nombres($valor)
	{
		$this->nombres = $valor;
	}

	function get_apellidos($valor)
	{
		$this->apellidos = $valor;
	}

	function get_id_pregunta_s($valor)
	{
		$this->id_pregunta_s = $valor;
	}

	function get_respuesta($valor)
	{
		$this->respuesta = $valor;
	}

	function get_cargo($valor)
	{
		$this->cargo = $valor;
	}

	

	public function busca()
	{
		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		try {

			$resultado = $co->prepare("SELECT idusuario  FROM usuario WHERE 
			idusuario=:usuario AND password=:clave");
			$resultado->bindParam(':usuario', $this->usuario);
			$resultado->bindParam(':clave', $this->clave);
			$resultado->execute();
			$fila = $resultado->fetchAll(PDO::FETCH_BOTH);
			if ($fila) {
				return $fila;
			} else {
				return "¡Error en los datos ingresados!";
			}
		} catch (Exception $e) {
			return $e;
		}
	}
	function busca_cargo()
	{
		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		try {
			$id_usuario = $_SESSION['id_usuario']; // obtienen el ID de usuario de la sesión
			$resultado = $co->prepare("SELECT cargo_idcargo FROM usuario WHERE idusuario = :idusuario");
			$resultado->bindParam(':idusuario', $id_usuario, PDO::PARAM_INT); // Asigna el valor del parámetro
			$resultado->execute();
			$cargo = $resultado->fetchColumn(); // Obtiene una sola columna de la primera fila del conjunto de resultados
			return $cargo !== false ? $cargo : "No se encontró ningún cargo.";
		} catch (Exception $e) {
			return $e->getMessage(); // Devuelve el mensaje de error en caso de excepción
		}
	}

	public function existe($idusuario)
	{
		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		try {
			$resultado = $co->query("Select * from usuario where idusuario	='$idusuario'");
			$fila = $resultado->fetchAll(PDO::FETCH_BOTH);
			if ($fila) {

				return true;
			} else {

				return false;
			}
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

	


	public function validarusuario_pregunta()
	{
		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		try {
			// Consulta preparada para obtener el ID del usuario y el ID de la pregunta de seguridad
			$stmt = $co->prepare("SELECT idusuario, id_pregunta_s FROM usuario WHERE idusuario = :usuario");
			$stmt->bindParam(':usuario', $this->usuario);
			$stmt->execute();
			$resultado = $stmt->fetch(PDO::FETCH_ASSOC);
			
			if ($resultado) {
				// Si se encontró el usuario, obtenemos la pregunta de seguridad asociada
				$pregunta_stmt = $co->prepare("SELECT pregunta FROM pregunta_s WHERE id_pregunta = :id_pregunta_s");
				$pregunta_stmt->bindParam(':id_pregunta_s', $resultado['id_pregunta_s']);
				$pregunta_stmt->execute();
				$pregunta_resultado = $pregunta_stmt->fetch(PDO::FETCH_ASSOC);
				
				// Verifica si se encontró la pregunta de seguridad
				if ($pregunta_resultado) {
					// Agregamos la pregunta de seguridad al resultado
					$resultado['pregunta_seguridad'] = $pregunta_resultado['pregunta'];
				} else {
					// Si no se encontró la pregunta de seguridad, devolvemos un valor predeterminado
					$resultado['pregunta_seguridad'] = "Pregunta no encontrada";
				}
				
				return $resultado; // Devuelve el ID de usuario, el ID de la pregunta de seguridad y la pregunta
				// Después de obtener el resultado
				
			} else {
				return false; // El usuario no existe en la base de datos
			}
		} catch (Exception $e) {
			return $e->getMessage(); // Ocurrió un error al ejecutar la consulta
		}
	}
	



public function validarrespuesta()
{
    $co = $this->conecta();
    $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    try {
        $stmt = $co->prepare("SELECT idusuario FROM usuario WHERE idusuario = :usuario AND respuesta = :respuesta");
        $stmt->bindParam(':usuario', $this->usuario);
        $stmt->bindParam(':respuesta', $this->respuesta, PDO::PARAM_STR);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($resultado) {
            return true; // La respuesta es correcta
        } else {
            return "invalida"; // La respuesta es incorrecta
        }
    } catch (Exception $e) {
       return $e->getMessage(); // Ocurrió un error al ejecutar la consulta
    }
}

public function actualizarclave($nuevaclave)
{
    $co = $this->conecta();
    $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    try {
        $stmt = $co->prepare("UPDATE usuario SET password = :nuevaclave WHERE idusuario = :usuario");
        $stmt->bindParam(':nuevaclave', $nuevaclave);
        $stmt->bindParam(':usuario', $this->usuario);
        $stmt->execute();
        return "Clave actualizada"; // La contraseña se actualizó correctamente
    } catch (Exception $e) {
       return $e->getMessage(); // Ocurrió un error al ejecutar la consulta
    }
}

	/* public function actualizarPassword($idusuario, $nuevaPassword, $respuesta) {
		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		try {
			// Verificar si la respuesta coincide
			$stmt = $co->prepare("SELECT COUNT(*) AS count FROM usuario WHERE idusuario = :idusuario AND respuesta = :respuesta");
			$stmt->bindParam(':idusuario', $idusuario, PDO::PARAM_STR);
			$stmt->bindParam(':respuesta', $respuesta, PDO::PARAM_STR);
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
	
			if ($row['count'] > 0) {
				// La respuesta coincide, entonces actualiza la contraseña
				$stmt = $co->prepare("UPDATE usuario SET password = :nuevaPassword WHERE idusuario = :idusuario");
				$stmt->bindParam(':nuevaPassword', $nuevaPassword, PDO::PARAM_STR);
				$stmt->bindParam(':idusuario', $idusuario, PDO::PARAM_STR);
				$stmt->execute();
				
				return "Contraseña actualizada exitosamente";
			} else {
				return "La respuesta no coincide";
			}
		} catch (Exception $e) {
			return $e->getMessage();
		}
	} */
	

	

	
}
?>