<script type="text/javascript">
var extra_vars = '';
var nombre_unico = 'portada';
var auto_ejecutar_js='<?= AUTO_EJECUTAR_JS ?>'; 
var msg_waiter = new Message({ 	 		
icon: "blackWaiter.gif",   		
title: "<?= $this->lang->line('js_msg_cargando') ?>",   		
message: "<?= $this->lang->line('js_msg_titlo') ?>" 
});

var preguntar_input_value='';
function preguntar_input(titulo,valor_default,objRequest) 
{
	<?= printf(MSG_QUESTION_DEFAULT,'titulo','"+valor_default+"' ,"'preguntar_input_value=$(\"js_commentText\").value ;'+ objRequest"); ?>
	
}

function preguntar_si_no(titulo,descripcion,objRequest) 
{
	<?= printf(MSG_QUESTION_SI_NO_DEFAULT,'titulo','descripcion',"objRequest"); ?>	
}
var waiter_run = function(){if (msg_waiter.isDisplayed) msg_waiter.dismiss();  msg_waiter.waiter();};
var waiter_disable = function(){msg_waiter.dismiss() };
var spy;
window.addEvent('domready', function() {
	if (!isIE())
	{
		spy = new ScrollSpy({ 
		    min: 1000, 
		    onEnter: function() { 
		        $('gotodown').fade('out');
		    }, 
		    onLeave: function() { 
		    	$('gotodown').fade('in'); 
		    } 
		});

		/* my "Go To Top" link element */ 
		var link = document.id('gototop'); 
		/* scrollspy instance */ 
		var ss = new ScrollSpy({ 
		    min: 300, 
		    onEnter: function() { 
		        link.fade('in'); //show the "Go To Top" link 
		    }, 
		    onLeave: function() { 
		        link.fade('out'); //hide the "Go To Top" link 
		    } 
		});
	}
	
	
	var gal=new galeriaMGD('galeria');

	var HM = new HashListener();
	var anteriorHas;
	HM.addEvent('hashChanged',function(new_hash){ 
		
		if (new_hash != anteriorHas)
		{
			anteriorHas=new_hash;
			cargarPaginaInit();
		}
	}); 
});
</script>