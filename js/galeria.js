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
		 this.obj_aparecer(this.obj.getElements('span')[0]);
	 },
	 dar_evento_slide:function(){
		 var thisClass=this;
		this.obj.getElements('span').each(function(item)
		{
			 item.set('slide', {mode:'horizontal',duration: thisClass.options.duracionEfecto, transition: thisClass.options.efecto });
			 item.get('slide').hide();
		});
	 },
	 obj_aparecer:function(obj){
		 obj.setStyle('display','block');
		 obj.get('slide').slideIn();
		 obj.set('activo','si');
		 
	 },
	 obj_desaparecer:function(obj){
		 obj.erase('activo');
		 obj.get('slide').slideOut();
		 var thisClass=this;
		 (function(){obj.setStyle('display','none');}).delay(thisClass.options.duracionEfecto+1);
		 
	 },
	 on_time_call:function(){
		 var siguiente=0;
		 var i=0;
		 var thisClass=this;
		 
		 var result=this.obj.getElements('span').some(function(item)
		{
			
			 ++i;
			if (siguiente==1)
			{
				siguiente=0;
				(function(){thisClass.obj_aparecer(item);}).delay((thisClass.options.duracionEfecto*2));
				
				return true;
			}
			if (item.get('activo'))
			{
				
				thisClass.obj_desaparecer(item);
				siguiente=1;
			}
			
		});
		
		if (result!=true)
		{
			(function(){thisClass.iniciar_galeria();}).delay((thisClass.options.duracionEfecto*2));
			
		}
	 }
});
/*
	galeriaMGDActual++;
	if (!$('imagenMGD'+galeriaMGDActual+'x'))
		galeriaMGDActual=0;
	
	
	nuevoNombreObjeto='imagenMGD'+galeriaMGDActual+'x';
	nuevoObjGaleria=$(nuevoNombreObjeto);

	objGaleria.fade('out');
var slider = new Fx.Slide(nombreObjeto,
{
	mode:'horizontal',
	duration: 800,
	wait: false
	
});
slider.slideOut();

var nuevoSlider = new Fx.Slide(nuevoNombreObjeto,
		{
			mode:'horizontal',
			duration: 800,
			wait: false
			
		});
nuevoSlider.hide();
nuevoObjGaleria.fade('out');

(function(){
	objGaleria.style.display='none';
	nuevoObjGaleria.style.display='';
	nuevoObjGaleria.fade('in');
	nuevoSlider.slideIn();
}).delay(590);

}
function calcMaxMGD(){
	i=0;
	while($('imagenMGD'+i+'x') )
	{
		i++;
	}
	maxMGDGaleria= i;
	
}
function pintarNumerosGaleriaMGD(){
	calcMaxMGD();
	pintarSaltosGaleriaMGD();
}
function pintarSaltosGaleriaMGD()
{

	if ($('imagenMGD0x')){
		var padre= $('imagenMGD0x').getParent('div');
		
		injeccion="<table id='marcadorGaleriaMGD'><tr>";
		for (i=0;i<=maxMGDGaleria-1;i++)
		{
			injeccion+="<td>"+(i+1)+"</td>";
		}
		injeccion+="</tr></table>";
		padre.innerHTML=injeccion+padre.innerHTML;
	}
}*/