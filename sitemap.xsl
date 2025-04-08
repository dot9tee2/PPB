<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" 
                xmlns:html="http://www.w3.org/TR/REC-html40"
                xmlns:sitemap="http://www.sitemaps.org/schemas/sitemap/0.9"
                xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output method="html" version="1.0" encoding="UTF-8" indent="yes"/>
    <xsl:template match="/">
        <html xmlns="http://www.w3.org/1999/xhtml">
            <head>
                <title>XML Sitemap - Pakistan Properties and Builders</title>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <style type="text/css">
                    body {
                        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
                        color: #333;
                        margin: 0;
                        padding: 2rem;
                    }
                    .wrapper {
                        max-width: 1200px;
                        margin: 0 auto;
                    }
                    .header {
                        padding: 2rem 0;
                        border-bottom: 1px solid #eee;
                        margin-bottom: 2rem;
                    }
                    h1 {
                        color: #2c3e50;
                        margin: 0;
                    }
                    table {
                        width: 100%;
                        border-collapse: collapse;
                        margin: 2rem 0;
                    }
                    th {
                        background-color: #f8f9fa;
                        text-align: left;
                        padding: 1rem;
                        border-bottom: 2px solid #dee2e6;
                    }
                    td {
                        padding: 1rem;
                        border-bottom: 1px solid #dee2e6;
                    }
                    tr:hover {
                        background-color: #f8f9fa;
                    }
                    .url {
                        color: #3498db;
                        text-decoration: none;
                    }
                    .url:hover {
                        text-decoration: underline;
                    }
                    .priority-high {
                        color: #27ae60;
                    }
                    .priority-medium {
                        color: #f39c12;
                    }
                    .priority-low {
                        color: #e74c3c;
                    }
                </style>
            </head>
            <body>
                <div class="wrapper">
                    <div class="header">
                        <h1>XML Sitemap</h1>
                        <p>Pakistan Properties and Builders</p>
                    </div>
                    <table>
                        <tr>
                            <th>URL</th>
                            <th>Last Modified</th>
                            <th>Change Frequency</th>
                            <th>Priority</th>
                        </tr>
                        <xsl:for-each select="sitemap:urlset/sitemap:url">
                            <tr>
                                <td>
                                    <a class="url" href="{sitemap:loc}">
                                        <xsl:value-of select="sitemap:loc"/>
                                    </a>
                                </td>
                                <td><xsl:value-of select="sitemap:lastmod"/></td>
                                <td><xsl:value-of select="sitemap:changefreq"/></td>
                                <td>
                                    <xsl:variable name="priority">
                                        <xsl:value-of select="sitemap:priority"/>
                                    </xsl:variable>
                                    <xsl:choose>
                                        <xsl:when test="$priority >= 0.8">
                                            <span class="priority-high"><xsl:value-of select="$priority"/></span>
                                        </xsl:when>
                                        <xsl:when test="$priority >= 0.5">
                                            <span class="priority-medium"><xsl:value-of select="$priority"/></span>
                                        </xsl:when>
                                        <xsl:otherwise>
                                            <span class="priority-low"><xsl:value-of select="$priority"/></span>
                                        </xsl:otherwise>
                                    </xsl:choose>
                                </td>
                            </tr>
                        </xsl:for-each>
                    </table>
                </div>
            </body>
        </html>
    </xsl:template>
</xsl:stylesheet> 