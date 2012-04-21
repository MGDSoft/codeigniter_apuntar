
var raiz="http://myequipostatic.appspot.com/myequipo/";
/*var VentanaInfo = new Class({
    initialize: function(html,top){
		if (!top)
			top=20;
		obj=new Element('div', {
		'html': '<table align="center" cellspacing="0" align="center" cellpadding="0" border="0" width="320"><tbody><tr><td background="' + raiz  + 'validacionFormularios/images/top_left.png" width="14" height="16"></td><td background="' + raiz  + 'validacionFormularios/images/top.png"></td><td background="' + raiz  + 'validacionFormularios/images/top_right.png" width="14" height="16"></td></tr><tr valign="top"><td background="' + raiz  + 'validacionFormularios/images/left.png"></td><td background="' + raiz  + 'validacionFormularios/images/inner.png" align="center" width="270" style="color:#ffffff">'+ html  + ' </td><td background="' + raiz  + 'validacionFormularios/images/right.png"></td></tr>	 <tr><td background="' + raiz  + 'validacionFormularios/images/bottom_left.png" height="14"></td><td background="' + raiz  + 'validacionFormularios/images/down.png"></td><td background="' + raiz  + 'validacionFormularios/images/bottom_right.png" height="14"></td></tr></tbody></table>	 ',
		"styles": {
		'position': 'fixed',
		'bottom': 'auto',
		'height':'80px',
		'margin-left':'-160px',
		'left':'50%',
		'display': 'none',
		'z-index':'999999999999',
		'display':'block',		
        'top': top,		
		'color':'#ffffff',
		'font': '14px/15px "Lucida Grande", Arial, Helvetica, Verdana, sans-serif'
	}}).fade(0).inject(document.body,'top');
		(function(){ obj.fade('in'); }).delay(1000);
		(function(){ obj.fade('out'); }).delay(7000);
		(function(){ obj.destroy(); }).delay(8000);
		
    }
});
*/
//creo una clase para conseguir que un textarea tenga un contador de caracteres
var VentanaError = new Class({
   //defino un constructor, que recibe el id del textarea
   initialize: function(idTextarea,textoError,numId){
	
	textoError="<b><font color=red>Error:</font><font color=white> "+textoError+"</font></b>";
	//recupero el elemento textarea con la funci�n dolar
	this.textarea =$(idTextarea);
	this.textarea.addClass('error_campo_mgd')
	//creo un elemento SPAN para mostrar el contador
	var derecha= 22;
	var arriba= -56;
	var idCajonNuevo="caja_error_" + idTextarea;
	var table = new Element('table', {'class' : 'tipsbox',
	"id" : idCajonNuevo,
	"styles": {
	"position": "absolute"
   }});	  

	table.cellPadding ='0';
	table.cellSpacing ='0';
	table.border ='0';

	var tbody = new Element('tbody').inject(table);
	
	var tr1 = new Element('tr').inject(tbody);

	new Element('td', {'class' : 'tipsbox_top_left'}).inject(tr1);
	new Element('td', {'class' : 'tipsbox_top'}).inject(tr1);
	new Element('td', {'class' : 'tipsbox_top_right'}).inject(tr1);
	var tr2 = new Element('tr').inject(tbody);
	new Element('td', {'class' : 'tipsbox_left'}).inject(tr2);
	
	var errors = new Element('td', {'class' : 'tipsbox_inner','html': textoError }).inject(tr2);
	//var errorImg = new Element('',{'html': textoError}).inject(errors);
	new Element('td', {'class' : 'tipsbox_right'}).inject(tr2);
	var tr3 = new Element('tr').inject(tbody);
	new Element('td', {'class' : 'tipsbox_bottom_left'}).inject(tr3);
	if (numId==999)						
		new Element('td', {'class' : 'tipsbox_down'}).inject(tr3);
	else
		new Element('td', {'class' : 'tipsbox_mark'}).inject(tr3);
	
	new Element('td', {'class' : 'tipsbox_bottom_right'}).inject(tr3);
	 
	 
	table.set("styles", {
	'left' : this.textarea.getCoordinates().right - derecha ,
	'top'	: this.textarea.getCoordinates().top + arriba
		 });

	table.fade(0);
	table.inject(this.textarea, "before");
	$(idCajonNuevo).fade("in");
	
      //llamo al m�todo que cuenta caracteres, para inicializar el contador
   
   }
      
});   

