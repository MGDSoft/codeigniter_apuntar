/*
Copyright (c) 2003-2009, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.skin = 'office2003';
	config.extraPlugins = 'syntaxhighlight';
	   //config.toolbar = 'Basic';
	   CKEDITOR.config.toolbar = [
	   ['Styles','Format','Font','FontSize'],
	   '/',
	   ['Bold','Italic','Underline','StrikeThrough','-','Undo','Redo','-','Cut','Copy','Paste','Find','Replace','-','Outdent','Indent','-','Print'],
	   '/',
	   ['NumberedList','BulletedList','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
	   ['Image','Table','-','Link','Flash','Smiley','TextColor','BGColor','Source']
	] ;
};
