<?php header('Content-type: application/xml; charset=utf-8') ?>
<?php echo "<?xml version='1.0' encoding='UTF-8'?>"

/**
 * The file creates 'sitemap.xml'
 * The redirection is made in '.htaccess'
 */
?>

<urlset xmlns='http://www.sitemaps.org/schemas/sitemap/0.9'>

<?php

include 'core/DbConnection.php';

include "app/models/constants.inc.php";

use core\DbConnection;

class ShowSiteMap extends DbConnection
{
    /**
     * Get data for main links
     */
    private function getMainLinks()
    {
        $query = $this->connect()->query("SELECT
            link_url_name, last_mods
              FROM main_links
              WHERE site_map = true
        ");

        return $query;
    }

    /**
     * Show main links
     */
    public function showMainLinks()
    {
        $query = $this->getMainLinks();

        while ($row = $query->fetch(PDO::FETCH_OBJ)) {

            if ($row->link_url_name == "home") {
                echo "
                    <url>
                        <loc>" . HTTP . "{$_SERVER['HTTP_HOST']}</loc>
                        <lastmod>{$row->last_mods}</lastmod>
                        <changefreq>weekly</changefreq>
                    </url>
                ";

            } else {
                echo "
                    <url>
                        <loc>" . HTTP . "{$_SERVER['HTTP_HOST']}/{$row->link_url_name}</loc>
                        <lastmod>{$row->last_mods}</lastmod>
                    </url>
                ";
            }
        }
    }
}

    /**
     * Show links
     */
    $siteMapLinks = new ShowSiteMap();
    $siteMapLinks->showMainLinks();
?>
</urlset>
