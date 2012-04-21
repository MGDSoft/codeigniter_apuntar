var carpetaImg="/img/";
var baseUrl="http://apuntes-dev";
evitarDobleSubmit=false;$valid=true;var nclass='';url=document.location.hostname;activadoSlide=false;function trim(cadena)
{for(i=0;i<cadena.length;)
{if(cadena.charAt(i)==" ")
cadena=cadena.substring(i+1,cadena.length);else
break;}
for(i=cadena.length-1;i>=0;i=cadena.length-1)
{if(cadena.charAt(i)==" ")
cadena=cadena.substring(0,i);else
break;}
return cadena;}
function slideGenerico(id,oculta){var myVerticalSlide=new Fx.Slide(id,{mode:'vertical',duration:500,wait:false});if(activadoSlide){activadoSlide=false;myVerticalSlide.slideOut();$(id).fade('out');}else{activadoSlide=true;myVerticalSlide.hide();if($(oculta))
{$(oculta).className='';$(id).fade('hide');}
myVerticalSlide.slideIn();$(id).fade('in');}}
function isIE()
{return document.all?true:false;}
function isIE6(){if(/MSIE 6.0/i.test(navigator.userAgent))return true
else return false;}
function borrarcampo(obj)
{obj.value='';obj.style.color='#000000';}
function Overflow(id,status)
{$(id).style.overflow="";}
function SetActiveCommand($value,$color)
{$('ActiveCommand').value=$value;eval($value+'()');if(isIE())
{event.cancelBubble=true;event.returnValue=false;event.cancel=true;}
return false;}
function ValidateSubmit($val)
{if(!document.getElementsByName('cbo_tipooperacion')[$val].value)
{if(isIE())
{event.cancelBubble=true;event.returnValue=false;event.cancel=true;}
return false;}}
function ValidateTelefonoAlternativo($control)
{$num=$($control).value;ResetState($control);var $num=(($num.replace('-','')).replace('.','')).replace('/','');if($num.length>0)
{if($num.length<9||$num.length>10)
{$valid=false;SetErrorState($control);}
if(!isInteger($num))
{$valid=false;SetErrorState($control);}}}
function ValidateTelefono($control)
{$num=$($control).value;ResetState($control);var $num=(($num.replace('-','')).replace('.','')).replace('/','');if($num.length<9||$num.length>10)
{$valid=false;SetErrorState($control);}
if(!isInteger($num))
{$valid=false;SetErrorState($control);}}
function ValidateTelefonoMejorado($control)
{$num=$($control).value;if($('lbl_'+$control))
$('lbl_'+$control).setStyle('color','');if($($control))
$($control).setStyle('background-color','');var $num=(($num.replace('-','')).replace('.','')).replace('/','');if($num.length<9||$num.length>10)
{$valid=false;if($('lbl_'+$control))
$('lbl_'+$control).setStyle('color','#ff4c6a');if($($control))
$($control).setStyle('background-color','#ffcfcf');}
if(!isInteger($num))
{$valid=false;$($control).setStyle('background-color','#ffcfcf');}}
function ValidateText($control)
{$text=$($control).value;var $text=(($text.replace('-','')).replace('.','')).replace('/','');ValidateNotEmpty($control)
for(i=0;i<$text.length;i++)
{$s=$text.charAt(i);if(isInteger($s))
{$valid=false;SetErrorState($control);}}}
function ValidateTextMejorado($control)
{if($('lbl_'+$control))
$('lbl_'+$control).setStyle('color','');if($($control))
$($control).setStyle('background-color','');$text=$($control).value;var $text=(($text.replace('-','')).replace('.','')).replace('/','');ValidateNotEmptyMejorado($control)
for(i=0;i<$text.length;i++)
{$s=$text.charAt(i);if(isInteger($s))
{$valid=false;if($('lbl_'+$control))
$('lbl_'+$control).setStyle('color','#ff4c6a');$($control).setStyle('background-color','#ffcfcf');}}}
function esNumero(numero){if(!/^([0-9])*$/.test(numero))
return false;return true;}
function ValidateDNI($control)
{ValidateNotEmpty($control);dni=$($control).value.toUpperCase();if(dni!=""&&dni.length==9&&dni!="50760335w"&&dni!="50760335W"){let=dni.substr(dni.length-1,1).toUpperCase();if(esNumero(let)==false)
{$($control).value=dni;}else{$valid=false;SetErrorState($control);}}else{$valid=false;SetErrorState($control);}}
function ValidateNumber($control)
{$text=$($control).value;ValidateNotEmpty($control)
for(i=0;i<$text.length;i++)
{$s=$text.charAt(i);if(!isInteger($s))
{$valid=false;SetErrorState($control);}}}
function ValidateNumberMejorado($control)
{if($('lbl_'+$control))
$('lbl_'+$control).setStyle('color','');if($($control))
$($control).setStyle('background-color','');$text=$($control).value;ValidateNotEmptyMejorado($control)
for(i=0;i<$text.length;i++)
{$s=$text.charAt(i);if(!isInteger($s))
{$valid=false;if($('lbl_'+$control))
$('lbl_'+$control).setStyle('color','#ff4c6a');if($($control))
$($control).setStyle('background-color','#ffcfcf');}}}
function ValidateFloatNumber($control)
{$text=$($control).value;ValidateNotEmpty($control)
for(i=0;i<$text.length;i++)
{$s=$text.charAt(i);if($s=="."||$s==",")
continue;if(!isInteger($s))
{$valid=false;SetErrorState($control);}}}
function isInteger(s)
{var i;for(i=0;i<s.length;i++)
{var c=s.charAt(i);if(((c<"0")||(c>"9")))return false;}
return true;}
function ValidateRadioNotEmpty($control)
{ResetRadioState($control);if(document.getElementsByName($control)[0].checked==false&&document.getElementsByName($control)[1].checked==false)
{$valid=false;SetRadioErrorState($control);}}
function ValidateRadioListNotEmpty($control)
{ResetRadioState($control);if(document.getElementById($control).childNodes[0].childNodes[0].checked==false&&document.getElementById($control).childNodes[1].childNodes[0].checked==false)
{$valid=false;SetRadioErrorState($control);}}
function ValidateRadioListNotEmptyMejorado($control)
{if(document.getElementById($control).childNodes[0].childNodes[0].checked==false&&document.getElementById($control).childNodes[1].childNodes[0].checked==false)
{$valid=false;if($('lbl_'+$control))
$('lbl_'+$control).setStyle('color','#ff4c6a');}else{if($('lbl_'+$control))
$('lbl_'+$control).setStyle('color','');}}
function ValidateCheckList($control)
{if($($control))
{ResetState('ChkMunis');$arr=$($control).value.split('-');$e=false;for(i=0;i<($arr.length-1);i++)
{if($('chk_munis_'+$arr[i]).checked)
{$e=true;break;}}
if(!$e)
{$valid=false;SetErrorState('ChkMunis');}}}
function ValidateCheckListDistritos($control)
{if($($control))
{if(document.getElementById)
elem=document.getElementById('tr_distritos');vis=elem.style;if(vis.display!='none')
{ResetState('ChkDist');$arr=$($control).value.split('-');$e=false;for(i=0;i<($arr.length-1);i++)
{if($('cdk_dists_'+$arr[i]).checked)
{$e=true;break;}}
if(!$e)
{$valid=false;SetErrorState('ChkDist');}}}}
function ValidateNotEmpty($control)
{if($($control))
{ResetState($control);if($($control).value=='')
{$valid=false;SetErrorState($control);}}}
function ValidateNotEmptyMejorado($control)
{if($($control))
{if($($control).value=='')
{$valid=false;if($('lbl_'+$control))
$('lbl_'+$control).setStyle('color','#ff4c6a');if($($control))
$($control).setStyle('background-color','#ffcfcf');}else{if($($control))
$($control).setStyle('background-color','');if($('lbl_'+$control))
$('lbl_'+$control).setStyle('color','');}}}
function ValidateNotEmptyInnerMejorado($control)
{if($($control))
{if($($control).innerHTML=='')
{$valid=false;if($('lbl_'+$control))
$('lbl_'+$control).setStyle('color','#ff4c6a');if($($control))
$($control).setStyle('background-color','#ffcfcf');}else{if($($control))
$($control).setStyle('background-color','');if($('lbl_'+$control))
$('lbl_'+$control).setStyle('color','');}}}
function ValidateNotEmptyTasa($control)
{if($($control))
{ResetState($control);if($($control).value==-1)
{$valid=false;SetErrorState($control);}}}
function ValidateNotChecked($control)
{ResetCheckState($control);if($($control).checked==false)
{$valid=false;SetCheckErrorState($control);}}
function ValidateNotCheckedMejorado($control)
{ResetCheckStateMejorado($control);if($($control).checked==false)
{$valid=false;SetCheckErrorStateMejorado($control);}}
function ValidateIsEmail($control)
{ResetState($control);if(!isEmail($($control).value))
{$valid=false;SetErrorState($control);}}
function ValidateIsEmailMejorado($control)
{ValidateNotEmptyMejorado($control);if(!isEmail($($control).value))
{$valid=false;if($('lbl_'+$control))
$('lbl_'+$control).setStyle('color','#ff4c6a');$($control).setStyle('background-color','#ffcfcf');}}
function isEmail(s)
{if(s.match(/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/))
{return true;}
return false;}
var erroralert=true;function ResetState($control)
{if(erroralert==true)
{if($('lbl_'+$control))
{$('lbl_'+$control).className='label';}
if($('err_'+$control))
$('err_'+$control).className='errmsg hidden';if($('ast_'+$control))
$('ast_'+$control).className='';if($('arr_'+$control))
$('arr_'+$control).style.display='none';if($($control))
{$($control).className='textbox'+nclass;}}}
function ResetRadioState($control)
{if(erroralert==true)
{$('lbl_'+$control).className='label';$('err_'+$control).className='errmsg hidden';if($('ast_'+$control))
$('ast_'+$control).className='';if($('arr_'+$control))
$('arr_'+$control).style.display='none';}}
function ResetCheckStateMejorado($control)
{if($('lbl_'+$control))
$('lbl_'+$control).setStyle('color','');if($($control))
$($control).setStyle('background-color','');if($('err_'+$control))
$('err_'+$control).className='spanned errmsg hidden';if($('ast_'+$control))
$('ast_'+$control).className='';if($('arr_'+$control))
$('arr_'+$control).style.display='none';}
function ResetCheckState($control)
{if(nclass)
$('lbl_'+$control).className=nclass;else
$('lbl_'+$control).className='label spanned';if($('err_'+$control))
$('err_'+$control).className='spanned errmsg hidden';if($('ast_'+$control))
$('ast_'+$control).className='';if($('arr_'+$control))
$('arr_'+$control).style.display='none';}
function SetErrorState($control)
{if(erroralert==true)
{if($('lbl_'+$control))
$('lbl_'+$control).className='label error';if($('ast_'+$control))
$('ast_'+$control).className='tpl2_ast_error';if($('arr_'+$control))
$('arr_'+$control).style.display='inline';if($('err_'+$control))
$('err_'+$control).className='errmsg';if($($control))
{$($control).className='error textbox'+nclass;}}}
function SetRadioErrorState($control)
{$('lbl_'+$control).className='label error';$('err_'+$control).className='errmsg';if($('arr_'+$control))
$('arr_'+$control).style.display='inline';if($('err_'+$control))
$('err_'+$control).className='errmsg';if($('ast_'+$control))
$('ast_'+$control).className='tpl2_ast_error';}
function SetCheckErrorState($control)
{$('lbl_'+$control).className='label spanned';$('err_'+$control).className='errmsg';$('err_'+$control).style.color='red';if($('arr_'+$control))
$('arr_'+$control).style.display='inline';if($('err_'+$control))
$('err_'+$control).className='errmsg';if($('ast_'+$control))
$('ast_'+$control).className='tpl2_ast_error';}
function SetCheckErrorStateMejorado($control)
{if($('lbl_'+$control))
$('lbl_'+$control).setStyle('color','#ff4c6a');$($control).setStyle('background-color','#ffcfcf');if($('arr_'+$control))
$('arr_'+$control).style.display='inline';if($('err_'+$control))
$('err_'+$control).className='errmsg';if($('ast_'+$control))
$('ast_'+$control).className='tpl2_ast_error';}
function isNumericTextBoxScript(e,floatValue)
{var key,element;if(window.event)key=e.keyCode;else if(e.which)key=e.which;else return true;if(e.srcElement)element=e.srcElement;else if(e.target)element=e.target;else return true;if(key==46)
{if(floatValue==1){return(floatValue&&element.value.indexOf(".")==-1);}else{return false}}
return(key>47&&key<58)||key==8||key==0;}
function abreRapidoHorizontal(id,nuevoTexto){var myVerticalSlide=new Fx.Slide(id,{mode:'horizontal',duration:500,wait:false});myVerticalSlide.hide();$(id).innerHTML=nuevoTexto;myVerticalSlide.slideIn();}
function cerradoRapidoVertical(id){var myVerticalSlide=new Fx.Slide(id,{mode:'vertical',duration:500,wait:false});myVerticalSlide.slideOut();}
function LimpiarChecks()
{elements=document.getElementsByTagName('input');for(i=0;i<elements.length;i++)
{if(elements[i].type=='checkbox')
{elements[i].checked=false;}}}
function validarMail()
{$valid=true;ValidateIsEmail('txt_email');if($valid)
{document.Formu.submit();}
else
{return false;}
if(isIE())
{event.cancelBubble=true;event.returnValue=false;event.cancel=true;}
return false;}
function Empresas()
{$valid=true;ValidateText('txt_nombre');ValidateIsEmail('txt_email');ValidateTelefono('txt_telefono');ValidateNotEmpty('txt_empresa');ValidateNotEmpty('txt_sector');ValidateNotEmpty('cbo_provincia');ValidateNotEmpty('cbo_areainteres');ValidateNotEmpty('txt_comentariosadicionales');if($valid)
{document.Formu.submit();}
else
{$('ActiveCommand').value='';$('errorBox').className='errorBox';}}
function makeDate($idCalendar,$dateTimeName)
{var dia,mes,ano;var value=document.getElementById($idCalendar).value;dia=value.substr(0,2);mes=value.substr(3,2);ano=value.substr(6,4);document.getElementById($dateTimeName+'_day').value=dia;document.getElementById($dateTimeName+'_month').value=mes;document.getElementById($dateTimeName+'_year').value=ano;}
function ValidateDate(control)
{validaFecha=true;var Ano=$(control+'_year').value;var Mes=$(control+'_month').value;var Dia=$(control+'_day').value;ResetState(control);ResetState(control+'_month');ResetState(control+'_year');ResetState(control+'_day');if($('ast_'))
$('ast_').className='';if($('arr_'))
$('arr_').style.display='none';if($('lbl_'))
$('lbl_').className='label';if(Ano==''||isNaN(Ano)||Ano.length<4||parseFloat(Ano)<1900)
{$valid=false;validaFecha=false;}
if(Mes==''||isNaN(Mes)||parseFloat(Mes)<1||parseFloat(Mes)>12)
{$valid=false;validaFecha=false;}
if(Dia==''||isNaN(Dia)||parseInt(Dia,10)<1||parseInt(Dia,10)>31)
{$valid=false;validaFecha=false;}
if((Mes==4)||(Mes==6)||(Mes==9)||(Mes==11)||(Mes==2))
{if((Mes==2&&Dia>28&&!esBisiesto(Ano))||(Dia>30)||(Mes==2&&Dia>29&&esBisiesto(Ano)))
{$valid=false;validaFecha=false;}}
if(validaFecha==false)
{$valid=false;SetErrorState(control);SetErrorState(control+'_month');SetErrorState(control+'_year');SetErrorState(control+'_day');if($('ast_'))
$('ast_').className='tpl2_ast_error';if($('arr_'))
$('arr_').style.display='inline';if($('lbl_'))
$('lbl_').className='label error';}}
function esBisiesto(year)
{return(((year%4==0)&&(year%100!=0))||(year%400==0))?true:false;}
function openPopUp(id)
{hasScrollBars=false;var theWidth="";var theHeight="";var scrollBars="scrollbars";if(hasScrollBars==false)scrollBars="scrollbars=0";if((theWidth=="")||(theWidth==null))theWidth=300;if((theHeight=="")||(theHeight==null))theHeight=368;var theLeft=(screen.availWidth-theWidth)/2;var theTop=(screen.availHeight-theHeight)/2;url=document.location.hostname;var lsURL="/popup.php?id="+id;var popupWin=window.open(lsURL,'_'+Math.round(Math.random()*1000000),'top='+theTop+',left='+theLeft+',menubar=0,toolbar=0,location=0,directories=0,status=0,'+scrollBars+',width='+theWidth+', height='+theHeight);}
function getRadioButtonSelectedValue(ctrl)
{for(i=0;i<ctrl.length;i++)
if(ctrl[i].checked)return ctrl[i].value;}
function EnableDisableRadio(id)
{if(document.Formu.rdb_telefonica[0].disabled!=false)
{document.Formu.rdb_telefonica[0].disabled=false;document.Formu.rdb_telefonica[1].disabled=false;}
else
{document.Formu.rdb_telefonica[0].disabled=true;document.Formu.rdb_telefonica[1].disabled=true;}}
function EnableText(id)
{document.getElementById(id).disabled=false;}
function DisableText(id)
{document.getElementById(id).disabled=true;}
function EnableRadio(id)
{document.Formu.rdb_telefonica[0].disabled=false;document.Formu.rdb_telefonica[1].disabled=false;}
function DisableRadio(id)
{document.Formu.rdb_telefonica[0].disabled=true;document.Formu.rdb_telefonica[1].disabled=true;}
function addCommas(nStr)
{nStr+='';x=nStr.split('.');x1=x[0];x2=x.length>1?'.'+x[1]:'';var rgx=/(\d+)(\d{3})/;while(rgx.test(x1)){x1=x1.replace(rgx,'$1'+'.'+'$2');}
return x1+x2;}
function Decimales(Numero,Decimales){var num;if(Decimales==0){num=addCommas(parseInt(Numero));}else{pot=Math.pow(10,Decimales);num=parseInt(Numero*pot)/pot;nume=num.toString().split('.');if(nume.length==1)
{var deci='';for(i=0;i<Decimales;i++)
deci+=String.fromCharCode(48);num=nume+'.'+deci;}}
return num;}

