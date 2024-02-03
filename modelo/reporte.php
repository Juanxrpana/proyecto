<?php
error_reporting(E_ALL | E_STRICT |  E_ERROR | E_WARNING | E_PARSE | E_COMPILE_ERROR);
require_once('dompdf/vendor/autoload.php'); //archivo para cargar las funciones de la 
//libreria DOMPDF
// lo siguiente es hacer rerencia al espacio de trabajo
use Dompdf\Dompdf; //Declaracion del espacio de trabajo

require_once('Conexion.php');

class reporte extends Conexion
{
    private $proveedor;
    private $idcompra1;
    private $fecha;
    private $usuario;
    private $calidad1; //recuerden que en php, las variables no tienen tipo predefinido
    private $calidad2;
    private $cantidad1;
    private $cantidad2;


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

    public function generar_reporte_compra()
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
            echo "Factura: " . $e->getMessage();
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
