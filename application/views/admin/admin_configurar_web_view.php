<?php 
$botonesID='#contenedor_titulo_buscador #buscar_boton input, .formulario_estandar .boton_standart, .boton_standart, #contenedor_titulo_buscador input[type="submit"]';
$arrecorrer[0]['nombre']=$this->lang->line('imagen_fija');$arrecorrer[0]['valor']='fijo';
$arrecorrer[1]['nombre']=$this->lang->line('imagen_mosaico');$arrecorrer[1]['valor']='mosaico';
$arrecorrer[2]['nombre']=$this->lang->line('imagen_centrada');$arrecorrer[2]['valor']='centrado';
$arrecorrer[3]['nombre']=$this->lang->line('imagen_estirada');$arrecorrer[3]['valor']='expandido';
$arrecorrer[4]['nombre']=$this->lang->line('imagen_izquierda');$arrecorrer[4]['valor']='fondo_izquierda';
$arrecorrer[5]['nombre']=$this->lang->line('imagen_derecha');$arrecorrer[5]['valor']='fondo_derecha';
$arrecorrer[6]['nombre']=$this->lang->line('imagen_repite_x');$arrecorrer[6]['valor']='imagen_repite_x';
$arrecorrer[7]['nombre']=$this->lang->line('imagen_repite_y');$arrecorrer[7]['valor']='imagen_repite_y';

$bordeTipo[0]['nombre']=$this->lang->line('border_dashed');$bordeTipo[0]['valor']='dashed';
$bordeTipo[1]['nombre']=$this->lang->line('border_dotted');$bordeTipo[1]['valor']='dotted';
$bordeTipo[2]['nombre']=$this->lang->line('border_solid');$bordeTipo[2]['valor']='solid';


