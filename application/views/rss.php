<?php echo '<?xml version="1.0" encoding="utf-8"?>
<?xml-stylesheet href="/xsl/rss.xsl" type="text/xsl" media="screen"?>
<rss version="2.0" 
	xmlns:content="http://purl.org/rss/1.0/modules/content/"
	xmlns:wfw="http://wellformedweb.org/CommentAPI/"
	xmlns:dc="http://purl.org/dc/elements/1.1/"
	>
' ?>
	<channel>
		<title>尼德教育 - 尼德动态</title>
		<link>http://www.ndedu.org/</link>
		<description><![CDATA[尼德教育 - 尼德动态]]></description>
		<pubDate><?php echo date('l dS \of F Y h:i:s A'); ?></pubDate>
		<generator>尼德教育</generator>

		<?php foreach( $articles as $article): ?>
		<item>
			<title><?php echo $article['title'] ?></title>
			<link><?php echo site_url('article/'.$article['article_id']) ?></link>
			<dc:creator><?php echo $article['title'] ?></dc:creator>
			<pubDate><?php echo $article['add_time'] ?></pubDate>
			<guid><?php echo site_url('article/'.$article['article_id']) ?></guid>
			<description><![CDATA[<?php echo $article['content'] ?>]]></description>
		</item>
		 <?php endforeach;?>
	</channel>
</rss>
