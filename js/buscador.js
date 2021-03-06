var buscadorCategorias=new Class({
	 options: {
		 busqueda_caracteres:2,
		 ghost_class:'ghost_input'
	 },
	 
initialize:function(obj,id_web,url_busqueda,buscador){
	
	this.ghost_text=obj.value;
	
	this.obj=obj;
	this.id_web=id_web;
	this.url_busqueda=url_busqueda;
	this.buscador=buscador;
	
	this.activar_ghost_text();
	
	this.crearCajaSugerencias();
	this.darTodosEventos();
	
	
	
	
},
activar_ghost_text:function(){
   this.obj.addClass(this.options.ghost_class);
},
desactivar_ghost_text:function(){
   this.obj.removeClass(this.options.ghost_class);
},
crearCajaSugerencias:function(){

	var thisClass=this;
	
   this.caja_sugerencias=new Element('div', {
	   'class' : 'sugerencias_helper',
	   'styles': {
			'left' :  this.obj.getCoordinates().left ,
			'top'	: this.obj.getCoordinates().top + 40,
			'width'	: this.obj.getCoordinates().right - this.obj.getCoordinates().left  ,
			 }
   }).inject(this.obj,'after');
   
   $(document.body).addEvent('click',function(e) {
	   if(thisClass.caja_sugerencias && !e.target || !$(e.target).getParents().contains(thisClass.caja_sugerencias)) {
		   thisClass.vaciarCajaSugerencias();
	   }
	 });
   	
   
},

darTodosEventos:function(){
   
   this.eventoOnKeyUp();
   this.eventoOnClick();
   this.eventoOnBlur();
},
vaciarCajaSugerencias:function(){
	this.caja_sugerencias.innerHTML='';
},
limpiarCajaTexto:function(){
	this.obj.value=this.ghost_text;
	this.activar_ghost_text();
},
sugerenciaJson:function(obj){
   
   var thisClass=this;
	
   thisClass.caja_sugerencias.innerHTML='';
   
   
  
   obj.each(function(item, index)
	{
	   sugerencia=new Element('div', {
			'html': (thisClass.buscador == 1) ? item.titulo : item.nombre
			}).inject(thisClass.caja_sugerencias);
	   
	   sugerencia.addEvent('click', function(event){
		   thisClass.agregarBusqueda(this.innerHTML);			
		});	
	});
	
},
agregarBusqueda:function(html_txt){
	this.desactivar_ghost_text();
	this.obj.value=html_txt;
	this.caja_sugerencias.innerHTML='';
	this.obj.highlight('#ddf','#fff');
},
eventoOnBlur:function(){
	
	var thisClass=this;
   
   
   this.obj.addEvent('blur', function(event){
		if (this.value=="")
		{
			this.value=thisClass.ghost_text;
			thisClass.activar_ghost_text();
			thisClass.vaciarCajaSugerencias();
		}
	});			
},
eventoOnClick:function(){
   
   var thisClass=this;
   
   
   this.obj.addEvent('click', function(event){
	   
	   valor=thisClass.obj.value;
	   
		if (valor==thisClass.ghost_text)
		{
			thisClass.obj.value='';
			thisClass.desactivar_ghost_text();
		}
	});			
},
eventoOnKeyUp:function(){
   
   var thisClass=this;
   var box_active=null;
   this.obj.addEvent('keyup', function(event){
		if (event.key == 'esc')
		{
			thisClass.caja_sugerencias.destroy();
			return null;
		}
		if (event.key == 'down' || event.key == 'up' || event.key == 'enter')
		{
			box_active=thisClass.caja_sugerencias.getChildren('div.active');
		}
		if (event.key == 'down' || event.key == 'up')
		{
			thisClass.seleccionListaPorFlechas(box_active,event.key);
		
		}else if (event.key == 'enter'){
		
		if (box_active.length>0){
			box_active[0].fireEvent('click');
			$$('#buscar_boton input')[0].fireEvent('click',null,100);
		}else{
			$$('#buscar_boton input')[0].fireEvent('click');
		}
			
		}else{ 
			event.stop();
			thisClass.llamadaBusqueda();
		}
	});			
},
seleccionListaPorFlechas:function(box_active,tipo_flecha){
	if (this.caja_sugerencias.innerHTML != "")
	{
		if (box_active.length>0)
		{
			
			if (tipo_flecha == 'down')
			{
				var siguiente=box_active.getNext();
				
				if (typeof siguiente.addClass != 'undefined')
				{
					box_active.removeClass('active');
					siguiente.addClass('active');
				}
				
			}else{
				var siguiente=box_active.getPrevious();
				if (typeof siguiente.addClass != 'undefined')
				{
					box_active.removeClass('active');
					siguiente.addClass('active');
				}
			}
			
		}else{
			this.caja_sugerencias.getChildren('div')[0].addClass('active');
		}
	}
},

llamadaBusqueda: function(){
	
	valor=this.obj.value;
	var thisClass=this;
	
   if (valor.length >= this.options.busqueda_caracteres)
   {
	   
	   vars='valor='+encodeURIComponent(valor)+'&id_web='+this.id_web +  ((this.buscador==1 &&  !$('buscador_tipo').hasClass(this.options.ghost_class) && $('buscador_tipo').getStyle('display') != 'none' ) ? '&categoria=' + encodeURIComponent($('buscador_tipo').value) : '');
	   
	   new Request({
		    url: thisClass.url_busqueda,
		    method: 'post',
		    data:vars ,
		    onRequest: function(){
		    	
		    },
		    onSuccess: function(responseText){
		    	log(thisClass.url_busqueda +  ', vars -> '+ vars +', respuesta '+responseText);
		    	
		    	if (responseText!="")
		    		thisClass.sugerenciaJson(JSON.decode(responseText));
		    	
		    },
		    onFailure: function(){
		    	//mensajeNoREsponse();
		    }
		}).send(vars);
   }
	
},
getValorInput:function(){
	if ((this.obj && this.obj.value == this.ghost_text) || ( this.obj && this.obj.getStyle('display')=='none'))
	{
		return '';
	}else{
		return this.obj.value;
	}
}
   
});
