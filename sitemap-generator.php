<?php
include 'db_connect.php';

class SitemapGenerator {
    private $conn;
    private $baseURL;
    private $urls = array();
    
    public function __construct($conn, $baseURL) {
        $this->conn = $conn;
        $this->baseURL = rtrim($baseURL, '/');
    }
    
    private function addURL($url, $lastmod = null, $changefreq = 'weekly', $priority = '0.8') {
        $this->urls[] = array(
            'loc' => $url,
            'lastmod' => $lastmod ? date('c', strtotime($lastmod)) : date('c'),
            'changefreq' => $changefreq,
            'priority' => $priority
        );
    }
    
    private function addStaticPages() {
        // Static pages with high priority
        $this->addURL($this->baseURL . '/', null, 'weekly', '1.0');
        $this->addURL($this->baseURL . '/about', null, 'monthly', '0.8');
        $this->addURL($this->baseURL . '/services', null, 'monthly', '0.8');
        $this->addURL($this->baseURL . '/contact', null, 'monthly', '0.7');
        $this->addURL($this->baseURL . '/properties', null, 'daily', '0.9');
        $this->addURL($this->baseURL . '/blog', null, 'daily', '0.9');
    }
    
    private function addBlogPosts() {
        $sql = "SELECT slug, update_date FROM blog_posts ORDER BY publish_date DESC";
        $result = $this->conn->query($sql);
        
        while ($row = $result->fetch_assoc()) {
            $this->addURL(
                $this->baseURL . '/blog/' . $row['slug'],
                $row['update_date'],
                'monthly',
                '0.7'
            );
        }
    }
    
    private function addPropertyListings() {
        $sql = "SELECT slug, last_updated FROM properties ORDER BY last_updated DESC";
        $result = $this->conn->query($sql);
        
        while ($row = $result->fetch_assoc()) {
            $this->addURL(
                $this->baseURL . '/property/' . $row['slug'],
                $row['last_updated'],
                'weekly',
                '0.8'
            );
        }
    }
    
    public function generate() {
        $this->addStaticPages();
        $this->addBlogPosts();
        $this->addPropertyListings();
        
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;
        
        foreach ($this->urls as $url) {
            $xml .= "\t<url>\n";
            $xml .= "\t\t<loc>" . htmlspecialchars($url['loc']) . "</loc>\n";
            $xml .= "\t\t<lastmod>" . $url['lastmod'] . "</lastmod>\n";
            $xml .= "\t\t<changefreq>" . $url['changefreq'] . "</changefreq>\n";
            $xml .= "\t\t<priority>" . $url['priority'] . "</priority>\n";
            $xml .= "\t</url>\n";
        }
        
        $xml .= '</urlset>';
        
        // Save sitemap
        file_put_contents('sitemap.xml', $xml);
        
        // Ping search engines
        $this->pingSearchEngines();
    }
    
    private function pingSearchEngines() {
        $sitemapURL = urlencode($this->baseURL . '/sitemap.xml');
        
        // Ping Google
        file_get_contents('https://www.google.com/ping?sitemap=' . $sitemapURL);
        
        // Ping Bing
        file_get_contents('https://www.bing.com/ping?sitemap=' . $sitemapURL);
    }
}

// Usage
$baseURL = 'https://www.pakistanpropertiesandbuilders.com';
$generator = new SitemapGenerator($conn, $baseURL);
$generator->generate();

// Log the generation
$log = date('Y-m-d H:i:s') . " - Sitemap generated successfully\n";
file_put_contents('sitemap_log.txt', $log, FILE_APPEND); 