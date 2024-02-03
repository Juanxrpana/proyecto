<?php

//llamada al archivo que contiene la clase
//usuarios, en ella estara el codigo que me //permitirá
//guardar, consultar y modificar dentro de mi base //de datos


//lo primero que se debe hacer es verificar al //igual que en la vista que exista el archivo
if (!is_file("modelo/" . $pagina . ".php")) {
	//alli pregunte que si no es archivo se niega //con !
	//si no existe envio mensaje y me salgo
	echo "Falta definir la clase " . $pagina;
	exit;
}
require_once("modelo/" . $pagina . ".php");
if (is_file("vista/" . $pagina . ".php")) {

	//bien si estamos aca es porque existe la //vista y la clase
	//por lo que lo primero que debemos hace es //realizar una instancia de la clase
	//instanciar es crear una variable local, //que contiene los metodos de la clase
	//para poderlos usar


	$o = new Registroproveedor(); //ahora nuestro objeto //se llama $o y es una copia en memoria de la
	//clase Registromproveedor

	if (!empty($_POST)) {

		//como ya sabemos si estamos aca es //porque se recibio alguna informacion
		//de la vista, por lo que lo primero que //debemos hacer ahora que tenemos una
		//clase es guardar esos valores en ella //con los metodos set
		$accion = $_POST['accion'];

		if ($accion == 'consultar') {
			echo  $o->consultar();
		}

		if ($accion == 'identificacion') {
			$o->set_id_prov($_POST['id_prov']);
			echo  $o->existe($id_prov);
		} elseif ($accion == 'eliminar') {
			$o->set_id_prov($_POST['id_prov']);
			echo  $o->borrar();
		} elseif ($accion == 'llenardatos_ocultos') {
			$o->set_id_prov($_POST['id_prov']);
			echo $o->mostrartodo();
		} else {
			$o->set_id_prov($_POST['id_prov']);
			$o->set_cedula_fiscal_id($_POST['cedula_fiscal_id']);
			$o->set_identificacion($_POST['identificacion']);
			$o->set_nombre_prov($_POST['nombre_prov']);
			$o->set_telefono($_POST['telefono']);
			$o->set_ubicacion($_POST['ubicacion']);
			$o->set_nombre_finca($_POST['nombre_finca']);
			$o->set_estado($_POST['estado']);
			$o->set_municipio($_POST['municipio']);
			$o->set_parroquia($_POST['parroquia']);
			$o->set_ciudad($_POST['ciudad']);


			if ($accion == 'incluir') {
				echo  $o->agregar_proveedor();
			} elseif ($accion == 'modificar') {
				$o->set_id_prov($_POST['id_prov']);
				echo  $o->modificar();
			}
		}
		exit;
	}


	require_once("vista/" . $pagina . ".php");
} else {
	echo "pagina en construccion";
}