function comprobar_estado_form(form){
	validacion=true;
	//alert(+form + ' input[validacion="si"]');
	//alert($$(form + ' input[validacion="si"]').length);
	$$('#'+form + ' input[validacion="si"]').each(function(el)
	{
		
		var objReferencia=$(el.get('id').substring(18));
		
		eval("validacion_mgd"+el.get('aviso'));
		
		if (el.value==0)
			validacion=false;
		
	});;
	
	return validacion;
}

var iconoRapidoDefaultAjax="<table align='center' height='260'><tr><td align='center'><img src='"+carpetaImg+"ajax-loader.gif'><br>Cargando...</td></tr></table>";

function enviar_form_ajax(formulario,url_envio,ver_resultado,ejecutar_si_ok){
		
	valido=comprobar_estado_form(formulario);
	
	if ($(ver_resultado))
	{
		$(ver_resultado).className='';
		$(ver_resultado).innerHTML='';
	}
	
	if (valido)
	{
		
		$(formulario).set('send',{url: baseUrl+url_envio
		,method:'post'
		,onRequest:function(){if ($(ver_resultado)) $(ver_resultado).innerHTML=iconoRapidoDefaultAjax;}
		,onComplete:function(responseText){
			$(ver_resultado).innerHTML=responseText;
			if ($(ver_resultado))
				$(ver_resultado).innerHTML='';
			
			
			
			if (responseText!="OK")		
			{
				if ($(ver_resultado))
				{
					$(ver_resultado).innerHTML=responseText;
					eval(responseText);
				}
			}else{
				if (ejecutar_si_ok)
					eval(ejecutar_si_ok);
			}
		}}).send();
	}
}
