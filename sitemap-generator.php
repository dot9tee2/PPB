<?php
include 'db_connect.php';

class ImprovedSitemapGenerator {
    private $conn;
    private $baseURL;
    private $urls = array();
    private $logFile = 'sitemap_generation.log';
    
    public function __construct($conn, $baseURL) {
        $this->conn = $conn;
        $this->baseURL = rtrim($baseURL, '/');
    }
    
    private function log($message) {
        $timestamp = date('Y-m-d H:i:s');
        $logMessage = "[$timestamp] $message\n";
        file_put_contents($this->logFile, $logMessage, FILE_APPEND);
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
        $staticPages = [
            ['path' => '/', 'priority' => '1.0', 'changefreq' => 'daily'],
            ['path' => '/about', 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['path' => '/services', 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['path' => '/contact', 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['path' => '/projects', 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['path' => '/blog', 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['path' => '/city_projects', 'priority' => '0.8', 'changefreq' => 'weekly']
        ];
        
        foreach ($staticPages as $page) {
            $this->addURL(
                $this->baseURL . $page['path'],
                null,
                $page['changefreq'],
                $page['priority']
            );
        }
    }
    
    private function addBlogPosts() {
        try {
            $sql = "SELECT slug, update_date, category FROM blog_posts WHERE status = 'published' ORDER BY publish_date DESC";
            $result = $this->conn->query($sql);
            
            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    // Add individual blog post
                    $this->addURL(
                        $this->baseURL . '/blog/' . $row['slug'],
                        $row['update_date'],
                        'monthly',
                        '0.7'
                    );
                    
                    // Add category page if it exists
                    if (!empty($row['category'])) {
                        $this->addURL(
                            $this->baseURL . '/blog/category/' . urlencode($row['category']),
                            $row['update_date'],
                            'weekly',
                            '0.6'
                        );
                    }
                }
            }
        } catch (Exception $e) {
            $this->log("Error adding blog posts: " . $e->getMessage());
        }
    }
    
    private function addProjects() {
        try {
            // Add main projects page
            $this->addURL(
                $this->baseURL . '/projects',
                null,
                'weekly',
                '0.9'
            );
            
            // Add city-specific project pages
            $cities = ['Islamabad', 'Lahore', 'Sialkot'];
            foreach ($cities as $city) {
                $this->addURL(
                    $this->baseURL . '/projects/' . urlencode($city),
                    null,
                    'weekly',
                    '0.8'
                );
            }
            
            // Add individual project details
            $sql = "SELECT slug, last_updated FROM projects WHERE status = 'active' ORDER BY last_updated DESC";
            $result = $this->conn->query($sql);
            
            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    $this->addURL(
                        $this->baseURL . '/details/' . $row['slug'],
                        $row['last_updated'],
                        'weekly',
                        '0.8'
                    );
                }
            }
        } catch (Exception $e) {
            $this->log("Error adding projects: " . $e->getMessage());
        }
    }
    
    public function generate() {
        try {
            $this->log("Starting sitemap generation");
            
            $this->addStaticPages();
            $this->addBlogPosts();
            $this->addProjects();
            
            $xml = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
            $xml .= '<?xml-stylesheet type="text/xsl" href="sitemap.xsl"?>' . PHP_EOL;
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
            if (file_put_contents('sitemap.xml', $xml)) {
                $this->log("Sitemap generated successfully with " . count($this->urls) . " URLs");
                $this->pingSearchEngines();
                return true;
            } else {
                throw new Exception("Failed to write sitemap.xml");
            }
        } catch (Exception $e) {
            $this->log("Error generating sitemap: " . $e->getMessage());
            return false;
        }
    }
    
    private function pingSearchEngines() {
        $sitemapURL = urlencode($this->baseURL . '/sitemap.xml');
        $searchEngines = [
            'Google' => 'https://www.google.com/ping?sitemap=' . $sitemapURL,
            'Bing' => 'https://www.bing.com/ping?sitemap=' . $sitemapURL,
            'Yandex' => 'https://blogs.yandex.com/pings/?status=success&url=' . $sitemapURL
        ];
        
        foreach ($searchEngines as $engine => $url) {
            try {
                $response = @file_get_contents($url);
                $this->log("Pinged $engine: " . ($response !== false ? "Success" : "Failed"));
            } catch (Exception $e) {
                $this->log("Error pinging $engine: " . $e->getMessage());
            }
        }
    }
}

// Usage
try {
    $baseURL = 'https://www.pakistanpropertiesandbuilders.com';
    $generator = new ImprovedSitemapGenerator($conn, $baseURL);
    $success = $generator->generate();
    
    if ($success) {
        echo "Sitemap generated successfully. Check sitemap_generation.log for details.\n";
    } else {
        echo "Error generating sitemap. Check sitemap_generation.log for details.\n";
    }
} catch (Exception $e) {
    echo "Fatal error: " . $e->getMessage() . "\n";
} 