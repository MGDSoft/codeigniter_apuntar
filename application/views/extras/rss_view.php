<xml version="1.0" encoding="utf-8">
<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:sy="http://purl.org/rss/1.0/modules/syndication/" xmlns:admin="http://webns.net/mvcb/" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:atom="http://www.w3.org/2005/Atom">
<channel>
    <title><?=$titulo?></title>
    <link><?=$feed_url?></link>
    <atom:link href="<?=$feed_url?>/feed" rel="self" type="application/rss+xml" />
    <description><?=$description?></description>
    <pubDate><?=$pubdate?></pubDate>
    <sy:updatePeriod>hourly</sy:updatePeriod>
    <sy:updateFrequency>1</sy:updateFrequency>
    <lastBuildDate><?=$pubdate?></lastBuildDate>
    <docs>http://www.rssboard.org/rss-specification</docs>
    <generator>MGDSoftware</generator>
    <managingEditor>MGDSoftware</managingEditor>
    <webMaster>MGDSoftware</webMaster>
<?php foreach ($noticias as $post): ?>
    <item>
        <title><?=$post->titulo?></title>
        <link><?=base_url().$nombre_unico.'#!news/' . urlencode($post->titulo).'/'.$post->id_noticia.'/' ?></link>
        <pubDate><?= $post->fecha ?></pubDate>
        <dc:creator>MGDSoftware</dc:creator>
        <category><![CDATA[ <?=$post->nombre?> ]]></category>
        <content:encoded><![CDATA[ <?=  strip_tags ($post->noticia) ?> ]]></content:encoded>
    </item>    
<?php endforeach;?>
</channel>
</rss>
