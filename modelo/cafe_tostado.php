<?php
//llamda al archivo que contiene la clase
//datos, en ella posteriormente se colcora el codigo
//para enlazar a su base de datos
require_once('Conexion.php');

//declaracion de la clase usuarios que hereda de la clase datos
//la herencia se declara con la palabra extends y no es mas
//que decirle a esta clase que puede usar los mismos metodos
//que estan en la clase de dodne hereda (La padre) como sir fueran de el

class Registrocafe_tostado extends Conexion
{
	//el primer paso dentro de la clase
	//sera declarar los atributos (variables) que describen la clase
	//para nostros no es mas que colcoar los inputs (controles) de
	//la vista como variables aca
	//cada atributo debe ser privado, es decir, ser visible solo dentro de la
	//misma clase, la forma de colcoarlo privado es usando la palabra private
    private $idcafe_tostado;
	private $cantidad;
	private $fecha_tostado;
    private $nivel_tostado;
    private $nivel_molido;
	private $usuario;

	//Ok ya tenemos los atributos, pero como son privados no podemos acceder a ellos desde fueran
	//por lo que debemos colcoar metodos (funciones) que me permitan leer (get) y colocar (set)

	function set_idcafe_tostado($valor)
	{
		$this->idcafe_tostado  = $valor;
	}
	function set_cantidad($valor)
	{
		$this->cantidad  = $valor;
	}
	function set_fecha_tostado($valor)
	{
		$this->fecha_tostado  = $valor;
	}
	
    function set_nivel_tostado($valor)
	{
		$this->nivel_tostado  = $valor;
	}
    function set_nivel_molido($valor)
	{
		$this->nivel_molido  = $valor;
	}

	function set_usuario($valor)
	{
		$this->usuario  = $valor;
	}
	

	//ahora la misma cosa pero para leer, es decir get


	function get_idcafe_tostado($valor)
	{
		$this->idcafe_tostado  = $valor;
	}
    function get_cantidad($valor)
	{
		$this->cantidad  = $valor;
	}
	function get_fecha_tostado($valor)
	{
		$this->fecha_tostado  = $valor;
	}
	
    function get_nivel_tostado($valor)
	{
		$this->nivel_tostado  = $valor;
	}
    function get_nivel_molido($valor)
	{
		$this->nivel_molido  = $valor;
	}

	function get_usuario($valor)
	{
		$this->usuario  = $valor;
	}
	


	public function existe($idcafe_tostado)
	{
		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		try {
			$resultado = $co->query("Select * from cafe_tostado where idcafe_tostado	='$idcafe_tostado'");
			$fila = $resultado->fetchAll(PDO::FETCH_BOTH);
			if ($fila) {

				return true;
			} else {

				return false;;
			}
		} catch (Exception $e) {
			return false;
		}
	}
	//ahora incluiremos una cafe_tostado//
	function agregarcafe_tostado()
{
    $co = $this->conecta();
    $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    try {
        // Consulta SQL con marcadores de posición
        $sql = "INSERT INTO cafe_tostado (
                    cantidad,
                    nivel_tostado,
                    nivel_molido,
                    estado,
                    fecha_tostado,
					usuario_idusuario
                ) VALUES (
                    :cantidad,
                    :nivel_tostado,
                    :nivel_molido,
                    1,
                    NOW(),
					'28150004'

                )";

        // Preparar la consulta
        $stmt = $co->prepare($sql);

        // Asociar valores a los marcadores de posición con bindParam
        $stmt->bindParam(':cantidad', $this->cantidad, PDO::PARAM_INT);
        $stmt->bindParam(':nivel_tostado', $this->nivel_tostado, PDO::PARAM_STR);
        $stmt->bindParam(':nivel_molido', $this->nivel_molido, PDO::PARAM_STR);

        // Ejecutar la consulta preparada
        $stmt->execute();

        return "Registro de café para tostar exitoso";
    } catch (Exception $e) {
        return $e->getMessage();
    }
	
}