$fontFamily[0]['nombre']='Arial';$fontFamily[0]['valor']="Arial,'DejaVu Sans','Liberation Sans',Freesans,sans-serif";
$fontFamily[1]['nombre']='Arial Black';$fontFamily[1]['valor']="'Arial Black',Gadget,sans-serif";
$fontFamily[2]['nombre']='Bookman Old Style';$fontFamily[2]['valor']="'Bookman Old Style',Bookman,'URW Bookman L','Palatino Linotype',serif";
$fontFamily[3]['nombre']='Comic Sans MS';$fontFamily[3]['valor']="'Comic Sans MS',cursive";
$fontFamily[4]['nombre']='Courier New,Courier,Nimbus Mono L,monospace';$fontFamily[4]['valor']="'Courier New',Courier,'Nimbus Mono L',monospace";
$fontFamily[5]['nombre']='Courier New, Courier, monospace';$fontFamily[5]['valor']='Courier New, Courier, monospace';
$fontFamily[6]['nombre']='Garamond, serif';$fontFamily[6]['valor']='Garamond, serif';
$fontFamily[7]['nombre']='Constantina,Georgia';$fontFamily[7]['valor']="Constantina,Georgia,'Nimbus Roman No9 L',serif";
$fontFamily[8]['nombre']='Impact, Haettenschweiler, Arial Narrow Bold, sans-serif';$fontFamily[8]['valor']="Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif";
$fontFamily[9]['nombre']='Lucida Console, Monaco, monospace';$fontFamily[9]['valor']="Consolas,'Lucida Console','DejaVu Sans Mono',monospace";
$fontFamily[10]['nombre']='lucida grande,tahoma,verdana,arial,sans-serif';$fontFamily[10]['valor']="'lucida grande',tahoma,verdana,arial,sans-serif";
$fontFamily[11]['nombre']='Georgia, MS Sans Serif, Geneva, sans-serif';$fontFamily[11]['valor']='Georgia, MS Sans Serif, Geneva, sans-serif';
$fontFamily[12]['nombre']='MS Serif, New York, sans-serif';$fontFamily[12]['valor']="'MS Serif', 'New York', sans-serif";
$fontFamily[13]['nombre']='Palatino Linotype, Book Antiqua, Palatino, serif';$fontFamily[13]['valor']="Cambria,'Palatino Linotype','Book Antiqua','URW Palladio L',serif";
$fontFamily[14]['nombre']='Tahoma, Geneva, sans-serif';$fontFamily[14]['valor']="'Tahoma', Geneva, sans-serif";
$fontFamily[15]['nombre']='Times New Roman, Times, serif';$fontFamily[15]['valor']='Times New Roman, Times, serif';
$fontFamily[16]['nombre']='Trebuchet MS, Helvetica, sans-serif';$fontFamily[16]['valor']="'Trebuchet MS', Helvetica, sans-serif";
$fontFamily[17]['nombre']='Verdana, Geneva, sans-serif';$fontFamily[17]['valor']='Verdana, Geneva, sans-serif';
?>
<div class="contenedorTabs">
	<div id="opt_gene" class="opciontab active" onclick="activarTab('general',$('opt_gene'))"><?= $this->lang->line('general') ?></div>
	<div id="opt_sobre" class="opciontab" onclick="activarTab('sobre_mi',$('opt_sobre'))"><?= $this->lang->line('sobre_mi') ?></div>
	<div id="opt_pre" class="opciontab" onclick="activarTab('diseno_pre',$('opt_pre'))"><?= $this->lang->line('diseno_pre') ?></div>
	<div id="opt_dise" class="opciontab" onclick="activarTab('diseno_propio',$('opt_dise'))"><?= $this->lang->line('diseno_propio') ?></div>
	<div id="opt_separa" class="opciontab" onclick="activarTab('diseno_separadores',$('opt_separa'))"><?= $this->lang->line('titulo_separadores') ?></div>
	<div class="contidoTabs">
		<span class="inidica"><?= $this->lang->line('hasta_no_guardado') ?> </span>
		
		<div id="general" class="tabcontenido">
			<form id='general_form' class='formulario_estandar' name="general_form"  action="javascript:enviar_form_ajax('general_form','/forms/configuracion_web_forms/general_update','','','')" method="post" accept-charset="utf-8">
				<table class='formulario_estandar' >
						<tr><th class="separador"><?= $this->lang->line('titulo_configuracion') ?></th></tr>
						<tr><th><?= $this->lang->line('nombre_unico') ?></th><td><input MAXLENGTH='70' type="text" name="nombre_unico" onkeyup="$$('#titulo_desc a')[0].innerHTML=this.value" id="nombre_unico" value='<?= $usuario_configuracion->titulo ?>' ></td></tr>
						<tr><th><?= $this->lang->line('eslogan') ?></th><td><input MAXLENGTH='70' type="text" name="eslogan" onkeyup="$('descripcion').innerHTML=this.value" id="eslogan" value='<?= $usuario_configuracion->eslogan ?>' ></td></tr>
						<tr><th><?= $this->lang->line('comentable_anonimos') ?></th><td><input type="checkbox" name="comentable_anonimos" id="comentable_anonimos" <?= (($usuario_configuracion->comentable_anonimos==1 )? 'checked="checked"' : '' ) ?> value="1"></td></tr>
						<tr><th><?= $this->lang->line('publica') ?></th><td><input type="checkbox" name="visible" id="visible" value="1" <?= (($usuario_configuracion->visible==1 )? 'checked="checked"' : '' ) ?>></td></tr>
						<tr><th><?= $this->lang->line('aviso_comentario_correo') ?></th><td><input type="checkbox" name="aviso_comentario" id="aviso_comentario" value="1" <?= (($usuario_configuracion->aviso_comentario==1 )? 'checked="checked"' : '' ) ?>></td></tr>
						
						<tr><th class="separador"><?= $this->lang->line('titulo_logo') ?></th></tr>
						<tr><th><?= $this->lang->line('logo') ?></th><td>
						
						<div id="logo-uploader">       
							    <noscript>          
							        <p>Please enable JavaScript to use file uploader.</p>
							        <!-- or put a simple form for upload here -->
							    </noscript>         
						</div>
						
						<input type="hidden" name="logo_imagen" id="logo_imagen" value=""></td></tr>
						
						
						<tr><th class="separador"><?= $this->lang->line('contacto') ?></th></tr>
						
						<tr><th><?= $this->lang->line('contacto_pagina_personal') ?></th><td><input type="input" name="contacto_pagina_personal" id="contacto_pagina_personal" value="<?= (empty($usuario_configuracion->contacto_pagina_personal ) ? 'http://' : $usuario_configuracion->contacto_pagina_personal) ?>"></td></tr>
						<tr><th>Email</th><td><input type="input" name="contacto_email" id="contacto_email" value="<?= (empty($usuario_configuracion->contacto_email) ? '' : $usuario_configuracion->contacto_email ) ?>"></td></tr>
						<tr><th>Google+</th><td><input type="input" name="contacto_google" id="contacto_google" value="<?= (empty($usuario_configuracion->contacto_google) ? 'http://' : $usuario_configuracion->contacto_google) ?>"></td></tr>
						<tr><th>Facebook</th><td><input type="input" name="contacto_facebook" id="contacto_facebook" value="<?= (empty($usuario_configuracion->contacto_facebook) ? 'http://' : $usuario_configuracion->contacto_facebook) ?>"></td></tr>
						<tr><th>Steam</th><td><input type="input" name="contacto_steam" id="contacto_steam" value="<?= (empty($usuario_configuracion->contacto_steam) ? 'http://' : $usuario_configuracion->contacto_steam) ?>"></td></tr>
						<tr><th>You tube</th><td><input type="input" name="contacto_youtube" id="contacto_youtube" value="<?= (empty($usuario_configuracion->contacto_youtube) ? 'http://' : $usuario_configuracion->contacto_youtube) ?>"></td></tr>
						<tr><th>Twitter</th><td><input type="input" name="contacto_twitter" id="contacto_twitter" value="<?= (empty($usuario_configuracion->contacto_twitter) ? 'http://' : $usuario_configuracion->contacto_twitter) ?>"></td></tr>
						<tr><th>Tuenti</th><td><input type="input" name="contacto_tuenti" id="contacto_tuenti" value="<?= (empty($usuario_configuracion->contacto_tuenti) ? 'http://' : $usuario_configuracion->contacto_tuenti) ?>"></td></tr>
						
						<tr><td></td><td align="right"><input type="submit" class='boton_standart' value="<?= $this->lang->line('enviar') ?>"></td></tr>
									
					</table>
					<input name="iehack" type="hidden" value="&#9760;" />
			</form>
		</div>
		
		<div id="diseno_pre" class="tabcontenido" style="display: none">
			<form id='opt_pre_form' class='formulario_estandar' name="opt_pre_form"  action="javascript:enviar_form_ajax('opt_pre_form','/forms/configuracion_web_forms/diseno_propio_update','','','')" method="post" accept-charset="utf-8">
				<table class='formulario_estandar' >
					<tr><th class="separador" colspan="2"><?= $this->lang->line('titulo_diseno_pre') ?></th></tr>
					<tr>
						<td><img src="<?= PATH_IMG ?>disenos/azul.jpg" width="100" height="100" onclick="request_simple_post('/forms/configuracion_web_forms/cargar_diseno_azul', '', '');"></td>
						<td><img src="<?= PATH_IMG ?>disenos/gris.jpg" width="100" height="100" onclick="request_simple_post('/forms/configuracion_web_forms/cargar_diseno_gris', '', '');"></td>
					</tr>
					<tr>
						<td>Azul</td>
						<td>Gris</td>
					</tr>
					<tr><td></td><td align="right"><input type="submit" class='boton_standart' value="<?= $this->lang->line('enviar') ?>" onclick="enviar_form_ajax('diseno_propio_form','/forms/configuracion_web_forms/diseno_propio_update','','','');enviar_form_ajax('opt_pre_form','/forms/configuracion_web_forms/diseno_propio_update','','','');enviarFormsSeparadores();"></td></tr>
						
				</table>
			</form>
		</div>
		<div id="diseno_propio" class="tabcontenido" style="display: none">
			<form id='diseno_propio_form' class='formulario_estandar' name="diseno_propio_form"  action="javascript:enviar_form_ajax('diseno_propio_form','/forms/configuracion_web_forms/diseno_propio_update','','','')" method="post" accept-charset="utf-8">
				<table class='formulario_estandar' >
						<tr><th class="separador"><?= $this->lang->line('titulo_fondo') ?></th></tr>
						<tr><th><?= $this->lang->line('fondo_color_pagina') ?></th><td><input MAXLENGTH='7' type="text" readonly="readonly" name="fondo_color" id="fondo_color" value="" ></td><td></td></tr>
						<tr><th><?= $this->lang->line('fondo_imagen') ?></th><td><input type="hidden" name="fondo_imagen" id="fondo_imagen" value="<?= $usuario_configuracion->fondo_imagen ?>">
							<img src="<?= PATH_IMG ?>borrar.png" style="position:absolute;z-index:5;margin:16px 0px 0px 120px" onclick="$('fondo_imagen').value=''; modificarAtributoCSS_fondoImagen('body','none');">
							<div id="fondo_imagen_upload">
							    <noscript>          
							        <p>Please enable JavaScript to use file uploader.</p>
							        <!-- or put a simple form for upload here -->
							    </noscript>         
							</div>
							
								</td></tr>
						<tr><th><?= $this->lang->line('fondo_imagen_estilo') ?></th><td><select name="fondo_estilo" id="fondo_estilo" onchange="carga_diseno_on_fly()">
									<?php
			
										foreach ($arrecorrer as $actu)
										{
											echo '<option '.(($usuario_configuracion->fondo_estilo == $actu['valor']) ? ' selected="selected"' : '' ).' value="'.$actu['valor'].'">'.$actu['nombre'].'</option>';
										}
									?>
								</select></td></tr>
								
						<tr><th class="separador"><?= $this->lang->line('titulo_texto') ?></th></tr>
						<tr><th><?= $this->lang->line('letras_tamano') ?></th><td><select name="texto_tamano" id="texto_tamano" onchange="carga_diseno_on_fly()">
									<?php 
										for ($i=8;$i<18;$i++)
										{
											echo '<option '.(($usuario_configuracion->texto_tamano == $i.'px') ? ' selected="selected"' : '' ).' value="'.$i.'px">'.$i.'px</option>';
										}
									?>
								</select></td><td></td></tr>

						<tr><th><?= $this->lang->line('color_letras') ?></th><td><input MAXLENGTH='7' type="text" name="texto_color" readonly="readonly"  id="texto_color" value="" ></td><td></td></tr>
						<tr><th><?= $this->lang->line('tipo_letra') ?></th><td>
							<select name="texto_estilo" id="texto_estilo" onchange="carga_diseno_on_fly()">
									<?php 	
										foreach ($fontFamily as $actual)
										{
											echo '<option '.(($usuario_configuracion->texto_estilo == $actual['valor']) ? ' selected="selected"' : '' ).' value="'.$actual['valor'].'">'.$actual['nombre'].'</option>';
										}
									?>
							</select>
						</td><td></td></tr>
						
						<tr><th class="separador"><?= $this->lang->line('titulo_formulario') ?></th></tr>
						<tr><th><?= $this->lang->line('letras_tamano') ?></th><td><select name="formulario_tamano" id="formulario_tamano" onchange="carga_diseno_on_fly()">
									<?php 
										for ($i=8;$i<18;$i++)
										{
											echo '<option '.(($usuario_configuracion->formulario_tamano == $i.'px') ? ' selected="selected"' : '' ).' value="'.$i.'px">'.$i.'px</option>';
										}
									?>
								</select></td><td></td></tr>
				
								
						<tr><th><?= $this->lang->line('color_letras') ?></th><td><input MAXLENGTH='7' type="text" name="formulario_color" readonly="readonly"  id="formulario_color" value="" ></td><td></td></tr>
						<tr><th><?= $this->lang->line('tipo_letra') ?></th><td>
							<select name="formulario_estilo" id="formulario_estilo" onchange="carga_diseno_on_fly()">
									<?php 	
										foreach ($fontFamily as $actual)
										{
											echo '<option '.(($usuario_configuracion->formulario_estilo == $actual['valor']) ? ' selected="selected"' : '' ).' value="'.$actual['valor'].'">'.$actual['nombre'].'</option>';
										}
									?>
							</select>
						</td><td></td></tr>
				
				
					<tr><th class="separador"><?= $this->lang->line('titulo_botones') ?></th></tr>
						<tr><th><?= $this->lang->line('separador_fondo') ?></th><td><input MAXLENGTH='7' type="text" name="botones_fondo" readonly="readonly"  id="botones_fondo" value="" ></td>
						<tr><th><?= $this->lang->line('color_letras') ?></th><td><input MAXLENGTH='7' type="text" name="botones_color" readonly="readonly"  id="botones_color" value="" ></td><td></td></tr>
						<tr><th><?= $this->lang->line('color_sombra') ?></th><td><input MAXLENGTH='7' type="text" name="botones_sombra_letra" readonly="readonly"  id="botones_sombra_letra" value="" ></td><td></td></tr>
						<tr><th><?= $this->lang->line('bordes_color') ?></th><td><input MAXLENGTH='7' type="text" name="botones_borde_color" readonly="readonly"  id="botones_borde_color" value="" ></td><td></td></tr>
						<tr><th><?= $this->lang->line('caja_sombra') ?></th><td><input MAXLENGTH='7' type="text" name="botones_caja_sombra" readonly="readonly"  id="botones_caja_sombra" value="" ></td><td></td></tr>
						
						<tr><th><?= $this->lang->line('tipo_letra') ?></th><td>
							<select name="botones_tipo_letra" id="botones_tipo_letra" onchange="carga_diseno_on_fly()">
									<?php 	
										foreach ($fontFamily as $actual)
										{
											echo '<option '.(($usuario_configuracion->botones_tipo_letra == $actual['valor']) ? ' selected="selected"' : '' ).' value="'.$actual['valor'].'">'.$actual['nombre'].'</option>';
										}
									?>
							</select>
						</td><td></td></tr>
				
				
								
						<tr><th class="separador"><?= $this->lang->line('titulo_titulos') ?></th></tr>
						<tr><th><?= $this->lang->line('color_letras') ?></th><td><input MAXLENGTH='7' type="text" name="titulo_color" readonly="readonly"  id="titulo_color" value="" ></td><td></td></tr>
						<tr><th><?= $this->lang->line('color_sombra') ?></th><td><input MAXLENGTH='7' type="text" name="titulo_sombra" readonly="readonly"  id="titulo_sombra" value="" ></td><td></td></tr>
						
						<tr><th><?= $this->lang->line('titulo_principal_tamano') ?></th><td><select name="titulo_principal_tamano" id="titulo_principal_tamano" onchange="carga_diseno_on_fly()">
									<?php 
										for ($i=12;$i<42;$i++)
										{
											echo '<option '.(($usuario_configuracion->titulo_principal_tamano == $i.'px') ? ' selected="selected"' : '' ).' value="'.$i.'px">'.$i.'px</option>';
										}
									?>
								</select></td><td></td></tr>
						<tr><th><?= $this->lang->line('tipo_letra') ?></th><td>
							<select name="titulo_estilo" id="titulo_estilo" onchange="carga_diseno_on_fly()">
									<?php 	
										foreach ($fontFamily as $actual)
										{
											echo '<option '.(($usuario_configuracion->titulo_estilo == $actual['valor']) ? ' selected="selected"' : '' ).' value="'.$actual['valor'].'">'.$actual['nombre'].'</option>';
										}
									?>
							</select>
						</td><td></td></tr>
						
						<tr><th class="separador"><?= $this->lang->line('titulos_eslogan') ?></th></tr>
						
						<tr><th><?= $this->lang->line('color_letras') ?></th><td><input MAXLENGTH='7' type="text" name="otros_color" readonly="readonly"  id="otros_color" value="" ></td><td></td></tr>
						<tr><th><?= $this->lang->line('separacion_vertical') ?></th><td>
						<select name="eslogan_separacion_vertical" id="eslogan_separacion_vertical" onchange="carga_diseno_on_fly()">
									<?php 	
										for ($i=0;$i<21;$i++)
										{
											echo '<option '.(($usuario_configuracion->eslogan_separacion_vertical == $i.'px') ? ' selected="selected"' : '' ).' value="'.$i.'px">'.$i.'px</option>';
										}
									?>
							</select>
						</td><td></td></tr>
						
						
						<tr><th class="separador"><?= $this->lang->line('titulo_links') ?></th></tr>
						
						<tr><th><?= $this->lang->line('color_letras') ?></th><td><input MAXLENGTH='7' type="text" name="link_color" readonly="readonly"  id="link_color" value="" ></td><td></td></tr>
						<tr><th><?= $this->lang->line('link_visitado_color') ?></th><td><input MAXLENGTH='7' type="text" name="link_visitado_color" readonly="readonly"  id="link_visitado_color" value="" ></td><td></td></tr>
						<tr><th><?= $this->lang->line('link_tamano') ?></th><td>
								<select name="link_tamano" id="link_tamano" onchange="carga_diseno_on_fly()">
									<?php 
										for ($i=8;$i<18;$i++)
										{
											echo '<option '.(($usuario_configuracion->link_tamano == $i.'px') ? ' selected="selected"' : '' ).' value="'.$i.'px">'.$i.'px</option>';
										}
									?>
								</select>
						</td><td></td></tr>
						
						
						<tr><th class="separador"><?= $this->lang->line('titulo_bordes') ?></th></tr>
						
						<tr><th><?= $this->lang->line('bordes_color') ?></th><td><input MAXLENGTH='7' type="text" name="bordes_color" readonly="readonly"  id="bordes_color" value="" ></td><td></td></tr>
						
						
						<tr><td></td><td align="right"><input type="submit" class='boton_standart' value="<?= $this->lang->line('enviar') ?>"></td></tr>
						
						</table>
					<input name="iehack" type="hidden" value="&#9760;" />
			</form>
		</div>
		<div id="diseno_separadores" class="tabcontenido" style="display: none;padding-top:20px">
		<form id='nueva_noticia_form' class='formulario_estandar' name="nueva_noticia_form"  action="javascript:enviarFormsSeparadores();" method="post" accept-charset="utf-8">			
				
				
				<?= $this->lang->line('separadores_desc') ?>
				<br><br>
				<table class='formulario_estandar' >
					<tr><td colspan="3"></td></tr>
					<tr><th><?= $this->lang->line('separador_fondo') ?></th><td><input MAXLENGTH='7' type="text" name="separador_fondo" readonly="readonly"  id="separador_fondo" value="" ></td>
					<td rowspan="6"><select size="12" onclick="recuperarSeparador();" id="separadores_guardados" name="separadores_guardados" style="margin-left:20px;width:100px">
					<option value="0"  <?= ((count($web_configuracion_separadores)<1 ) ? 'selected="selected"' : '' ) ?>><?= $this->lang->line('nuevo') ?></option>
					<?php 
					$i=0;
					foreach ($web_configuracion_separadores as $separador)
					{
						echo '<option value="'.$separador->id_separador.'" '. (($i==0) ? 'selected="selected"' : '' ). ' >'.$separador->id_separador.'</option>';
						++$i;
					}
					?>
					</select></td></tr>
					
					<tr><th><?= $this->lang->line('separador_posicion') ?></th><td>
							<select name="separador_posicion" id="separador_posicion" onchange="cargarSeparadores();">
								<?php 
									for ($i=0;$i<410;$i+=5)
									{
										echo '<option '.((isset($web_configuracion_separadores[0])  && $web_configuracion_separadores[0]->posicion == $i.'px') ? ' selected="selected"' : '' ).' value="'.$i.'px">'.$i.'px</option>';
									}
								?>
							</select>
					</td></tr>
					<tr><th><?= $this->lang->line('separador_altura') ?></th><td>
							<select name="separador_altura" id="separador_altura" onchange="cargarSeparadores();">
								<?php 
									for ($i=0;$i<410;$i+=5)
									{
										echo '<option '.((isset($web_configuracion_separadores[0])  && $web_configuracion_separadores[0]->altura == $i.'px') ? ' selected="selected"' : '' ).' value="'.$i.'px">'.$i.'px</option>';
									}
								?>
							</select>
					</td></tr>
					<tr><th><?= $this->lang->line('separador_color_borde') ?></th><td><input MAXLENGTH='7' type="text" name="separador_color_borde" readonly="readonly"  id="separador_color_borde" value="" ></td>
					<tr><th><?= $this->lang->line('separador_grosor') ?></th><td>
							<select name="separador_grosor" id="separador_grosor" onchange="cargarSeparadores();">
								<?php 
									for ($i=0;$i<10;$i++)
									{
										echo '<option '.((isset($web_configuracion_separadores[0])  && $web_configuracion_separadores[0]->grosor == $i.'px') ? ' selected="selected"' : '' ).' value="'.$i.'px">'.$i.'px</option>';
									}
								?>
							</select>
					</td></tr>
					<tr><th><?= $this->lang->line('separador_estilo') ?></th><td>
						<select name="separador_estilo" id="separador_estilo" onchange="cargarSeparadores();">
								<?php 	
									foreach ($bordeTipo as $actual)
									{
										echo '<option '.((isset($web_configuracion_separadores[0])  && $web_configuracion_separadores[0]->estilo == $actual['valor']) ? ' selected="selected"' : '' ).' value="'.$actual['valor'].'">'.$actual['nombre'].'</option>';
									}
								?>
						</select>
					</td></tr>
					
					
					
					
							<tr><td></td><td align="right"><input type="button" class='boton_standart' value="<?= $this->lang->line('borrar_txt') ?>" onclick="borrarSeparador();"></td>
										 <td align="right"><input type="submit" class='boton_standart' value="<?= $this->lang->line('enviar') ?>" ></td></tr>
					</table>
				<input name="iehack" type="hidden" value="&#9760;" />
			
		</form>
		</div>
		<div id="sobre_mi" class="tabcontenido" style="display: none">
			<form id='sobre_mi_form' class='formulario_estandar' name="sobre_mi_form"  action="javascript:enviar_form_ajax('sobre_mi_form','/forms/configuracion_web_forms/sobre_mi_update','','','')" method="post" accept-charset="utf-8">
				<table class='formulario_estandar' >
				<tr><th class="separador"><?= $this->lang->line('titulo_sobreti') ?></th></tr>
					<tr><th><?= $this->lang->line('imagen_sobreti') ?></th><td>
					<img src="<?= PATH_IMG ?>borrar.png" style="position:absolute;z-index:5;margin:16px 0px 0px 120px" onclick="$('imagen_sobreti').value='borrar';">
						<div id="imagen_sobreti-uploader">       
						    <noscript>          
						        <p>Please enable JavaScript to use file uploader.</p>
						        <!-- or put a simple form for upload here -->
						    </noscript>         
						</div>
						
						<input type="hidden" name="imagen_sobreti" id="imagen_sobreti" value="">
						
					</td></tr>
					<tr><th><?= $this->lang->line('texto_sobreti') ?></th><td><textarea name="texto_sobre_ti" id="texto_sobre_ti"  ><?= $web_sobre_mi->sobre_mi  ?></textarea>
					
					</td></tr>
					<tr><td></td><td align="right"><input type="submit" class='boton_standart' value="<?= $this->lang->line('enviar') ?>"></td></tr>
								
				</table>
				<input name="iehack" type="hidden" value="&#9760;" />
			</form>
		</div>
