<?php
echo '<?xml version="1.0" encoding="utf-8"?>' . "
";
?>
<rss version="2.0" 
	xmlns:atom="http://www.w3.org/2005/Atom"
	xmlns:content="http://purl.org/rss/1.0/modules/content/"
	xmlns:wfw="http://wellformedweb.org/CommentAPI/"
	xmlns:dc="http://purl.org/dc/elements/1.1/"
	xmlns:georss="http://www.georss.org/georss"
	xmlns:media="http://search.yahoo.com/mrss/"
>
	<channel>
	    <title><?=$titulo?></title>
	    <link><?=$feed_url?></link>
	    <atom:link href="<?=$feed_url?>/extra/rss" rel="self" type="application/rss+xml" />
	    <description><?=$description?></description>
	    <pubDate><?=$pubdate?></pubDate>
	    <generator>http://www.mgdsoftware.com/</generator>
	<?php foreach ($noticias as $post): ?>
	    <item>
	        <title><?=$post->titulo?></title>
	        <dc:creator><?= $titulo ?></dc:creator>
	        <link>http://<?=$nombre_unico.'.'.URL_BASE.'/portal#!news/' . url_title($post->titulo).'/'.$post->id_noticia.'/' ?></link>
	        <pubDate><?= $post->fecha ?></pubDate>
	        <category><![CDATA[<?=$post->nombre?>]]></category>
	        <description><![CDATA[<?=  preg_replace('~[\r\n]+~', '<br>', $post->noticia) ?>]]></description>
	    </item>    
	<?php endforeach;?>
	</channel>
</rss>