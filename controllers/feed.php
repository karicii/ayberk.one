<?php

$db = App::resolve('database');
$config = require BASE_PATH . '/core/config.php';

// Son 20 yazıyı çek
$posts = $db->query(
    'SELECT * FROM posts 
     ORDER BY created_at DESC 
     LIMIT 20'
)->findAll();

// XML header
header('Content-Type: application/rss+xml; charset=utf-8');

$baseUrl = $config['app']['url'];
$buildDate = date('r');

echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<rss version="2.0" 
     xmlns:atom="http://www.w3.org/2005/Atom"
     xmlns:content="http://purl.org/rss/1.0/modules/content/"
     xmlns:dc="http://purl.org/dc/elements/1.1/">
    <channel>
        <title>Ayberk.one</title>
        <link><?= $baseUrl ?></link>
        <description>Girişimci, yazılımcı. Web projeleri, SaaS ürünleri ve yazılım tabanlı satış sistemleri üzerine notlar.</description>
        <language>tr</language>
        <lastBuildDate><?= $buildDate ?></lastBuildDate>
        <atom:link href="<?= $baseUrl ?>/feed" rel="self" type="application/rss+xml" />
        <generator>Custom PHP RSS Generator</generator>
        <image>
            <url><?= $baseUrl ?>/assets/images/logo.png</url>
            <title>Ayberk.one</title>
            <link><?= $baseUrl ?></link>
        </image>

        <?php foreach ($posts as $post): ?>
        <item>
            <title><![CDATA[<?= htmlspecialchars($post['title']) ?>]]></title>
            <link><?= $baseUrl ?>/posts/<?= htmlspecialchars($post['slug']) ?></link>
            <guid isPermaLink="true"><?= $baseUrl ?>/posts/<?= htmlspecialchars($post['slug']) ?></guid>
            <pubDate><?= date('r', strtotime($post['created_at'])) ?></pubDate>
            <dc:creator><![CDATA[Ayberk Arıcı]]></dc:creator>
            
            <?php if (!empty($post['image_path'])): ?>
            <enclosure url="<?= $baseUrl . htmlspecialchars($post['image_path']) ?>" type="image/jpeg" />
            <?php endif; ?>
            
            <description><![CDATA[<?= htmlspecialchars(substr(strip_tags($post['body']), 0, 300)) ?>...]]></description>
            
            <content:encoded><![CDATA[
                <?php if (!empty($post['image_path'])): ?>
                <img src="<?= $baseUrl . htmlspecialchars($post['image_path']) ?>" alt="<?= htmlspecialchars($post['title']) ?>" style="max-width: 100%; height: auto; margin-bottom: 1rem;" />
                <?php endif; ?>
                <?= $post['body'] ?>
                <p><a href="<?= $baseUrl ?>/posts/<?= htmlspecialchars($post['slug']) ?>">Devamını oku...</a></p>
            ]]></content:encoded>
        </item>
        <?php endforeach; ?>

    </channel>
</rss>
