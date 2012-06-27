<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xmlns:fb="http://www.facebook.com/2008/fbml">
<head> 
<?php $this->load->view('subtemplates/metas_comunes_view'); ?>
<base href="http://<?= $_SERVER['SERVER_NAME'] ?>">


<?php if (isset($_SESSION['app']))

/*<script src="file:///android_asset/www/js_devices" type="text/javascript"></script>
<link href="file:///android_asset/www/css_devices" media="screen" rel="stylesheet"  type="text/css" />
*/
{
?>
<script type="text/javascript">
function cargaJS(path){
        var request = new XMLHttpRequest();
        request.open("GET", path, true);
        request.onreadystatechange = function(){//Call a function when the state changes.
            console.log("state = " + request.readyState);
            if (request.readyState == 4) {
                if (request.status == 200 || request.status == 0) {
                    console.log("*" + request.responseText + "*");
                    Config = eval(request.responseText);
                }
            }
        }
        request.send();
}
    
function cargaCSS(path){
    var request = new XMLHttpRequest();
    request.open("GET", path, true);
    request.onreadystatechange = function(){//Call a function when the state changes.
        console.log("state = " + request.readyState);
        if (request.readyState == 4) {
            if (request.status == 200 || request.status == 0) {
            	document.write('<style>'+request.responseText+'</style>');
            }
        }
    }
    request.send();
}
cargaJS('file:///android_asset/www/js_devices');
cargaCSS('file:///android_asset/www/css_devices');
</script>
<?php 	
}else{
	?>
<script src="/extras/cargar_archivos/js_devices" type="text/javascript"></script>
<link href="/extras/cargar_archivos/css_devices" media="screen" rel="stylesheet"  type="text/css" />
<?php
}
 $this->load->view('peques/msg_info_controller_view'); ?>