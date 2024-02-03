<?php
error_reporting(E_ALL | E_STRICT |  E_ERROR | E_WARNING | E_PARSE | E_COMPILE_ERROR);
require_once('dompdf/vendor/autoload.php'); //archivo para cargar las funciones de la 
//libreria DOMPDF
// lo siguiente es hacer rerencia al espacio de trabajo
use Dompdf\Dompdf; //Declaracion del espacio de trabajo


require_once('Conexion.php');


class Registromateria_prima extends Conexion
{
	
	private $proveedor;
	private $idcompra1;
	private $fecha;
	private $usuario;
	private $calidad1; //recuerden que en php, las variables no tienen tipo predefinido
	private $calidad2;
	private $cantidad1;
	private $cantidad2;
	private $estado;

	//Ok ya tenemos los atributos, pero como son privados no podemos acceder a ellos desde fueran
	//por lo que debemos colcoar metodos (funciones) que me permitan leer (get) y colocar (set)

	function set_proveedor($valor)
	{
		$this->proveedor  = $valor;
	}
	function set_fecha($valor)
	{
		$this->fecha  = $valor;
	}
	function set_idcompra1($valor)
	{
		$this->idcompra1  = $valor;
	}
	function set_usuario($valor)
	{
		$this->usuario  = $valor;
	}
	function set_calidad1($valor)
	{
		$this->calidad1  = $valor;
	}
	function set_calidad2($valor)
	{
		$this->calidad2  = $valor;
	}
	function set_cantidad1($valor)
	{
		$this->cantidad1  = $valor;
	}
	function set_cantidad2($valor)
	{
		$this->cantidad2  = $valor;
	}


	//ahora la misma cosa pero para leer, es decir get



	function get_proveedor()
	{
		return $this->proveedor;
	}
	function get_fecha()
	{
		return $this->proveedor;
	}
	function get_usuario()
	{
		return $this->proveedor;
	}

	function get_calidad1()
	{
		return $this->calidad1;
	}
	function get_calidad2()
	{
		return $this->calidad2;
	}
	function get_cantidad1()
	{
		return $this->cantidad1;
	}
	function get_cantidad2()
	{
		return $this->cantidad2;
	}




