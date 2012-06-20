var galeriaMGD=new Class({
	 options: {
		 busqueda_caracteres:2,
		 ghost_class:'ghost_input',
		 tiempo: 8000,
		 efecto: Fx.Transitions.Back.easeOut,
		 duracionEfecto : 800
	 },
	 initialize:function(id_obj){
		if ($(id_obj))
		{

			this.id_obj=id_obj;
			this.obj=$(id_obj);
			
			this.dar_evento_slide();			
			this.iniciar_galeria();
			this.on_time_call.periodical(this.options.tiempo,this);
		}
	 },
	 iniciar_galeria:function(){
		 log("---iniciar_galeria---");
		 this.obj_aparecer(this.obj.getElements('span')[0]);
		 log("---finiciar_galeria---");
	 },
	 dar_evento_slide:function(){
		 log("ini_dar_evento_slide");
		 var thisClass=this;
		this.obj.getElements('span').each(function(item)
		{
			 item.set('slide', {mode:'horizontal',duration: thisClass.options.duracionEfecto, transition: thisClass.options.efecto });
			 item.get('slide').hide();
		});
		log("fini_dar_evento_slide");
	 },
	 obj_aparecer:function(obj){
		 log("ini_obj_aparecer");
		 obj.setStyle('display','block');
		 
		 obj.slide('in');
		 obj.set('activo','si');
		 log("fini_obj_aparecer");
	 },
	 obj_desaparecer:function(obj){
		 log("ini_obj_desaparecer");
		 obj.erase('activo');
		 var thisClass=this;
		 
		 // da error en IE7 incomprensible
		 if (isIE())
			 obj.setStyle('display','none');
		 else
		{
			 obj.slide('out');	 
			 (function(){obj.setStyle('display','none');}).delay(thisClass.options.duracionEfecto+1);
		}
	 },
	 on_time_call:function(){
		 log("on_time_call");
		 var siguiente=0;
		 var i=0;
		 var thisClass=this;
		 
		 var result=this.obj.getElements('span').some(function(item)
		{
		
			 ++i;
			if (siguiente==1)
			{
		
				siguiente=0;
				log("---entra en obj_aparecer-");
				if (isIE())
					thisClass.obj_aparecer(item);
				else
				{
					(function(){thisClass.obj_aparecer(item);}).delay((thisClass.options.duracionEfecto*2));
				}
				
				log("---fin en obj_aparecer-");
				
				return true;
			}
			if (item.get('activo'))
			{
				log("---entra en obj_desaparaece-");
				thisClass.obj_desaparecer(item);
				log("---fin en obj_desaparaece-");
				siguiente=1;
			}
			
		});
		
		if (result!=true)
		{
			(function(){thisClass.iniciar_galeria();}).delay((thisClass.options.duracionEfecto*2));
			
		}
		
	 }
});