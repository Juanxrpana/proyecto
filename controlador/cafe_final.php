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
};
require_once("modelo/".$pagina.".php");
  if(is_file("vista/".$pagina.".php")){
	
	  //bien si estamos aca es porque existe la //vista y la clase
	  //por lo que lo primero que debemos hace es //realizar una instancia de la clase
	  //instanciar es crear una variable local, //que contiene los metodos de la clase
	  //para poderlos usar


	  $o = new Registrocafe_final(); //ahora nuestro objeto //se llama $o y es una copia en memoria de la
	  //clase Registrocafe_final

	  if(!empty($_POST)){

		  //como ya sabemos si estamos aca es //porque se recibio alguna informacion
		  //de la vista, por lo que lo primero que //debemos hacer ahora que tenemos una
		  //clase es guardar esos valores en ella //con los metodos set
		  $accion = $_POST['accion'];

		   if($accion=='existe'){
            
			 echo  $o->existe($id_cafe_final);
		  }	  
		  

		  elseif($accion=='eliminar'){
			 $o->set_id_cafe_final($_POST['id_cafe_final']);
			 echo  $o->borrarcafe_final();
		  }
		  else{
			 
           
              $o->set_idcafe_tostado($_POST['idcafe_tostado']);
			  $o->set_cantidad_paquetes($_POST['cantidad_paquetes']);
			 
		
			  
              
			  if($accion=='incluir'){
				echo  $o->agregarcafe_final();
			  }
			  elseif($accion=='modificar'){

                $o->set_id_cafe_final($_POST['id_cafe_final']);
				echo  $o->modificarcafe_final();
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