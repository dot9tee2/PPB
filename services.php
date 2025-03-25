<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Expert Real Estate Services in Pakistan | Pakistan Properties and Builders</title>
    <meta name="description" content="Pakistan Properties and Builders offers comprehensive real estate services including property sales, investment consultation, and property management in Lahore, Islamabad, and Sialkot. Contact us today!" />
    <meta name="keywords" content="real estate services, Pakistan Properties, property sales, investment consultation, property management, Lahore real estate, Islamabad properties, Sialkot real estate, DHA Lahore, Bahria Town" />
    <link rel="stylesheet" href="css/base.css" />
    <link rel="stylesheet" href="css/navbar.css" />
    <link rel="stylesheet" href="css/footer.css" />
    <link rel="stylesheet" href="css/services.css" media="all" />
    <link rel="stylesheet" href="css/accessibility.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Poppins:wght@400;600;700&display=swap" />
</head>
<body>
    <a href="#main-services" class="skip-to-content">Skip to main content</a>
    <?php include 'navbar.php'; ?>

    <!-- Hero Section -->
    <header class="services-hero">
        <div class="services-hero-overlay"></div>
        <div class="services-hero-content">
            <h1>Expert Real Estate Services in Pakistan</h1>
            <p>Your trusted partner for all property needs in Lahore, Islamabad, and Sialkot</p>
            <div class="hero-cta">
                <a href="#services-overview" class="btn btn-primary">Explore Our Services</a>
                <a href="contact.php" class="btn btn-outline">Contact Us</a>
            </div>
            <div class="quick-search">
                <form action="properties.php" method="get" class="search-form">
                    <div class="search-group">
                        <select name="location" id="location">
                            <option value="">Select Location</option>
                            <option value="lahore">Lahore</option>
                            <option value="islamabad">Islamabad</option>
                            <option value="sialkot">Sialkot</option>
                        </select>
                        <select name="type" id="property-type">
                            <option value="">Property Type</option>
                            <option value="residential">Residential</option>
                            <option value="commercial">Commercial</option>
                            <option value="plot">Plot</option>
                        </select>
                        <select name="budget" id="budget">
                            <option value="">Budget (PKR)</option>
                            <option value="1-5m">1M - 5M</option>
                            <option value="5-10m">5M - 10M</option>
                            <option value="10-20m">10M - 20M</option>
                            <option value="20m+">20M+</option>
                        </select>
                        <button type="submit" class="search-btn">
                            <i class="fas fa-search" aria-hidden="true"></i>
                            <span class="sr-only">Search Properties</span>
                        </button>
                    </div>
                </form>
            </div>
            <div class="trust-badges">
                <div class="badge">
                    <i class="fas fa-shield-alt" aria-hidden="true"></i>
                    <span>Licensed</span>
                </div>
                <div class="badge">
                    <i class="fas fa-award" aria-hidden="true"></i>
                    <span>Award-winning</span>
                </div>
                <div class="badge">
                    <i class="fas fa-user-check" aria-hidden="true"></i>
                    <span>10,000+ Clients</span>
                </div>
            </div>
        </div>
    </header>

    <!-- Video Showcase Section -->
    <section class="video-showcase">
        <div class="container">
            <div class="video-content">
                <div class="video-text">
                    <h2>See How We Work</h2>
                    <p>Take a virtual tour of our premier properties and learn about our comprehensive real estate services.</p>
                    <ul class="video-features">
                        <li><i class="fas fa-check-circle" aria-hidden="true"></i> Exclusive property tours</li>
                        <li><i class="fas fa-check-circle" aria-hidden="true"></i> Expert market analysis</li>
                        <li><i class="fas fa-check-circle" aria-hidden="true"></i> Client success stories</li>
                    </ul>
                </div>
                <div class="video-wrapper">
                    <div class="video-container" data-video-id="YOUR_YOUTUBE_ID_HERE">
                        <div class="video-placeholder">
                            <img src="media/video-thumbnail.jpg" alt="Property showcase video thumbnail" class="video-thumbnail" width="560" height="315">
                            <button class="play-button" aria-label="Play video">
                                <i class="fas fa-play" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Overview Section -->
    <section id="services-overview" class="services-overview">
        <div class="container">
            <h2>Comprehensive Real Estate Solutions</h2>
            <p class="section-intro">Pakistan Properties and Builders brings you end-to-end real estate services tailored to meet your property needs.</p>
            <div class="stats-counter">
                <div class="stat-item">
                    <div class="stat-number" data-count="15">0</div>
                    <span class="stat-label">Years of Experience</span>
                </div>
                <div class="stat-item">
                    <div class="stat-number" data-count="10000">0</div>
                    <span class="stat-label">Happy Clients</span>
                </div>
                <div class="stat-item">
                    <div class="stat-number" data-count="5000">0</div>
                    <span class="stat-label">Properties Sold</span>
                </div>
                <div class="stat-item">
                    <div class="stat-number" data-count="98">0</div>
                    <span class="stat-label">Client Satisfaction %</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Services Section -->
    <section id="main-services" class="services">
        <div class="container">
            <h2>Our Premium Services</h2>
            <div class="section-intro">
                <p>Discover our comprehensive range of real estate services designed to meet all your property needs.</p>
            </div>
            <div class="service-tabs">
                <button class="tab-btn active" data-target="all">All Services</button>
                <button class="tab-btn" data-target="buyers">For Buyers</button>
                <button class="tab-btn" data-target="sellers">For Sellers</button>
                <button class="tab-btn" data-target="investors">For Investors</button>
            </div>
            <div class="services-grid">
                <div class="service-card" data-category="buyers sellers">
                    <div class="service-icon"><i class="fas fa-home" aria-hidden="true"></i></div>
                    <div class="service-content">
                        <h3>Property Sales</h3>
                        <p>Find your dream home or investment property in top locations like DHA Lahore and Bahria Town.</p>
                        <ul class="service-features">
                            <li>Residential plots in premium societies</li>
                            <li>Commercial properties in high-growth areas</li>
                            <li>Ready-to-move homes with modern amenities</li>
                            <li>Transparent pricing and documentation</li>
                        </ul>
                        <div class="service-footer">
                            <a href="contact.php" class="service-link">Inquire Now</a>
                            <span class="service-tag">Best Seller</span>
                        </div>
                    </div>
                </div>
                <div class="service-card" data-category="investors">
                    <div class="service-icon"><i class="fas fa-chart-line" aria-hidden="true"></i></div>
                    <div class="service-content">
                        <h3>Investment Consultation</h3>
                        <p>Get expert advice on real estate opportunities in Pakistan's growing markets.</p>
                        <ul class="service-features">
                            <li>Market analysis and trend forecasting</li>
                            <li>ROI calculations for potential investments</li>
                            <li>Portfolio diversification strategies</li>
                            <li>Risk assessment and mitigation plans</li>
                        </ul>
                        <div class="service-footer">
                            <a href="contact.php" class="service-link">Book a Consultation</a>
                            <span class="service-tag">Expert Service</span>
                        </div>
                    </div>
                </div>
                <div class="service-card" data-category="sellers">
                    <div class="service-icon"><i class="fas fa-tasks" aria-hidden="true"></i></div>
                    <div class="service-content">
                        <h3>Property Management</h3>
                        <p>Let us handle your property needs, from rentals to maintenance.</p>
                        <ul class="service-features">
                            <li>Tenant screening and acquisition</li>
                            <li>Rent collection and financial reporting</li>
                            <li>Regular maintenance and emergency repairs</li>
                            <li>Legal compliance and documentation</li>
                        </ul>
                        <div class="service-footer">
                            <a href="contact.php" class="service-link">Learn More</a>
                        </div>
                    </div>
                </div>
                <div class="service-card" data-category="buyers sellers investors">
                    <div class="service-icon"><i class="fas fa-gavel" aria-hidden="true"></i></div>
                    <div class="service-content">
                        <h3>Legal Assistance</h3>
                        <p>Navigate complex property legal matters with expert guidance.</p>
                        <ul class="service-features">
                            <li>Title verification and due diligence</li>
                            <li>Sale deed and agreement preparation</li>
                            <li>Property transfer assistance</li>
                            <li>Regulatory compliance support</li>
                        </ul>
                        <div class="service-footer">
                            <a href="contact.php" class="service-link">Contact Our Legal Team</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="why-choose-us">
        <div class="container">
            <h2>Why Choose Pakistan Properties and Builders?</h2>
            <p class="section-intro">With over 15 years of experience, we deliver exceptional service and expertise.</p>
            <div class="features-grid">
                <div class="feature">
                    <i class="fas fa-medal" aria-hidden="true"></i>
                    <h3>15+ Years Experience</h3>
                    <p>Trusted by thousands with a proven track record.</p>
                </div>
                <div class="feature">
                    <i class="fas fa-handshake" aria-hidden="true"></i>
                    <h3>Personalized Service</h3>
                    <p>Tailored solutions with dedicated managers.</p>
                </div>
                <div class="feature">
                    <i class="fas fa-certificate" aria-hidden="true"></i>
                    <h3>Licensed Professionals</h3>
                    <p>Certified experts in Pakistan's property market.</p>
                </div>
                <div class="feature">
                    <i class="fas fa-map-marked-alt" aria-hidden="true"></i>
                    <h3>Prime Locations</h3>
                    <p>Access to DHA, Bahria Town, and Gulberg.</p>
                </div>
            </div>
            <div class="our-process">
                <h3>Our Simple 4-Step Process</h3>
                <div class="process-steps">
                    <div class="process-step">
                        <div class="step-number">1</div>
                        <div class="step-icon"><i class="fas fa-comments" aria-hidden="true"></i></div>
                        <h4>Consultation</h4>
                        <p>We understand your requirements.</p>
                    </div>
                    <div class="process-step">
                        <div class="step-number">2</div>
                        <div class="step-icon"><i class="fas fa-search" aria-hidden="true"></i></div>
                        <h4>Property Selection</h4>
                        <p>We curate matching properties.</p>
                    </div>
                    <div class="process-step">
                        <div class="step-number">3</div>
                        <div class="step-icon"><i class="fas fa-building" aria-hidden="true"></i></div>
                        <h4>Property Visits</h4>
                        <p>Guided tours with insights.</p>
                    </div>
                    <div class="process-step">
                        <div class="step-number">4</div>
                        <div class="step-icon"><i class="fas fa-file-signature" aria-hidden="true"></i></div>
                        <h4>Seamless Closing</h4>
                        <p>We handle paperwork smoothly.</p>
                    </div>
                </div>
            </div>
            <div class="cta-banner">
                <div class="cta-text">
                    <h3>Ready to find your perfect property?</h3>
                    <p>Schedule a consultation today.</p>
                </div>
                <a href="contact.php" class="btn">Book Consultation</a>
            </div>
        </div>
    </section>

    <!-- Property Map Section -->
    <section class="property-map-section">
        <div class="container">
            <h2>Our Premium Locations</h2>
            <p class="section-intro">Explore prime property locations across Pakistan.</p>
            <div class="map-container">
                <div class="map-selector">
                    <button class="map-tab active" data-city="lahore">Lahore</button>
                    <button class="map-tab" data-city="islamabad">Islamabad</button>
                    <button class="map-tab" data-city="sialkot">Sialkot</button>
                </div>
                <div class="property-map" id="propertyMap">
                    <img src="media/lahore-map.jpg" alt="Map of properties in Lahore" class="city-map active" data-city="lahore">
                    <img src="media/islamabad-map.jpg" alt="Map of properties in Islamabad" class="city-map" data-city="islamabad">
                    <img src="media/sialkot-map.jpg" alt="Map of properties in Sialkot" class="city-map" data-city="sialkot">
                    <div class="map-hotspots lahore-hotspots active" data-city="lahore">
                        <div class="hotspot" data-location="dha" style="top: 40%; left: 30%;">
                            <span class="hotspot-dot"></span>
                            <div class="hotspot-info">
                                <h4>DHA Lahore</h4>
                                <p>Premium residential plots and homes</p>
                                <a href="properties.php?location=dha-lahore" class="hotspot-link">View Properties</a>
                            </div>
                        </div>
                    </div>
                    <div class="map-hotspots islamabad-hotspots" data-city="islamabad"></div>
                    <div class="map-hotspots sialkot-hotspots" data-city="sialkot"></div>
                </div>
                <div class="map-info">
                    <div class="map-city-info active" data-city="lahore">
                        <h3>Lahore Properties</h3>
                        <p>Punjab's capital offers thriving neighborhoods.</p>
                        <ul class="city-highlights">
                            <li><strong>Popular Areas:</strong> DHA, Bahria Town</li>
                            <li><strong>Price Range:</strong> 5M - 100M+ PKR</li>
                        </ul>
                        <a href="properties.php?city=lahore" class="btn btn-sm">Browse Properties</a>
                    </div>
                    <div class="map-city-info" data-city="islamabad">
                        <h3>Islamabad Properties</h3>
                        <p>Modern developments with stunning views.</p>
                        <ul class="city-highlights">
                            <li><strong>Popular Areas:</strong> F-Sectors, DHA</li>
                            <li><strong>Price Range:</strong> 8M - 150M+ PKR</li>
                        </ul>
                        <a href="properties.php?city=islamabad" class="btn btn-sm">Browse Properties</a>
                    </div>
                    <div class="map-city-info" data-city="sialkot">
                        <h3>Sialkot Properties</h3>
                        <p>Growing residential and investment opportunities.</p>
                        <ul class="city-highlights">
                            <li><strong>Popular Areas:</strong> Cantt, Paris Road</li>
                            <li><strong>Price Range:</strong> 3M - 50M+ PKR</li>
                        </ul>
                        <a href="properties.php?city=sialkot" class="btn btn-sm">Browse Properties</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq-section">
        <div class="container">
            <h2>Frequently Asked Questions</h2>
            <div class="faq-container">
                <div class="faq-item">
                    <div class="faq-question" tabindex="0">
                        <h3>What areas do you serve?</h3>
                        <span class="faq-toggle"><i class="fas fa-plus" aria-hidden="true"></i></span>
                    </div>
                    <div class="faq-answer">
                        <p>We focus on Lahore, Islamabad, and Sialkot.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question" tabindex="0">
                        <h3>What types of properties do you offer?</h3>
                        <span class="faq-toggle"><i class="fas fa-plus" aria-hidden="true"></i></span>
                    </div>
                    <div class="faq-answer">
                        <p>Residential plots, commercial properties, and homes in premium locations.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="cta-overlay"></div>
        <div class="container">
            <div class="cta-content">
                <h2>Ready to Find Your Perfect Property?</h2>
                <p>Contact us for personalized real estate services.</p>
                <div class="cta-actions">
                    <a href="contact.php" class="btn btn-primary btn-lg">Contact Us</a>
                    <a href="properties.php" class="btn btn-secondary btn-lg">Browse Properties</a>
                </div>
            </div>
        </div>
    </section>

    <?php include 'footer.php'; ?>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Service Tabs Filtering
            const serviceTabs = document.querySelectorAll('.service-tabs .tab-btn');
            const serviceCards = document.querySelectorAll('.service-card');

            serviceTabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    serviceTabs.forEach(t => t.classList.remove('active'));
                    tab.classList.add('active');

                    const target = tab.getAttribute('data-target');
                    serviceCards.forEach(card => {
                        const categories = card.getAttribute('data-category').split(' ');
                        card.style.display = (target === 'all' || categories.includes(target)) ? 'flex' : 'none';
                    });
                });
            });

            // Trigger "All Services" tab by default
            document.querySelector('.service-tabs .tab-btn[data-target="all"]').click();

            // FAQ Toggle
            const faqQuestions = document.querySelectorAll('.faq-question');
            faqQuestions.forEach(question => {
                question.addEventListener('click', () => {
                    const answer = question.nextElementSibling;
                    const icon = question.querySelector('.faq-toggle i');
                    answer.classList.toggle('active');
                    icon.className = answer.classList.contains('active') ? 'fas fa-minus' : 'fas fa-plus';
                });
            });

            // Property Map Tabs
            const mapTabs = document.querySelectorAll('.map-tab');
            const cityMaps = document.querySelectorAll('.city-map');
            const mapHotspots = document.querySelectorAll('.map-hotspots');
            const cityInfos = document.querySelectorAll('.map-city-info');

            mapTabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    const target = tab.getAttribute('data-city');
                    mapTabs.forEach(t => t.classList.remove('active'));
                    cityMaps.forEach(m => m.classList.remove('active'));
                    mapHotspots.forEach(h => h.classList.remove('active'));
                    cityInfos.forEach(i => i.classList.remove('active'));

                    tab.classList.add('active');
                    document.querySelector(`.city-map[data-city="${target}"]`).classList.add('active');
                    document.querySelector(`.map-hotspots[data-city="${target}"]`).classList.add('active');
                    document.querySelector(`.map-city-info[data-city="${target}"]`).classList.add('active');
                });
            });

            // Map Hotspots
            const hotspots = document.querySelectorAll('.hotspot-dot');
            hotspots.forEach(hotspot => {
                hotspot.addEventListener('click', (e) => {
                    e.stopPropagation();
                    document.querySelectorAll('.hotspot-info').forEach(info => info.classList.remove('active'));
                    hotspot.nextElementSibling.classList.add('active');
                });
            });
            document.addEventListener('click', () => {
                document.querySelectorAll('.hotspot-info').forEach(info => info.classList.remove('active'));
            });

            // Stats Counter Animation
            const statsSection = document.querySelector('.stats-counter');
            const statNumbers = document.querySelectorAll('.stat-number');
            let countersStarted = false;

            function startCounting() {
                if (countersStarted) return;
                statNumbers.forEach(stat => {
                    const target = parseInt(stat.getAttribute('data-count'));
                    let current = 0;
                    const increment = target / 120; // 2 seconds at 60fps
                    const timer = setInterval(() => {
                        current += increment;
                        if (current >= target) {
                            clearInterval(timer);
                            stat.textContent = target.toLocaleString();
                        } else {
                            stat.textContent = Math.floor(current).toLocaleString();
                        }
                    }, 16);
                });
                countersStarted = true;
            }

            function isInViewport(element) {
                const rect = element.getBoundingClientRect();
                return rect.top <= window.innerHeight && rect.bottom >= 0;
            }

            document.addEventListener('scroll', () => {
                if (isInViewport(statsSection)) startCounting();
            });
            if (isInViewport(statsSection)) startCounting();

            // Video Player
            const videoPlay = document.querySelector('.play-button');
            const videoContainer = document.querySelector('.video-container');
            if (videoPlay && videoContainer) {
                videoPlay.addEventListener('click', () => {
                    const videoId = videoContainer.getAttribute('data-video-id');
                    if (!videoId || videoId === 'YOUR_YOUTUBE_ID_HERE') {
                        console.error('Please provide a valid YouTube video ID');
                        return;
                    }
                    const iframe = document.createElement('iframe');
                    iframe.src = `https://www.youtube.com/embed/${videoId}?autoplay=1`;
                    iframe.width = '100%';
                    iframe.height = '100%';
                    iframe.allow = 'autoplay; fullscreen';
                    const placeholder = videoContainer.querySelector('.video-placeholder');
                    placeholder.innerHTML = '';
                    placeholder.appendChild(iframe);
                });
            }
        });
    </script>
</body>
</html>