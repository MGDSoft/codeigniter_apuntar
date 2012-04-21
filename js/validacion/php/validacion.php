<?php 
require_once '../../nucleo/database.class.php';
require_once '../../nucleo/seguridad.php';


$tipo=$_POST['tipo'];
$valor=$_POST['valor'];
$obligatorio=$_POST['obligatorio'];



switch($tipo){
case "texto":
if (!soloTexto($valor)){
echo "NO";}

break;
case "email":
	if ($valor=="" || $valor==NULL){
		if ($obligatorio==1){echo "NO";}
	}else{
		if (!email($valor)){echo "NO";}
	
	}
break;
case "numerico":
	if ($valor=="" || $valor==NULL){
		if ($obligatorio==1){echo "NO";}
	}else{
		if (!is_numeric($valor)){echo "NO";}
	
	}
break;
case "emailUnico":
	if ($valor=="" || $valor==NULL){
		if ($obligatorio==1){echo "El correo es obligatorio";}
	}else{
		if (!email($valor)){echo "El correo es incorrecto";}else{
		$db = DataBase::getInstance();
		
		 $sql="SELECT email FROM usuario WHERE email='".$valor."'";
			$db->setQuery($sql);
			if ($user = $db->loadObject()){  //9	
			echo "Este correo ya esta usado";
			}
		
		}
	
}
break;
case "equipoUnico":
	if ($valor=="" || $valor==NULL){
		if ($obligatorio==1){echo "El nombre es obligatorio";}
	}else{
		$valor=urls_amigables($valor);
		if (nombreUnico($valor)==false){echo "Este nombre de equipo ".$valor." ya esta usado";}	
			
		
		
		
	
	}
break;
}
?>