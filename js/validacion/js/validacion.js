
function getRadioButtonSelectedValue(ctrl)
{
	for(i=0;i<ctrl.length;i++)
		if(ctrl[i].checked)return ctrl[i].value;
}
function esEmailCorrecto (email) {return (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\D{2,4})+$/.test(email));}
function validacion_mgd(obj,tipo,obligatorio,posicion){
	
	var valor=obj.value;
	var validaObligatorio;
	var resultado=true;
	
	if (obligatorio==1 && valor=="")
		errorObligatorio=true;
	else
		errorObligatorio=false;
		
	
		switch(tipo){
			case "texto":
				//alert(!isNaN(valor));
				//alert(validaObligatorio);
				if (!isNaN(valor) || errorObligatorio)
					resultado=true;
				else
					resultado=false;
					
				operacion(resultado,lang_texto,obj,posicion);
			break;
			case "email":
				
				if (esEmailCorrecto(valor)==false || errorObligatorio)
					resultado=true;
				else
					resultado=false;
					
				operacion(resultado,lang_email,obj,posicion);
			break;
			// iguala a otro campo que no tenga "re" delante
			// Ejemplo: repassword, y password, Tipico campo para verificar que se vuelve a escribir correctamente
			case "igual":
				if (valor == $(obj.get('id').substring(2)).value)
					resultado=false;
				else
					resultado=true;
					
				operacion(resultado,lang_igual,obj,posicion);
			break;
			case "emailUnico":
				if(texto!=""){auxiliar="NO";}
				operacion(auxiliar,texto,obj,posicion);
			break;
			case "equipoUnico":if(texto!=""){auxiliar="NO";}
				operacion(auxiliar,texto,obj,posicion);
			break;
			case "numerico":
				if (isNaN(valor) || errorObligatorio)
					resultado=true;
				else
					resultado=false;
					
				operacion(resultado,lang_numerico,obj,posicion);
				break;
			default:
				if (errorObligatorio)
					resultado=true;
				else
					resultado=false;
					
				operacion(resultado,lang_obligatorio,obj,posicion);
			break;

	}
	/*}}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("tipo="+tipo+"&valor="+valor+"&obligatorio="+obligatorio)*/
}

function operacion(resultado,textoError,obj,posicion){
	//alert('caja_error_' + obj.get('id'));
	var objCaja=$('caja_error_' + obj.get('id'));
	if(resultado==true)
	{
		$('validacion_estado_' + obj.get('id')).value="0";
		if(objCaja){
			objCaja.destroy();
			new VentanaError(obj.get('id'),textoError,posicion);
		}else{
			new VentanaError(obj.get('id'),textoError,posicion);
		}
	}else{
		$('validacion_estado_' + obj.get('id')).value="1";
		if(objCaja){
			
			obj.removeClass('error_campo_mgd');
			objCaja.fade('out');
			//$('imgError'+numId).fade('out');
			//(function(){$('imgError'+numId).destroy()}).delay(400);
			(function(){objCaja.destroy()}).delay(400);
			
		}

	}
}