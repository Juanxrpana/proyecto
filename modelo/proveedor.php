<?php
//llamda al archivo que contiene la clase
//datos, en ella posteriormente se colcora el codigo
//para enlazar a su base de datos
require_once('Conexion.php');

//declaracion de la clase usuarios que hereda de la clase datos
//la herencia se declara con la palabra extends y no es mas
//que decirle a esta clase que puede usar los mismos metodos
//que estan en la clase de dodne hereda (La padre) como sir fueran de el

class Registroproveedor extends Conexion
{
	//el primer paso dentro de la clase
	//sera declarar los atributos (variables) que describen la clase
	//para nostros no es mas que colcoar los inputs (controles) de
	//la vista como variables aca
	//cada atributo debe ser privado, es decir, ser visible solo dentro de la
	//misma clase, la forma de colcoarlo privado es usando la palabra private
	private $id_prov;
	private $datos_prov_identificacion;
	private $identificacion;
	private $nombre_prov;
	private $telefono;
	private $cedula_fiscal_id;
	private $finca_idfinca;
	private $idfinca;
	private $ubicacion;
	private $nombre_finca;
	private $estado;
	private $municipio;
	private $parroquia;
	private $ciudad;




	function set_id_prov($valor)
	{
		$this->id_prov = $valor;
	}

	function set_datos_prov_identificacion($valor)
	{
		$this->datos_prov_identificacion = $valor;
	}

	function set_identificacion($valor)
	{
		$this->identificacion = $valor;
	}

	function set_nombre_prov($valor)
	{
		$this->nombre_prov = $valor;
	}

	function set_telefono($valor)
	{
		$this->telefono = $valor;
	}

	function set_cedula_fiscal_id($valor)
	{
		$this->cedula_fiscal_id = $valor;
	}

	function set_finca_idfinca($valor)
	{
		$this->finca_idfinca = $valor;
	}

	function set_ubicacion($valor)
	{
		return $this->ubicacion = $valor;
	}

	function set_nombre_finca($valor)
	{
		$this->nombre_finca = $valor;
	}

	function set_estado($valor)
	{
		$this->estado = $valor;
	}

	function set_municipio($valor)
	{
		$this->municipio = $valor;
	}

	function set_parroquia($valor)
	{
		$this->parroquia = $valor;
	}

	function set_ciudad($valor)
	{
		$this->ciudad = $valor;
	}


	//ahora la misma cosa pero para leer, es decir get


	function get_id_prov($valor)
	{
		$this->id_prov = $valor;
	}

	function get_datos_prov_identificacion($valor)
	{
		$this->datos_prov_identificacion = $valor;
	}

	function get_identificacion($valor)
	{
		$this->identificacion = $valor;
	}

	function get_nombre_prov($valor)
	{
		$this->nombre_prov = $valor;
	}

	function get_telefono($valor)
	{
		$this->telefono = $valor;
	}

	function get_cedula_fiscal_id($valor)
	{
		$this->cedula_fiscal_id = $valor;
	}

	function get_finca_idfinca($valor)
	{
		$this->finca_idfinca = $valor;
	}

	function get_ubicacion($valor)
	{
		return $this->ubicacion = $valor;
	}

	function get_nombre_finca($valor)
	{
		$this->nombre_finca = $valor;
	}

	function get_estado($valor)
	{
		$this->estado = $valor;
	}

	function get_municipio($valor)
	{
		$this->municipio = $valor;
	}

	function get_parroquia($valor)
	{
		$this->parroquia = $valor;
	}

	function get_ciudad($valor)
	{
		$this->ciudad = $valor;
	}



