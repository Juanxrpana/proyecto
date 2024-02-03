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


	  $o = new Registrocafe_tostado(); //ahora nuestro objeto //se llama $o y es una copia en memoria de la
	  //clase Registrocafe_tostado

	  if(!empty($_POST)){

		  //como ya sabemos si estamos aca es //porque se recibio alguna informacion
		  //de la vista, por lo que lo primero que //debemos hacer ahora que tenemos una
		  //clase es guardar esos valores en ella //con los metodos set
		  $accion = $_POST['accion'];

		   if($accion=='consultar'){
            
			/*  echo  $o->consultar(); */
		  }	  
		  

		  elseif($accion=='eliminar'){
			 $o->set_idcafe_tostado($_POST['idcafe_tostado']);
			 echo  $o->borrarcafe_tostado();
		  }
		  else{
			 
           
              $o->set_cantidad($_POST['cantidad']);
			  $o->set_nivel_tostado($_POST['nivel_tostado']);
			  $o->set_nivel_molido($_POST['nivel_molido']);
              
			  if($accion=='incluir'){
				echo  $o->agregarcafe_tostado();
			  }
			  elseif($accion=='modificar'){
				
				 $o->set_idcafe_tostado($_POST['idcafe_tostado']);
				 echo  $o->modificarcafe_tostado();
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