public function procesarCafeTostado($idcafe_tostado) {
    try {
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Obtener la cantidad de ID:2 en total_cafe
        $stmtCantidadID2 = $co->query("SELECT total FROM total_cafe WHERE id_total_cafe = 2");
        $cantidadID2 = $stmtCantidadID2->fetchColumn();

        // Actualizar la cantidad de ID:1 en total_cafe restando la cantidad de ID:2
        $stmtUpdateTotal = $co->prepare("UPDATE total_cafe SET total = total - :cantidadID2 WHERE id_total_cafe = 1");
        $stmtUpdateTotal->bindParam(':cantidadID2', $cantidadID2, PDO::PARAM_INT);
        $stmtUpdateTotal->execute();

        // Actualizar el estado de cafe_tostado a 0
        $stmtUpdateEstado = $co->prepare("UPDATE cafe_tostado SET estado = 0 WHERE id_cafe_tostado = :idcafe_tostado");
        $stmtUpdateEstado->bindParam(':idcafe_tostado', $idcafe_tostado, PDO::PARAM_INT);
        $stmtUpdateEstado->execute();

        return "Procesamiento de café tostado exitoso";
    } catch (Exception $e) {
        return $e->getMessage();
    }
}




function modificarcafe_tostado()
{
    $co = $this->conecta();
    $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    try {
        // Consulta SQL con marcadores de posición
        $sql = "UPDATE cafe_tostado 
                SET cantidad = :cantidad, 
                    nivel_tostado = :nivel_tostado, 
                    nivel_molido = :nivel_molido 
                WHERE idcafe_tostado = :idcafe_tostado";

        // Preparar la consulta
        $stmt = $co->prepare($sql);

        // Asociar valores a los marcadores de posición con bindParam
        $stmt->bindParam(':cantidad', $this->cantidad, PDO::PARAM_INT);
        $stmt->bindParam(':nivel_tostado', $this->nivel_tostado, PDO::PARAM_STR);
        $stmt->bindParam(':nivel_molido', $this->nivel_molido, PDO::PARAM_STR);
        $stmt->bindParam(':idcafe_tostado', $this->idcafe_tostado, PDO::PARAM_INT);

        // Ejecutar la consulta preparada
        $stmt->execute();

        return "Registro Modificado";
    } catch (Exception $e) {
        return $e->getMessage();
    }
}


    public function contadorcafe_tostado()
	{
		try {
			$co = $this->conecta();
			$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
			// Crear la consulta preparada
			$sql = "UPDATE total_cafe
					SET total = (
						SELECT COALESCE(SUM(cantidad), 0)
						FROM cafe_tostado
						WHERE estado = 1
					)
					WHERE id_total_cafe = 2";
		
			// Preparar la consulta
			$stmt = $co->prepare($sql);
		
			// Ejecutar la consulta
			$stmt->execute();		
			return "contador café tostado consulta exitosa";
		} catch (PDOException $e) {
			return "Error: " . $e->getMessage();
		}
	}

	public function mostrar_contador_cafe_tostado()
	{
		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		try {
			$resultado = $co->query("SELECT total FROM total_cafe where	id_total_cafe=2");
			$totalCafeTostado = $resultado->fetch(PDO::FETCH_ASSOC)['total'];

			return $totalCafeTostado;
		} catch (Exception $e) {
			return $e->getMessage(); 
		}
	}

	

	
	public function mostrarcafe_tostado()
	{


		$co1 = $this->conecta();
		$co1->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$sql = $co1->query("SELECT *
		FROM `cafe_tostado`");

		return $sql;
	}


	public function mostrarcafe_tostado_final()
	{


		$co1 = $this->conecta();
		$co1->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$sql = $co1->query("SELECT *
		FROM `cafe_tostado` 
		Where estado= 1");

		return $sql;
	}



	public function borrarcafe_tostado()
	{
		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		try {
			$co->query("delete from cafe_tostado
						where
						idcafe_tostado = '$this->idcafe_tostado'
						");
			return "Registro Eliminado";
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

	public function inactivadorcafe_tostado()
	{
		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = $co->query("
						UPDATE cafe_tostado
						SET estado = 0
						WHERE estado = 1;
						");	
	}

	public function descontador_total_cafe_tostado()
	{
		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = $co->query("
		DELIMITER //

		CREATE TRIGGER actualizar_total_cafe_despues_insert
		AFTER INSERT ON cafe_final
		FOR EACH ROW
		BEGIN
			-- Actualizar el total en total_cafe donde id_total_cafe = 2 a 0
			UPDATE total_cafe SET total = 0 WHERE id_total_cafe = 2;
		END;
		
		//
		DELIMITER ;
						");
	}
}
