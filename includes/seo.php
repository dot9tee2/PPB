<?php
/**
 * SEO Helper Functions
 */

function getCanonicalUrl() {
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
    $host = $_SERVER['HTTP_HOST'];
    $uri = $_SERVER['REQUEST_URI'];
    
    // Remove query parameters
    $uri = strtok($uri, '?');
    
    // Remove trailing slash
    $uri = rtrim($uri, '/');
    
    // If it's the homepage, return just the domain
    if ($uri === '') {
        return $protocol . $host;
    }
    
    return $protocol . $host . $uri;
}

function outputCanonicalTag() {
    $canonicalUrl = getCanonicalUrl();
    echo '<link rel="canonical" href="' . htmlspecialchars($canonicalUrl) . '" />' . PHP_EOL;
}

function outputMetaRobots($index = true, $follow = true) {
    $content = [];
    if ($index) $content[] = 'index';
    if ($follow) $content[] = 'follow';
    echo '<meta name="robots" content="' . implode(',', $content) . '" />' . PHP_EOL;
}

function outputAlternateHreflang($currentUrl) {
    $baseUrl = 'https://pakistanpropertiesandbuilders.com';
    echo '<link rel="alternate" hreflang="en" href="' . $baseUrl . $currentUrl . '" />' . PHP_EOL;
    echo '<link rel="alternate" hreflang="ur" href="' . $baseUrl . '/ur' . $currentUrl . '" />' . PHP_EOL;
    echo '<link rel="alternate" hreflang="x-default" href="' . $baseUrl . $currentUrl . '" />' . PHP_EOL;
} 