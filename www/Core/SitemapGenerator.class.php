<?php
declare(strict_types = 1);

namespace LeaffyMvc\Core;

use PDO;

class SitemapGenerator {

    public static function generate() {

        $configFile = fopen($_SERVER['DOCUMENT_ROOT'] . "/sitemap.xml", "w") or die("Unable to open file!");
        $pdo = new PDO(DBDRIVER.":host=".DBHOST.";dbname=".DBNAME.";port=".DBPORT,DBUSER,DBPWD);
        $pages = $pdo->query("SELECT * FROM Page WHERE status = 'PUBLISHED'");

        $content = "<?xml version=\"1.0\" encoding=\"UTF-8\"?> \n";
        $content .= "<urlset xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xsi:schemaLocation=\"http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd\" xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">";

        // Home Page
        $content .= '
            <url> 
                <loc>'.DOMAIN.'</loc>
                <changefreq>weekly</changefreq>
                <priority>2</priority>            
            </url>
        ';

        // Other Pages
        foreach ($pages as $page) {
            $slug = str_replace(' ', '_',$page['title']);
            $content .= '
            <url> 
                <loc>'.DOMAIN.'/'.$slug.'</loc>
                <changefreq>daily</changefreq>
                <priority>1</priority>            
            </url>
            ';
        }

        $content .= "</urlset>";

        fwrite($configFile, $content);
        fclose($configFile);
    }

}

?>
