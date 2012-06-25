<!-- Post carga de archivos innecesarios de primeras y que relentizan la pagina -->
<script src="<?= PATH_JS ?>ckeditor/ckeditor.js" type="text/javascript"></script>

<?php if (!isset($_SESSION['usuario'])) 
{	?>
	<script type="text/javascript" lang="javascript"
       src="http://cdn.gigya.com/JS/socialize.js?apikey=3_zLHKYdXK27puqfBmVM9qVZDPhT1wX3KOP9kMJ3fkAzedTsYAAAi1T8fA2vIfwEJI">
	</script>
	<script type="text/javascript">
	gigya.socialize.showLoginUI({containerID: <?= ((RUTA_PORTAL == 'portal_devices') ? '"login_social_devices", width:210, height:50' : '"login_social", width:120, height:20')?>, cid:'',
		redirectURL: getHostname()+"/forms/registro_forms/social",
		showTermsLink:false, hideGigyaLink:true // remove 'Terms' and 'Gigya' links
		,enabledProviders: 'facebook,twitter,google,messenger,openid,digg,wordpress'
		});	
	</script>
<?php } ?> 