var VentanaInfo = new Class({
   //defino un constructor, que recibe el id del textarea
   initialize: function(idTextarea,texto,posicion){
      //recupero el elemento textarea con la funci�n dolar

      this.textarea =idTextarea;
	
      //creo un elemento SPAN para mostrar el contador
	var derecha= +200;
	var arriba= 8;
	var idCajonNuevo="verde";
	var table = new Element('table', {'class' : 'tipsbox',
		"id" : idCajonNuevo,
		"styles": {
		"position": "absolute",
		"z-index": 3 
    }});

	table.cellPadding ='0';
	table.cellSpacing ='0';
	table.border ='0';
	table.width='250';
	
	var tbody = new Element('tbody').inject(table);
	var tr1 = new Element('tr').inject(tbody);
	new Element('td', {'class' : 'ArribaIzqVerde'}).inject(tr1);
	new Element('td', {'class' : 'ArribaVerde'}).inject(tr1);
	new Element('td', {'class' : 'ArribaDerVerde'}).inject(tr1);
	var tr2 = new Element('tr').inject(tbody);
	if (posicion==1 || posicion==3){
	//new Element('td', {'class' : 'IzqVerde'}).inject(tr2);
		new Element('td', {'class' : 'IzqVerde'}).inject(tr2);

	}else{
	new Element('td', {'class' : 'IzqVerdeRotado'}).inject(tr2);

	}
	var errors = new Element('td', {'class' : 'DentroVerde','html': "<b>" + texto + "</b>"}).inject(tr2);
	//var errorImg = new Element('',{'html': textoError}).inject(errors);
	if (posicion==1){
	new Element('td', {'class' : 'DerVerde'}).inject(tr2);
	}else{
	new Element('td', {'class' : 'DerVerdeRotado'}).inject(tr2);

	}
	var tr3 = new Element('tr').inject(tbody);
	new Element('td', {'class' : 'AbajoIzqVerde'}).inject(tr3);
	new Element('td', {'class' : 'AbajoVerde'}).inject(tr3);
	new Element('td', {'class' : 'AbajoDerVerde'}).inject(tr3);

			 
	var otroMas=table;

	if (posicion==1){

	 otroMas.set("styles", {
	 'left' : this.textarea.getCoordinates().left - derecha ,
	 'top'	: this.textarea.getCoordinates().bottom + arriba
			 }) ;
	 }else if (posicion==3){
		
		 otroMas.set("styles", {
			 'right' : '10px',
			 'top'	: '20px'
					 });
	 }else{
		 otroMas.set("styles", {
	 'left' : this.textarea.getCoordinates().right+5 ,
	 'top'	: this.textarea.getCoordinates().top - this.textarea.getCoordinates().bottom + this.textarea.getCoordinates().bottom +  - arriba
			 }) ;
						}
	otroMas.fade(1);
	otroMas.inject(this.textarea, "before");
	//$(idCajonNuevo).fade("in");
      //inyecto el contador despu�s del textarea
      
      
      //creo un evento para el textarea, keyup, para cuando el usuario suelta la tecla
   /*   this.textarea.addEvent("keyup", function(){
	  reValidacion(obj,$("cajon"),tipo)
		
	
      }.bind(this)
      );*/
      
      //llamo al m�todo que cuenta caracteres, para inicializar el contador
     
    
   }
   
   
   
   //creo un m�todo para contar los caracteres
   
});   

 function creacionEventos(id,texto,tipe,obligatorio,posicion,tamano){
	
	var obj=$(id);
	
	// Ventana de ayuda
	if (texto!=""){
		obj.addEvent("focus", function()
		{

			if ($('verde'))
				(function(){ new VentanaInfo(obj,texto,posicion,tamano)}).delay(400);
			else
				new VentanaInfo(obj,texto,posicion);

		});

		obj.addEvent("blur", function(){
			if ($('verde'))
			{
				$('verde').fade('out');	
				(function(){$('verde').destroy()}).delay(400);
			}
		});
	}
	// Ventana de error
	if (tipe!="" || obligatorio==1)
	{
		
		new Element('input', {
		'type': 'hidden',
		'id': 'validacion_estado_'+id,
		'validacion' : 'si',
		'value' : (obligatorio==1) ? '0' :'1',
		'aviso' : "($('"+id+"'),'" + tipe + "','" + obligatorio + "');"
		}).inject(obj,'after');
		
		
		if (tipe=='texto' || tipe=='numerico'){

			obj.addEvent("keyup", function(){
				validacion_mgd(obj,tipe, obligatorio);
			});
		}else{

			obj.addEvent("change", function(){
				validacion_mgd(obj,tipe, obligatorio);
			});
		} 

	}
}
 
 
 
function creacionVista(id,texto,posicion,tamano){
	var obj=$(id);
	obj.addEvent("mouseover", function()
	{
		if ($('verde'))
			$('verde').destroy();
		
		new VentanaInfo(obj,texto,posicion);

	});
 
	obj.addEvent("mouseout", function(){
	$('verde').fade('out');		   

	 });  
 }

//creo un evento para cuando est� listo el DOM de la p�gina
/*<input type="text" id="email" name="email"  onchange="validacion(this,'email', 2)"  completarForm("email","Prueba<br><br><font color=yellow>Ejemplo:</font> 33",2);?>*/


/*window.addEvent("domready", function(){
   //creo el objeto TextareaContador, pasando el identificador del textarea que se pretende contar caracteres.
     texto = new TextareaContador($('texto'),'asd',1);

//creacionEventos('texto','Elige el nombre que mas te guste y a la vez te describa<br><br><font color=yellow>Ejemplo:</font> Perrito Salvaje',1);

});*/


