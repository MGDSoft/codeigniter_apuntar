<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {

	private $i=0;
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		
		//$this->load->controller('');
		$this->loadMetasJs();
		$this->cargarTests();
		$this->loadCuerpo();
		
	}
	
	private function cargarTests()
	{
		$extra="2";
		$prefix="prueba";

		/* Registro */
				
		$vars='correo='.$extra.$prefix.'asx313xxxd@as.com&contrasena=asd&recontrasena=asd&nombre=asd&apellidos=asd&titulo='.$extra.$prefix.'axxaxsd&uso_horario=asd';
		$this->pruebaJs('/forms/registro_form',$vars,'OK','Registro');

	}
	
	private function loadMetasJs()
	{

		echo "
		<html xmlns='http://www.w3.org/1999/xhtml' lang='es' xmlns:fb='http://www.facebook.com/2008/fbml'>
		<head>
		<base href='". base_url(). "'>
		<style>
		.fail{
		color:red
		}
		.ok{
		color:green
		}
		</style>
		<script src='". PATH_JS ."mootools-core-1.4.2.js' type='text/javascript'></script>
		<script src='". PATH_JS ."mootools-more.js' type='text/javascript'></script> 
		
		<script>
		function trim (myString)
			{
			return myString.replace(/^\s+/g,'').replace(/\s+$/g,'');
			}
			window.addEvent('domready', function() {
		";
	}
	
	private function loadCuerpo()
	{
		echo "
			});
			</script>
			</head>
			<body>Tests
			<br><br>
			<div id='resultadoDeTests'></div>
			</body>
		</html>";
	}
	
	private function pruebaJs($url,$vars,$expected,$titulo,$mostrar_response=false)
	{
		echo "new Request({
		    url: '$url',
		    method: 'post',
		    data:'$vars' ,
		    onRequest: function(){
		    	
		    },
		    onSuccess: function(responseText){
		    	
			    var resultTest=new Element('div', {
		   		'html' : 'Test: ".++$this->i." - $titulo',  
	   			});
	   			"
	   			.(($mostrar_response)? 'alert(responseText);' : '' ).
	   			"
	   			
		    	if (trim(responseText) != trim('$expected'))
		    	{
		    		resultTest.addClass('fail');
		    		resultTest.innerHTML+=', respuesta -> '+responseText;
		    	}else{
		    		resultTest.addClass('ok');
		    	}
		    	resultTest.inject($('resultadoDeTests'),'bottom');
		    	
		    },
		    onFailure: function(){
		    	alert('error para la  $url $titulo');
		    }
		}).send('$vars');";
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */