<?php
//llamda al archivo que contiene la clase
//datos, en ella posteriormente se colcora el codigo
//para enlazar a su base de datos
require_once('Conexion.php');

//declaracion de la clase usuarios que hereda de la clase datos
//la herencia se declara con la palabra extends y no es mas
//que decirle a esta clase que puede usar los mismos metodos
//que estan en la clase de dodne hereda (La padre) como sir fueran de el

class Registrousuario extends Conexion
{
	//el primer paso dentro de la clase
	//sera declarar los atributos (variables) que describen la clase
	//para nostros no es mas que colcoar los inputs (controles) de
	//la vista como variables aca
	//cada atributo debe ser privado, es decir, ser visible solo dentro de la
	//misma clase, la forma de colcoarlo privado es usando la palabra private
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

	

	//copia
	public function existe($usuario)
	{
		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		try {
			$resultado = $co->query("Select * from usuario where id_prov	='$usuario'");
			$fila = $resultado->fetchAll(PDO::FETCH_BOTH);
			if ($fila) {

				return true;
			} else {

				return false;
			}
		} catch (Exception $e) {
			return false;
		}
	}

	public function consultar_pregunta()
	{
		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		try {
			$resultado = $co->query("SELECT id_pregunta, pregunta FROM pregunta_s");

			if ($resultado) {
				$respuesta = '';
				$respuesta = "<option value='0' selected>Pregunta de seguridad</option>"; // Opción inicial por defecto
				foreach ($resultado as $r) {
					$respuesta = $respuesta . "<option value=";
					$respuesta = $respuesta . " '";
					$respuesta = $respuesta . $r['id_pregunta'];
					$respuesta = $respuesta . "'>";
					$respuesta = $respuesta . $r['pregunta'];
					$respuesta = $respuesta . "</option>";
					
				}
				return $respuesta;
			} else {
				return '';
			}
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

	public function agregar_usuario()
	{
		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		try {
			// Consulta SQL con marcadores de posición
			$sql = "INSERT INTO usuario (
                idusuario,
                nombres,
                apellidos,
                password,
                cargo_idcargo,
                id_pregunta_s,
                respuesta
            ) VALUES (
                :idusuario,
                :nombres,
                :apellidos,
                :password,
                1,  -- cargo_idcargo siempre es igual a 1
                :id_pregunta_s,
                :respuesta
            )";

			// Preparar la consulta
			$stmt = $co->prepare($sql);

			// Asociar valores a los marcadores de posición con bindParam
			$stmt->bindParam(':idusuario', $this->usuario, PDO::PARAM_STR);
			$stmt->bindParam(':nombres', $this->nombres, PDO::PARAM_STR);
			$stmt->bindParam(':apellidos', $this->apellidos, PDO::PARAM_STR);
			$stmt->bindParam(':password', $this->clave, PDO::PARAM_STR);
			$stmt->bindParam(':id_pregunta_s', $this->id_pregunta_s, PDO::PARAM_INT);
			$stmt->bindParam(':respuesta', $this->respuesta, PDO::PARAM_STR);

			// Aquí debes asignar valores a las variables $idusuario, $nombres, $apellidos, $password, $id_pregunta_s, $respuesta
			// Estos valores deben provenir de tus variables o de algún otro proceso de tu aplicación

			// Ejecutar la consulta preparada
			$stmt->execute();

			return "Usuario registrado exitosamente";
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

	public function mostrarusuario()
	{


		$co1 = $this->conecta();
		$co1->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$sql = $co1->query("SELECT * FROM usuario WHERE cargo_idcargo = 1");

		return $sql;
	}

	public function borrar()
	{
		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		try {
			$co->query("delete from usuario
						where
						idusuario = '$this->usuario'
						");
			return "Registro Eliminado";
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

	public function validarusuario()
{
    $co = $this->conecta();
    $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    try {
        $stmt = $co->prepare("SELECT idusuario, id_pregunta_s FROM usuario WHERE idusuario = :usuario");
        $stmt->bindParam(':usuario', $this->usuario);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($resultado) {
            return $resultado; // Devuelve el ID de usuario y el ID de la pregunta de seguridad
        } else {
            return false; // El usuario no existe en la base de datos
        }
    } catch (Exception $e) {
        return false; // Ocurrió un error al ejecutar la consulta
    }
}


public function validarrespuesta()
{
    $co = $this->conecta();
    $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    try {
        $stmt = $co->prepare("SELECT idusuario FROM usuario WHERE idusuario = :usuario AND respuesta = :respuesta");
        $stmt->bindParam(':usuario', $this->usuario);
        $stmt->bindParam(':respuesta', $this->respuesta);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($resultado) {
            return true; // La respuesta es correcta
        } else {
            return false; // La respuesta es incorrecta
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
        return true; // La contraseña se actualizó correctamente
    } catch (Exception $e) {
       return $e->getMessage(); // Ocurrió un error al ejecutar la consulta
    }
}
	
}