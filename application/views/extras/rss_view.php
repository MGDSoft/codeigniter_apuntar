<?php echo '<?xml version="1.0" encoding="utf-8"?>' ?>
<rss version="2.0" 
	xmlns:content="http://purl.org/rss/1.0/modules/content/"
	xmlns:wfw="http://wellformedweb.org/CommentAPI/"
	xmlns:dc="http://purl.org/dc/elements/1.1/"
	xmlns:atom="http://www.w3.org/2005/Atom"
	xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
	xmlns:slash="http://purl.org/rss/1.0/modules/slash/"
>
	<channel>
	    <title><?=$titulo?></title>
	    <link><?=$feed_url?></link>
	    <atom:link href="http://<?=$nombre_unico.'.'.URL_BASE ?>/extra/rss" rel="self" type="application/rss+xml"/>
	    <image>
			<title><?=$titulo?></title>
			<link>http://<?=$nombre_unico.'.'.URL_BASE ?></link>
			<url>http://<?=$nombre_unico.'.'.URL_BASE.PATH_IMG.'usuario/logo/'.$usuario_configuracion->logo ?></url>
		</image>
	    <description><?=$description?></description>
	    <pubDate><?=  date(DATE_RFC822); ?></pubDate>
	    <generator>http://www.mgdsoftware.com/</generator>
	<?php foreach ($noticias as $post): ?>
	    <item>
	        <title><?=$post->titulo?></title>
	        <dc:creator><?= $titulo ?></dc:creator>
	        <link>http://<?=$nombre_unico.'.'.URL_BASE.'/portal#!news/' . url_title($post->titulo).'/'.$post->id_noticia.'/' ?></link>
	        <guid>http://<?=$nombre_unico.'.'.URL_BASE.'/portal#!news/' . url_title($post->titulo).'/'.$post->id_noticia.'/' ?></guid>
	        <pubDate><?= date(DATE_RFC822, strtotime($post->fecha)) ?></pubDate>
	        <category><![CDATA[<?=$post->nombre?>]]></category>
	        <description>
	        	<![CDATA[<?=  preg_replace('~[\r\n]+~', '', $post->noticia) ?>]]>
	        </description>
	    </item>    
	<?php endforeach;?>
	</channel>
</rss>