	//copia
	public function existe($id_prov)
	{
		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		try {
			$resultado = $co->query("Select * from proveedor where id_prov	='$id_prov'");
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

	function consultar()
	{
		// Realiza una consulta SQL para obtener los datos de cédula fiscal
		$co = $this->conecta();
		$query = "SELECT id_cedula_fiscal, cedula_fiscal FROM cedula_fiscal";

		try {
			$stmt = $co->query($query);

			// Verifica que se hayan obtenido resultados
			if ($stmt->rowCount() > 0) {
				echo '<select name="cedula_fiscal_id_cedula_fiscal" id="cedula_fiscal_id_cedula_fiscal">';
				echo '<option value="0">Selecciona un tipo de identificacion fiscal</option>';

				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
					echo '<option value="' . $row['id_cedula_fiscal'] . '">' . $row['cedula_fiscal'] . '</option>';
				}

				echo '</select>';
			} else {
				echo 'No se encontraron cedula_fiscals de cédula fiscal.';
			}
		} catch (Exception $e) {
			echo 'Error: ' . $e->getMessage();
		}
	}

	function agregar_proveedor()
	{
		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		try {
			// Insertar en datos_prov
			$stmtDatosProv = $co->prepare("INSERT INTO datos_prov (
            identificacion,
            nombre_prov,
            telefono,
            cedula_fiscal_id
        ) VALUES (
            :identificacion,
            :nombre_prov,
            :telefono,
            :cedula_fiscal_id
        )");
			$stmtDatosProv->bindParam(':identificacion', $this->identificacion, PDO::PARAM_STR);
			$stmtDatosProv->bindParam(':nombre_prov', $this->nombre_prov, PDO::PARAM_STR);
			$stmtDatosProv->bindParam(':telefono', $this->telefono, PDO::PARAM_STR);
			$stmtDatosProv->bindParam(':cedula_fiscal_id', $this->cedula_fiscal_id, PDO::PARAM_STR);
			$stmtDatosProv->execute();

			// Insertar en finca
			$stmtFinca = $co->prepare("INSERT INTO finca (
            ubicacion,
            nombre_finca,
            estado,
            municipio,
            parroquia,
            ciudad
            
        ) VALUES (
            :ubicacion,
            :nombre_finca,
            :estado,
            :municipio,
            :parroquia,
            :ciudad
           
        )");
			$stmtFinca->bindParam(':ubicacion', $this->ubicacion, PDO::PARAM_STR);
			$stmtFinca->bindParam(':nombre_finca', $this->nombre_finca, PDO::PARAM_STR);
			$stmtFinca->bindParam(':estado', $this->estado, PDO::PARAM_STR);
			$stmtFinca->bindParam(':municipio', $this->municipio, PDO::PARAM_STR);
			$stmtFinca->bindParam(':parroquia', $this->parroquia, PDO::PARAM_STR);
			$stmtFinca->bindParam(':ciudad', $this->ciudad, PDO::PARAM_STR);

			$stmtFinca->execute();

			// Insertar en proveedor
			$stmtProveedor = $co->prepare("INSERT INTO proveedor (
            finca_idfinca,
            datos_prov_identificacion
        ) VALUES (
            LAST_INSERT_ID(),
            :identificacion
        )");
			$stmtProveedor->bindParam(':identificacion', $this->identificacion, PDO::PARAM_STR);
			$stmtProveedor->execute();

			return "Registro incluido";
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}


	/* function modificar()
{
    $co = $this->conecta();
    $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    try {
        $co->beginTransaction();

        $sql1 = "UPDATE datos_prov
                    JOIN proveedor ON datos_prov.identificacion = proveedor.datos_prov_identificacion
                    SET
                        datos_prov.identificacion = '{$this->identificacion}',
                        datos_prov.nombre_prov = '{$this->nombre_prov}',
                        datos_prov.telefono = '{$this->telefono}',
                        datos_prov.cedula_fiscal_id = '{$this->cedula_fiscal_id}'
                    WHERE
                        proveedor.id_prov = '{$this->id_prov}'";

        $co->query($sql1);

        $sql2 = "UPDATE finca
                    JOIN proveedor ON finca.idfinca = proveedor.finca_idfinca
                    SET
                        finca.ubicacion = '{$this->ubicacion}',
                        finca.nombre_finca = '{$this->nombre_finca}',
                        finca.estado = '{$this->estado}',
                        finca.municipio = '{$this->municipio}',
                        finca.parroquia = '{$this->parroquia}',
                        finca.ciudad = '{$this->ciudad}'
                    WHERE
                        proveedor.id_prov = '{$this->id_prov}'";

        $co->query($sql2);

        $co->commit();

        return "Datos de datos_prov y finca actualizados correctamente chaMO";
    } catch (Exception $e) {
        $co->rollBack();
        return $e->getMessage();
    }
} */

function modificar()
{
    $co = $this->conecta();
    $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    try {
        $co->beginTransaction();

        // Actualizar datos del proveedor en la tabla datos_prov
        $sql1 = "UPDATE proveedor 
                INNER JOIN datos_prov ON proveedor.datos_prov_identificacion = datos_prov.identificacion
                SET
                    datos_prov.identificacion = :identificacion,
                    datos_prov.nombre_prov = :nombre_prov,
                    datos_prov.telefono = :telefono,
                    datos_prov.cedula_fiscal_id = :cedula_fiscal_id
                WHERE
                    proveedor.id_prov = :id_prov";

        $stmt1 = $co->prepare($sql1);
        $stmt1->bindParam(':identificacion', $this->identificacion);
        $stmt1->bindParam(':nombre_prov', $this->nombre_prov);
        $stmt1->bindParam(':telefono', $this->telefono);
        $stmt1->bindParam(':cedula_fiscal_id', $this->cedula_fiscal_id);
        $stmt1->bindParam(':id_prov', $this->id_prov);
        $stmt1->execute();

        // Actualizar datos de la finca en la tabla finca
        $sql2 = "UPDATE proveedor 
                INNER JOIN finca ON proveedor.finca_idfinca = finca.idfinca
                SET
                    finca.ubicacion = :ubicacion,
                    finca.nombre_finca = :nombre_finca,
                    finca.estado = :estado,
                    finca.municipio = :municipio,
                    finca.parroquia = :parroquia,
                    finca.ciudad = :ciudad
                WHERE
                    proveedor.id_prov = :id_prov";

        $stmt2 = $co->prepare($sql2);
        $stmt2->bindParam(':ubicacion', $this->ubicacion);
        $stmt2->bindParam(':nombre_finca', $this->nombre_finca);
        $stmt2->bindParam(':estado', $this->estado);
        $stmt2->bindParam(':municipio', $this->municipio);
        $stmt2->bindParam(':parroquia', $this->parroquia);
        $stmt2->bindParam(':ciudad', $this->ciudad);
        $stmt2->bindParam(':id_prov', $this->id_prov);
        $stmt2->execute();

        $co->commit();

        return "Datos del proveedor y la finca actualizados correctamente";
    } catch (Exception $e) {
        $co->rollBack();
        return $e->getMessage();
    }
}








	public function mostrarproveedor()
	{


		$co1 = $this->conecta();
		$co1->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$sql = $co1->query("SELECT p.id_prov, dp.identificacion, dp.nombre_prov, f.ubicacion, f.nombre_finca
        FROM datos_prov dp
        INNER JOIN proveedor p ON dp.identificacion = p.datos_prov_identificacion
        INNER JOIN finca f ON p.finca_idfinca = f.idfinca");

		return $sql;
		/* echo $sql; */
	}

	public function mostrartodo()
	{
		$id_prov = $_POST['id_prov'];
		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		try {
			$sql = "SELECT 
			p.id_prov,
			p.finca_idfinca,
			p.datos_prov_identificacion,
			f.idfinca,
			f.ubicacion,
			f.nombre_finca,
			f.estado,
			f.municipio,
			f.parroquia,
			f.ciudad,
			dp.identificacion,
			dp.nombre_prov,
			dp.telefono,
			dp.cedula_fiscal_id,
			cf.id_cedula_fiscal
		FROM 
			proveedor p
		INNER JOIN 
			finca f ON p.finca_idfinca = f.idfinca
		INNER JOIN 
			datos_prov dp ON p.datos_prov_identificacion = dp.identificacion
		INNER JOIN 
			cedula_fiscal cf ON dp.cedula_fiscal_id = cf.id_cedula_fiscal
		WHERE 
			p.id_prov = :id_prov";


			// Preparar la consulta
			$stmt = $co->prepare($sql);
	


		$stmt->bindParam(':id_prov', $id_prov, PDO::PARAM_STR);
		


			// Asignar el valor del parámetro ID del proveedor y ejecutar la consulta
			/* $stmt->bindParam(':id_prov', $id_prov, PDO::PARAM_INT); */
			$stmt->execute();

			// Obtener los resultados de la consulta
			$resultado = $stmt->fetch(PDO::FETCH_ASSOC);
			$retorno = json_encode($resultado);
			
			return $retorno;
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}



	public function borrar()
	{
		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		try {


			$stmt = $co->prepare("DELETE dp, f, p
                     FROM proveedor p
                     LEFT JOIN datos_prov dp ON p.datos_prov_identificacion = dp.identificacion
                     LEFT JOIN finca f ON p.finca_idfinca = f.idfinca
                     WHERE p.id_prov = :id_prov");

			$stmt->bindParam(':id_prov', $this->id_prov, PDO::PARAM_STR);
			$stmt->execute();



			return "Registro Eliminado";
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}
}
