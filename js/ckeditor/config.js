/*
Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	config.DefaultLinkTarget = "_blank";
	config.protectedSource.push( /<\?[\s\S]*?\?>/g );   // PHP Code
	config.protectedSource.push( /<%[\s\S]*?%>/g );   // ASP Code
	config.protectedSource.push( /(]+>[\s|\S]*?<\/asp:[^\>]+>)|(]+\/>)/gi );   // ASP.Net Code
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
};