	public function existe($id_materia_prima)
	{
		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		try {
			$resultado = $co->query("Select * from materia_prima where id_materia_prima	='$id_materia_prima'");
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
	//ahora incluiremos una materia_prima//
	function agregarmateria_prima()
	{
		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		try {
			// Insertar en compra
			$stmtCompra = $co->prepare("INSERT INTO compra (
				proveedor_id_proveedor,
				usuario_idusuario,
				fecha_compra
			) VALUES (
				:proveedor,
				'28150004',
				:fecha
			)");
			$stmtCompra->bindParam(':proveedor', $this->proveedor, PDO::PARAM_INT);
			$stmtCompra->bindParam(':fecha', $this->fecha, PDO::PARAM_STR);
			$stmtCompra->execute();

			$idCompra = $co->lastInsertId();

			// Insertar en quintal
			if ($this->cantidad1 != NULL) {
				$stmtQuintal1 = $co->prepare("INSERT INTO quintal (
					idcompra,
					cantidad,
					calidad_idcalidad,
					estado
				) VALUES (
					:idCompra,
					:cantidad1,
					:calidad1,
					'1'
				)");
				$stmtQuintal1->bindParam(':idCompra', $idCompra, PDO::PARAM_INT);
				$stmtQuintal1->bindParam(':cantidad1', $this->cantidad1, PDO::PARAM_INT);
				$stmtQuintal1->bindParam(':calidad1', $this->calidad1, PDO::PARAM_INT);
				$stmtQuintal1->execute();
			}

			if ($this->cantidad2 != NULL) {
				$stmtQuintal2 = $co->prepare("INSERT INTO quintal (
					idcompra,
					cantidad,
					calidad_idcalidad,
					estado
				) VALUES (
					:idCompra,
					:cantidad2,
					:calidad2,
					'1'
				)");
				$stmtQuintal2->bindParam(':idCompra', $idCompra, PDO::PARAM_INT);
				$stmtQuintal2->bindParam(':cantidad2', $this->cantidad2, PDO::PARAM_INT);
				$stmtQuintal2->bindParam(':calidad2', $this->calidad2, PDO::PARAM_INT);
				$stmtQuintal2->execute();
			}

			return "Cantidad";
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}




	function modificar()
	{
		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		try {
			// Consulta SQL para actualizar la fecha de compra
			$stmtFechaCompra = $co->prepare("UPDATE compra SET fecha_compra = :fecha WHERE idcompra = :idcompra");
			$stmtFechaCompra->bindParam(':fecha', $this->fecha, PDO::PARAM_STR);
			$stmtFechaCompra->bindParam(':idcompra', $this->idcompra1, PDO::PARAM_INT);
			$stmtFechaCompra->execute();

			// Consulta SQL para verificar la existencia de una entrada con calidad 2
			$verificarSQL = "SELECT COUNT(*) AS count FROM quintal WHERE idcompra = :idcompra AND calidad_idcalidad = :calidad";
			$stmtVerificar = $co->prepare($verificarSQL);

			// Consulta SQL para actualizar o insertar en la tabla quintal para calidad 1
			$stmtQuintal1 = $co->prepare("INSERT INTO quintal (idcompra, calidad_idcalidad, cantidad) VALUES (:idcompra, :calidad, :cantidad) ON DUPLICATE KEY UPDATE cantidad = :cantidad");
			$stmtQuintal1->bindParam(':idcompra', $this->idcompra1, PDO::PARAM_INT);
			$stmtQuintal1->bindParam(':calidad', $this->calidad1, PDO::PARAM_INT);
			$stmtQuintal1->bindParam(':cantidad', $this->cantidad1, PDO::PARAM_INT);
			$stmtQuintal1->execute();

			// Consulta SQL para actualizar o insertar en la tabla quintal para calidad 2
			$stmtQuintal2 = $co->prepare("INSERT INTO quintal (idcompra, calidad_idcalidad, cantidad) VALUES (:idcompra, :calidad, :cantidad) ON DUPLICATE KEY UPDATE cantidad = :cantidad");
			$stmtQuintal2->bindParam(':idcompra', $this->idcompra1, PDO::PARAM_INT);
			$stmtQuintal2->bindParam(':calidad', $this->calidad2, PDO::PARAM_INT);
			$stmtQuintal2->bindParam(':cantidad', $this->cantidad2, PDO::PARAM_INT);
			$stmtQuintal2->execute();

			// Actualizar la fecha de compra nuevamente (¿es necesario?)
			$stmtFechaCompra->execute();

			return "Registro Modificado";
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}



	function consultar()
	{
		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		try {

			$resultado = $co->query("SELECT datos_prov_identificacion, id_prov FROM `proveedor`");
			$resultado2 = $co->query("SELECT idcompra, SUM(cantidad) AS total_cantidad
			FROM (
			  SELECT idcompra, cantidad
			  FROM quintal
			  WHERE idcompra = '10'
			  LIMIT 2
			) AS subconsulta
			GROUP BY idcompra
			HAVING COUNT(*) > 1;");


			if ($resultado) {

				$respuesta = '';
				$respuesta = "<option value=''selected>Proveedor</option>";
				foreach ($resultado as $r) {
					$respuesta = $respuesta . "<option value=";
					$respuesta = $respuesta . " '";
					$respuesta = $respuesta . $r['id_prov'];
					$respuesta = $respuesta . "'>";
					$respuesta = $respuesta . $r['datos_prov_identificacion'];
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


	public function contador_total_materia_prima()
	{
		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$sql = $co->query("
						UPDATE total_cafe
						SET total = COALESCE((SELECT SUM(cantidad) FROM quintal WHERE estado = 1), 0) + total where id_total_cafe = 1;
						WHERE id_total_cafe = 1;
						
						");
	}

	public function inactivadormateria_prima()
	{
		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		try {
			$co->query("UPDATE quintal
						SET estado = 0
						WHERE estado = 1;");
			return "Desactivando estados";
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

	public function descontador_total_materia_prima()
	{
		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$sql = $co->query("DELIMITER //
	CREATE TRIGGER restar_valor_total_cafe
	AFTER INSERT ON cafe_tostado
	FOR EACH ROW
	BEGIN
		-- Restar el valor de cantidad al campo total de id_total_cafe 2 en total_cafe
		UPDATE total_cafe
		SET total = total - NEW.cantidad
		WHERE id_total_cafe = 1;
	END;
	//
	
	-- Modificar el trigger para también ejecutarse después de una actualización
	CREATE TRIGGER restar_valor_total_cafe_update
	AFTER UPDATE ON cafe_tostado
	FOR EACH ROW
	BEGIN
		-- Obtener la diferencia entre el nuevo y viejo valor de cantidad
		DECLARE diferencia INT;
		SET diferencia = NEW.cantidad - OLD.cantidad;
	
		-- Restar la diferencia al campo total de id_total_cafe 2 en total_cafe
		UPDATE total_cafe
		SET total = total - diferencia
		WHERE id_total_cafe = 1;
	END;
	//
	DELIMITER ;");
	}



	public function mostrarmateria_prima()
	{
		$co1 = $this->conecta();
		$co1->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$sql = $co1->query("SELECT q.estado, c.fecha_compra, pn.nombre_prov, p.datos_prov_identificacion, SUM(q.cantidad) AS total_cantidad, c.idcompra
                        FROM proveedor p
                        INNER JOIN datos_prov pn ON p.datos_prov_identificacion = pn.identificacion
                        LEFT JOIN compra c ON p.id_prov = c.proveedor_id_proveedor
                        LEFT JOIN quintal q ON c.idcompra = q.idcompra
                        
                        GROUP BY c.idcompra");

		return $sql;
	}




	public function mostrar_contador()
	{
		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		try {
			$resultado = $co->query("SELECT total FROM total_cafe WHERE id_total_cafe = 1;");
			$totalCafeVerde = $resultado->fetch(PDO::FETCH_ASSOC)['total'];
			return $totalCafeVerde;
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

	public function borrarmateria_prima()
	{
		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		try {
			$co->query("delete from compra
						where
						idcompra = '$this->idcompra1'
						");
			return "La entrada fue eliminada";
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

	public function generar_reporte_compra_individual()
    {
        //El primer paso es generar una consulta SQl tal cual como lo hemos hecho en las 
        //clases anteriores, en este caso la consulta sera sobre la compra

        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $consulta = "
            SELECT 
            q.estado, 
            c.fecha_compra, 
            pn.nombre_prov,
            p.id_prov, 
            p.datos_prov_identificacion, 
            SUM(q.cantidad) AS total_cantidad, 
            c.idcompra,
            f.estado AS estado_finca, 
            f.municipio, 
            f.parroquia, 
            f.ciudad, 
            f.nombre_finca, 
            dp.telefono,
            SUM(CASE WHEN q.calidad_idcalidad = 1 THEN q.cantidad ELSE 0 END) AS quintales_a,
            SUM(CASE WHEN q.calidad_idcalidad = 2 THEN q.cantidad ELSE 0 END) AS quintales_b
        FROM 
            proveedor p
            INNER JOIN datos_prov pn ON p.datos_prov_identificacion = pn.identificacion
            LEFT JOIN compra c ON p.id_prov = c.proveedor_id_proveedor
            LEFT JOIN quintal q ON c.idcompra = q.idcompra
            LEFT JOIN finca f ON p.finca_idfinca = f.idfinca
            LEFT JOIN datos_prov dp ON p.datos_prov_identificacion = dp.identificacion
        GROUP BY 
            c.idcompra;
        ";

            $resultado = $co->query($consulta);

            // Construir el HTML para la factura
            $html = "<!DOCTYPE html>
                <html lang='es'>
                <head>
                    <meta charset='UTF-8'>
                    <title>Factura de Compra</title>
                    <style>
                        body {
                            font-family: Arial, sans-serif;
                            text-align: center;
                        }
                        .header {
                            font-weight: bold;
                            margin-bottom: 20px;
                        }
                        .details {
                            text-align: left;
                            margin-bottom: 10px;
                        }
                        .footer {
                            margin-top: 20px;
                        }
                    </style>
                </head>
                <body>
                    <div class='header'>
                        <p>Cafe Cardenal C.A.</p>
                        <p>Sector 1 El Bosque, Tocuyo Lara Zona Postal 3018</p>
                        
                    </div>";

            // Iterar sobre los resultados de la consulta
            while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
                $html .= "<div class='details'>
                        <p>RIF/CI:{$fila['datos_prov_identificacion']}</p>
                        <p>Nombre: {$fila['nombre_prov']}</p>
                        <p>Estado: {$fila['estado_finca']}</p>
                        <p>Municipio: {$fila['municipio']}</p>
                        <p>Parroquia: {$fila['parroquia']}</p>
                        <p>Ciudad: {$fila['ciudad']}</p>
                        <p>Nombre de la finca: {$fila['nombre_finca']}</p>
                        <p>Teléfono: {$fila['telefono']}</p>
                    </div>
                    <hr>
                    <div class='header'>
                        <p>Comprobante de compra</p>
                    </div>
                    <div class='details'>
                        <p>Fecha de emisión: " . date('Y-m-d') . "</p>
                        <p>Referencia de compra: {$fila['idcompra']}</p>
                        <p>Quintales de calidad A: {$fila['quintales_a']}</p>
                        <p>Quintales de calidad B: {$fila['quintales_b']}</p>
                    </div>
                    <hr>
                    <div class='footer'>
                        <p>Total de quintales: {$fila['total_cantidad']}</p>
                    </div>
                    <div class='header'>
                        <p>Registro de compra de café verde.</p>
                    </div>";
            }

            $html .= "</body></html>";

            // Generar el PDF con DOMPDF
            $dompdf = new Dompdf();
            $dompdf->loadHtml($html);
            $dompdf->setPaper('letter', 'portrait');
            $dompdf->render();

            // Enviar el PDF al navegador del usuario
            $dompdf->stream('factura.pdf', array('Attachment' => false));
        } catch (Exception $e) {
            echo "Error al generar la factura: " . $e->getMessage();
        }
    }
}