</div>
	
</div>

<?php $this->load->view('admin/volver_view'); ?>

<div class='<?= AUTO_EJECUTAR_JS ?>' style='display:none'>
	creacionEventos('nombre_unico','','',1,2);
	if ( typeof CKEDITOR == 'undefined' )
	{
		
	}else{
		var instance = CKEDITOR.instances['texto_sobre_ti'];
	    if(instance)
	    {
	        CKEDITOR.remove(instance);
	    }
		CKEDITOR.replace( 'texto_sobre_ti',
			 {
			 toolbar: [['Source','Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink', 'UIColor'],[ 'TextColor','BGColor' ],[ 'Code']],
			 width:   '600'
			 
			});	
		
		CKEDITOR.instances['texto_sobre_ti'].on('change', function() { $('sobre_mi_val').innerHTML=CKEDITOR.instances['texto_sobre_ti'].getData();});
	}		
	modo_espera=true;
	
	var fondo_color= new MooRainbow('fondo_color', {
		imgPath: '<?= PATH_JS ?>mooRainbow/Assets/images/',
		startColor: '<?= $usuario_configuracion->fondo_color ?>',
		id: 'mooRain1',
	    onChange: function(color) { 
	        this.element.value = color.hex; 
	        carga_diseno_on_fly();
	    } 
	});
	
	
	var uploader = new qq.FileUploader({
    element: document.getElementById('logo-uploader'),
    action: '/extras/imagenes/logo',
    titulo: '<?= $this->lang->line('modificar_imagen') ?>',
    onComplete: function(id, fileName, responseJSON){
    	
  	 		if (responseJSON.success)
  	 		{
  	 			$('logo_imagen').value=responseJSON.directory;
  	 			$$('#logo img').each(function(el) {
					el.set('src' , responseJSON.directory);
				});
  	 		}		
  	 			
  	 	}
	});
	
	var uploader = new qq.FileUploader({
    element: document.getElementById('imagen_sobreti-uploader'),
    action: '/extras/imagenes/sobreti',
    titulo: '<?= $this->lang->line('modificar_imagen') ?>',
    onComplete: function(id, fileName, responseJSON){
    	console.log(responseJSON);
  	 		if (responseJSON.success)
  	 		{
  	 			$('imagen_sobreti').value=responseJSON.directory;
  	 			$('img_sobremi').set('src',responseJSON.directory+"?");
  	 			
  	 		}		
  	 			
  	 	}
	});
	
	var uploader = new qq.FileUploader({
    element: document.getElementById('fondo_imagen_upload'),
    titulo: '<?= $this->lang->line('modificar_imagen') ?>',
    action: '/extras/imagenes/fondo',
    onComplete: function(id, fileName, responseJSON){
    	
  	 		if (responseJSON.success)
  	 		{
  	 			$('fondo_imagen').value=responseJSON.directory;
  	 			modificarAtributoCSS_fondoImagen('body',responseJSON.directory);
  	 			
  	 		}		
  	 			
  	 	}
	});
	
	new MooRainbow('texto_color', {
		imgPath: '<?= PATH_JS ?>mooRainbow/Assets/images/',
		startColor: '<?= $usuario_configuracion->texto_color ?>',
		id: 'mooRain2',
	    onChange: function(color) { 
	        this.element.value = color.hex; 
	        carga_diseno_on_fly();
	    } 
	});	
	
	new MooRainbow('titulo_color', {
		imgPath: '<?= PATH_JS ?>mooRainbow/Assets/images/',
		startColor: '<?= $usuario_configuracion->titulo_color ?>',
		id: 'mooRain3',
	    onChange: function(color) { 
	        this.element.value = color.hex; 
	       carga_diseno_on_fly();
	    } 
	});	
		  
	new MooRainbow('link_visitado_color', {
		imgPath: '<?= PATH_JS ?>mooRainbow/Assets/images/',
		startColor: '<?= $usuario_configuracion->link_visitado_color ?>',
		id: 'mooRain4',
	    onChange: function(color) { 
	        this.element.value = color.hex; 
	        carga_diseno_on_fly();
	    } 
	});	
	
	new MooRainbow('link_color', {
		imgPath: '<?= PATH_JS ?>mooRainbow/Assets/images/',
		startColor: '<?= $usuario_configuracion->link_color ?>',
		id: 'mooRain5',
	    onChange: function(color) { 
	        this.element.value = color.hex; 
	        carga_diseno_on_fly();
	    } 
	});	  
	
	new MooRainbow('bordes_color', {
		imgPath: '<?= PATH_JS ?>mooRainbow/Assets/images/',
		startColor: '<?= $usuario_configuracion->bordes_color ?>',
		id: 'mooRain6',
	    onChange: function(color) { 
	        this.element.value = color.hex; 
	        carga_diseno_on_fly();
	    } 
	});	 
	
	new MooRainbow('separador_fondo', {
		imgPath: '<?= PATH_JS ?>mooRainbow/Assets/images/',
		startColor: '<?= (isset($web_configuracion_separadores[0])) ? $web_configuracion_separadores[0]->fondo : '#F5F5F5'  ?>',
		id: 'mooRain7',
	    onChange: function(color) { 
	        this.element.value = color.hex;
	        cargarSeparadores(); 
	    } 
	});	 
	
	new MooRainbow('separador_color_borde', {
		imgPath: '<?= PATH_JS ?>mooRainbow/Assets/images/',
		startColor: '<?= (isset($web_configuracion_separadores[0])) ?  $web_configuracion_separadores[0]->color_borde : '#CCCCCC' ?>',
		id: 'mooRain8',
	    onChange: function(color) { 
	        this.element.value = color.hex; 
	        cargarSeparadores();
	    } 
	});	 
	
	new MooRainbow('formulario_color', {
		imgPath: '<?= PATH_JS ?>mooRainbow/Assets/images/',
		startColor: '<?= $usuario_configuracion->formulario_color ?>',
		id: 'mooRain9',
	    onChange: function(color) { 
	        this.element.value = color.hex; 
	       	carga_diseno_on_fly();
	    } 
	});	 
	
	new MooRainbow('botones_sombra_letra', {
		imgPath: '<?= PATH_JS ?>mooRainbow/Assets/images/',
		startColor: '<?= $usuario_configuracion->botones_sombra_letra ?>',
		id: 'mooRain10',
	    onChange: function(color) { 
	       this.element.value = color.hex; 
	       carga_diseno_on_fly();
	    } 
	});	
	
	new MooRainbow('botones_color', {
		imgPath: '<?= PATH_JS ?>mooRainbow/Assets/images/',
		startColor: '<?= $usuario_configuracion->botones_color ?>',
		id: 'mooRain11',
	    onChange: function(color) { 
	        this.element.value = color.hex; 
	       	carga_diseno_on_fly();
	    } 
	});	
	
	new MooRainbow('botones_fondo', {
		imgPath: '<?= PATH_JS ?>mooRainbow/Assets/images/',
		startColor: '<?= $usuario_configuracion->botones_fondo ?>',
		id: 'mooRain12',
	    onChange: function(color) { 
	        this.element.value = color.hex; 
	        carga_diseno_on_fly();
	    } 
	});	
	
	new MooRainbow('botones_caja_sombra', {
		imgPath: '<?= PATH_JS ?>mooRainbow/Assets/images/',
		startColor: '<?= $usuario_configuracion->botones_caja_sombra ?>',
		id: 'mooRain13',
	    onChange: function(color) { 
	        this.element.value = color.hex; 
	       	carga_diseno_on_fly();	  
	    } 
	});	
	
	
		new MooRainbow('otros_color', {
		imgPath: '<?= PATH_JS ?>mooRainbow/Assets/images/',
		startColor: '<?= $usuario_configuracion->otros_color ?>',
		id: 'mooRain14',
	    onChange: function(color) { 
	        this.element.value = color.hex; 
	        carga_diseno_on_fly();
	    } 
	    
	    
	});	
	
	new MooRainbow('botones_borde_color', {
		imgPath: '<?= PATH_JS ?>mooRainbow/Assets/images/',
		startColor: '<?= $usuario_configuracion->botones_borde_color ?>',
		id: 'mooRain15',
	    onChange: function(color) { 
	        this.element.value = color.hex; 
	        carga_diseno_on_fly();
	  
	    } 
	});	
	new MooRainbow('titulo_sombra', {
		imgPath: '<?= PATH_JS ?>mooRainbow/Assets/images/',
		startColor: '<?= $usuario_configuracion->titulo_sombra ?>',
		id: 'mooRain16',
	    onChange: function(color) { 
	        this.element.value = color.hex; 
	        carga_diseno_on_fly();
	    } 
	    
	    
	});	
	
	document.title="<?= $titulo ?>";
	document.description="<?= $descripcion ?>";
	
	<?= ((count($web_configuracion_separadores) > 0)? '' : 'separadoresToDefault(); borrarTodos();') ?>
	modo_espera=false;
	carga_diseno_on_fly();
</div>