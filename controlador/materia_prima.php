<?php

//llamada al archivo que contiene la clase
//usuarios, en ella estara el codigo que me //permitirá
//guardar, consultar y modificar dentro de mi base //de datos


//lo primero que se debe hacer es verificar al //igual que en la vista que exista el archivo
if (!is_file("modelo/".$pagina.".php")){
	//alli pregunte que si no es archivo se niega //con !
	//si no existe envio mensaje y me salgo
	echo "Falta definir la clase ".$pagina;
	exit;
}
require_once("modelo/".$pagina.".php");
  if(is_file("vista/".$pagina.".php")){

	  //bien si estamos aca es porque existe la //vista y la clase
	  //por lo que lo primero que debemos hace es //realizar una instancia de la clase
	  //instanciar es crear una variable local, //que contiene los metodos de la clase
	  //para poderlos usar


	  $o = new Registromateria_prima(); //ahora nuestro objeto //se llama $o y es una copia en memoria de la
	  //clase Registromateria_prima

	  if(!empty($_POST)){

		  //como ya sabemos si estamos aca es //porque se recibio alguna informacion
		  //de la vista, por lo que lo primero que //debemos hacer ahora que tenemos una
		  //clase es guardar esos valores en ella //con los metodos set
		  $accion = $_POST['accion'];

		   if($accion=='consultar'){
            
			 echo  $o->consultar();
		  }	  
		  

		  elseif($accion=='eliminar'){
			 $o->set_idcompra1($_POST['idcompra']);
			 echo  $o->borrarmateria_prima();
		  }
		  else{
			 
           
              $o->set_fecha($_POST['fecha']);
			  $o->set_calidad1($_POST['calidad1']);
			  $o->set_calidad2($_POST['calidad2']);
			  $o->set_cantidad1($_POST['cantidad1']);
			  $o->set_cantidad2($_POST['cantidad2']);
              
			  if($accion=='incluir'){
                $o->set_proveedor($_POST['proveedor']);
				echo  $o->agregarmateria_prima();
			  }
			  if ($accion == 'generar_individual') {


				//bien si estamos aca es porque existe la vista y la clase
				//por lo que lo primero que debemos hace es realizar una instancia de la clase
				//instanciar es crear una variable local, que contiene los metodos de la clase
				//para poderlos usar
				$o->set_idcompra1($_POST['idcompra']);
				$o->set_proveedor($_POST['proveedor']);
				$o->generar_reporte_compra_individual();
			}
			  elseif($accion=='modificar'){

                $o->set_idcompra1($_POST['idcompra']);
				echo  $o->modificar();
			  }
		  }
		  exit;
	  }


	  require_once("vista/".$pagina.".php");
  }
  else{
	  echo "pagina en construccion";
  }
?>
