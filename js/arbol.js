

var menuCarpetas=new Class({
	
	
		cajaOpciones:'',
		cajaCerrada: 'flecha_abajo',
		cajaAbierta: 'flecha_derecha',
		menuCerrado: 'si',
		menuAbierto: 'no',
		busquedaParametros: '',
		busquedaEfecto:'busquedaSeleccionada',
		idUsuario:'',
		id:'',
		opciones_txt:'',
		carpeta_hija_txt:'',
		modificar_nombre_txt:'',
		borrar_txt:'',
		admin:1,
		slideAbiertos:''
	,
	
	initialize:function(id,idUsuario,opciones_txt,carpeta_hija_txt,modificar_nombre_txt,borrar_txt){
		this.id=id;
		this.idUsuario=idUsuario;
		this.opciones_txt=opciones_txt;
		this.carpeta_hija_txt=carpeta_hija_txt;
		this.modificar_nombre_txt=modificar_nombre_txt;
		this.borrar_txt=borrar_txt;
		
		
		this.darTodosEventos(id);
   },
   destruir:function(){
	   var thisClass=this;
	   thisClass.slideAbiertos='';
	   
	   $$("#" + id + ' span.mov').each(function(item, index)
		{
		   if (item.hasClass(thisClass.cajaAbierta))
			{
			   
			   objPadre=item.getParent();
			   if (thisClass.slideAbiertos=="")
				   thisClass.slideAbiertos+=objPadre.get('id');
			   else
				   thisClass.slideAbiertos+=';'+objPadre.get('id');
			}
		   
		});
	   
	   $(this.id).destroy();

   },
   darTodosEventos:function(){
	   id=this.id;
	   var thisClass=this;
	   
	   $$("#" + id + ' li span.mov').each(function(item, index)
		{
			thisClass.darEventosLiSpanMov(item);
		});
		$$("#" + id + ' li span.opt').each(function(item, index)
		{
			thisClass.darEventosLiSpanOpt(item);
		});
		
		$$("#" + id + ' li span.cont').each(function(item, index)
		{
			thisClass.darEventosLiSpanCont(item);
		});
		
		$$("#" + id + ' ul').each(function(item, index)
		{
			thisClass.darEventosUl(item);
		});
		
		$$("#" + id + ' span.refresh').each(function(item, index)
		{
			thisClass.darEventosRefresh(item);
		});
		
		thisClass.reAbrir();
   },
   reAbrir:function(){
	   var thisClass=this;
	   if (this.slideAbiertos != '')
		{
		   var arrAbiertos = this.slideAbiertos.split(";");
		   arrAbiertos.each(function(item, index)
			{
			
				//$(item).getNext('#'+item+' ul').get('slide').toggle(); 
				$(item).getChildren('span.mov').fireEvent('click',{stop:$empty});
			});
		}
	   
		
   },
   darEventosRefresh:function(obj){
	   var thisClass=this;
		
		obj.addEvent('click', function(){
			thisClass.refrescarArbol();
		});
   },
   refrescarArbol:function(){
	   idObj=$(this.id);
	   idPadre=idObj.getParent();
	   
	   var thisClass=this;
	   vars='idUsuario='+this.idUsuario;
	   new Request({
		    url: '/forms/categorias_forms/re_cargar',
		    method: 'post',
		    data: vars,
		    onRequest: function(){
		    	//waiter_run();
		    },
		    onSuccess: function(responseText){
		    	
		    	thisClass.destruir();
		    	idPadre.innerHTML=responseText;
		    	thisClass.darTodosEventos()
		    	//waiter_disable();
		    },
		    onFailure: function(){
		    	//waiter_disable();
		    	mensajeNoREsponse();
		    	
		    }
		}).send();
   },
   darEventosUl:function(obj){
		
   },	
   darEventosLiSpanMov:function(obj){
		var thisClass=this;

		thisClass.expandirContraer(obj)

   },
   darEventosLiSpanCont:function(obj){
		var thisClass=this;
		
		obj.addEvent('click', function(){
			thisClass.busquedaIncluir(obj);
			//thisClass.busquedaContEfecto(obj);
		});
		
   },
   busquedaIncluir:function(obj){
		var thisClass=this;
		
		obj_buscadorCategorias.agregarBusqueda(obj.get('html'));
		
   },
   busquedaContEfecto:function(obj){
		var thisClass=this;
		
		if (obj.hasClass(thisClass.busquedaEfecto) )
		{
			obj.removeClass(thisClass.busquedaEfecto);
			
		}else{
		
			obj.addClass( thisClass.busquedaEfecto);
			
		}

   },
   darEventosLiSpanOpt:function(obj){
		var thisClass=this;
		
		obj.addEvent('click', function(){
			thisClass.mostrarMenu(obj);

		});	
   },
    quitarMenu:function(obj){
	
		//alert(this.cajaOpciones);
		//obj.innerHTML= this.cajaCerrada;
		//alert("fuera");
		//obj.inject('<div >');
		
   },
    mostrarMenu:function(obj){
		var thisClass=this;
	
		liPadre=obj.getParent('li');
		
		
		if (obj.get('cerrado') == thisClass.menuCerrado && $$('ul#'+this.id+' div.cajaOpciones').length == 0)
		{
		
	//<div class="cajaOpciones"><div class="tituloOpciones">Opciones <span class="cerrar">X</span></div><ul><li>Añadir carpeta hija</li><li>Modificar Nombre</li><li>Borrar</li></ul></div>
		var cajaOpciones=new Element('div', {
		'class': 'cajaOpciones',
		});
		
		
		var cajaOpcionesTitulo=new Element('div', {
		'class': 'tituloOpciones',
		html : thisClass.opciones_txt
		});
		
		new Element('span', {
		'class': 'cerrar',
		html : 'X',
		events: {
				click: function(event){
					event.stop();
					cajaOpciones.fade('out');
					(function(){ cajaOpciones.destroy(); }).delay(500);
					
					obj.set('cerrado' , thisClass.menuCerrado);
				}
			}
		}).inject(cajaOpcionesTitulo);
		cajaOpcionesTitulo.inject(cajaOpciones);
		
		var ulAcciones=new Element('ul');
		
		new Element('li', {
			html : thisClass.carpeta_hija_txt,
			events: {
				click: function(event){
					event.stop();
					preguntar_input(js_categoria_incluir_titulo,""," preguntar_input_value=$('js_commentText').value ;obj_menu_carpetas.agregar_categoria('"+liPadre.get('categoria')+"');");
				}
			}
		}).inject(ulAcciones);
		
		if (liPadre.get('categoria')!='0')
		{
			
			new Element('li', {
				html : thisClass.modificar_nombre_txt,
				events: {
					click: function(event){
						event.stop();
						
						preguntar_input(js_categoria_modificar_titulo,(liPadre.getChildren('span.cont')).get('html'),"obj_menu_carpetas.modificar_categoria('"+liPadre.get('categoria')+"');"); 
					}
				}
			}).inject(ulAcciones);
			
			new Element('li', {
				html : thisClass.borrar_txt,
				events: {
					click: function(event){
						event.stop();
						preguntar_si_no(js_categoria_borrar_titulo,js_categoria_borrar,"obj_menu_carpetas.borrar_categoria('"+liPadre.get('categoria')+"');") 
					}
				}
			}).inject(ulAcciones);
			
		}
		
		ulAcciones.inject(cajaOpciones);
		
		
		cajaOpciones.inject(obj);
		obj.set('cerrado' , thisClass.menuAbierto) ;
		}
		//obj.inject('<div >');		
   },
   abrirObj:function(padre,obj){
	   var thisClass=this;
	   
	   if (padre.get('slide'))
	   {
		   padre.set('slide', {duration: 'long',resetHeight: true, transition: 'bounce:out'
				,onStart: function(){
			        if (obj.hasClass(thisClass.cajaCerrada))
			        {
			        	obj.addClass(thisClass.cajaAbierta);
			        	obj.removeClass(thisClass.cajaCerrada);
			        }
			        else
			        {
			        	obj.addClass(thisClass.cajaCerrada);
			        	obj.removeClass(thisClass.cajaAbierta);
			        }
			    }	
			});	
	   }
   },
   expandirContraer:function(obj){
	   var thisClass=this;
	    var arrUl=obj.getParent('li').getNext();
	    
		if (arrUl)
		{
			if (arrUl.get('tag')=='ul')
			{
				if (arrUl.get('slide'))
				{
					arrUl.set('slide', {duration: 'long',resetHeight: true, transition: 'bounce:out'
						,onStart: function(){
					        if (obj.hasClass(thisClass.cajaCerrada))
					        {
					        	obj.addClass(thisClass.cajaAbierta);
					        	obj.removeClass(thisClass.cajaCerrada);
					        }
					        else
					        {
					        	obj.addClass(thisClass.cajaCerrada);
					        	obj.removeClass(thisClass.cajaAbierta);
					        }
					    }	
					});	
				}
				obj.addEvent('click', function(event){
					
					event.stop();
					arrUl.get('slide').toggle(); 
				});		
				
				obj.addClass(thisClass.cajaCerrada);
			}			
		}
		
		var arrParentUl=obj.getParent('ul');
		
		
		if (arrParentUl.get('id') != thisClass.id)
		{
			arrParentUl.get('slide').hide();
		}
		
   },
   
    agregar_categoria: function(padre){
			request_simple_post('/forms/categorias_forms/nueva_categoria','nombre_categoria='+preguntar_input_value+'&id_padre='+padre,'obj_menu_carpetas.refrescarArbol();');
	},
	modificar_categoria: function(id){
		request_simple_post('/forms/categorias_forms/modificar_categoria','nombre_categoria='+preguntar_input_value+'&id='+id,'obj_menu_carpetas.refrescarArbol();');
		
	},
	borrar_categoria: function(id){
		request_simple_post('/forms/categorias_forms/borrar_categoria','id='+id,'obj_menu_carpetas.refrescarArbol();');
		
	}
	   
	});

