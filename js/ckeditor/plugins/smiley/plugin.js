/*
Copyright (c) 2003-2009, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/
var ruta='';
CKEDITOR.plugins.add('smiley',{requires:['dialog'],init:function(a){a.addCommand('smiley',new CKEDITOR.dialogCommand('smiley'));a.ui.addButton('Smiley',{label:a.lang.smiley.toolbar,command:'smiley'});CKEDITOR.dialog.add('smiley',this.path+'dialogs/smiley.js');}});CKEDITOR.config.smiley_path=CKEDITOR.basePath+'plugins/smiley/images/';CKEDITOR.config.smiley_images=[ruta+"ashamed0006.gif" , ruta+"character0008.gif" , ruta+"character0031.gif",ruta+"indifferent0024.gif" , ruta+"sick0023.gif",ruta+"ashamed0003.gif" , ruta+"evilgri.gif",ruta+"spam.gif",ruta+"sign0001.gif",ruta+"sad0120.gif",ruta+"rolleye0016.gif",ruta+"love0055.gif",ruta+"indifferent0013.gif",ruta+"happy0044.gif",ruta+"scared0011.gif",ruta+"mad0217.gif",ruta+"love0030.gif",ruta+"party0016.gif",ruta+"mad0249.gif",ruta+"mad0216.gif"];CKEDITOR.config.smiley_descriptions=[':ein:', '^^', ':goku:','zzz',':ups:',':uyss:',':6:',':spam:',':ejem:',':(',':sant:',':trocotro:',':|',':)',':O',':cabreo:',':dios:',':borr:',':ban:',':mal:'];
alert("dentro");
