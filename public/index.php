<?php
include 'header.php';

// Include Parsedown for markdown processing
require_once 'Parsedown.php';
$parsedown = new Parsedown();

// Read the hero markdown file and convert to HTML
$hero_content = file_get_contents('data/hero.md');

// Process markdown content
$processed_content = $parsedown->text($hero_content);
?>

    <!-- Hero Section -->
    <section class="hero">

  <div class="hero-text-overlay">
    <h1>Quality Custom Displays</h1>
    <h2>Architectural millwork and integrated display systems.</h2>
    <h2>Wood, glass, and lighting&mdash;designed, built, and installed.</h2>
  </div>
    </section>


    <!-- Portfolio Section -->
    <?php
    // Load portfolio data from JSON file
    $portfolio_data = json_decode(file_get_contents('data/portfolio.json'), true);

    // Categorize items
    $categories = [
        'Commercial' => [],
        'Residential' => [],
        'Specialized' => []
    ];

    if (isset($portfolio_data['items'])) {
        foreach ($portfolio_data['items'] as $item) {
            $cat = isset($item['category']) ? $item['category'] : 'Specialized';
            if (array_key_exists($cat, $categories)) {
                $categories[$cat][] = $item;
            } else {
                $categories['Specialized'][] = $item; // Default fallback
            }
        }
    }
    ?>
    <section id="portfolio" class="section portfolio">
        <div class="container">

            <div class="portfolio-columns">
                <!-- Commercial Column -->
                <div class="portfolio-column">
                    <h3 class="column-title">Commercial</h3>
                    <div class="column-items">
                        <?php foreach ($categories['Commercial'] as $item): ?>
                            <div class="portfolio-item" data-full-desc="<?php echo htmlspecialchars($item['full_description']); ?>">
                                <img src="<?php echo htmlspecialchars($item['image_url']); ?>" alt="<?php echo htmlspecialchars($item['title']); ?>" class="portfolio-img">
                                <div class="portfolio-text">
                                    <h3><?php echo htmlspecialchars($item['title']); ?></h3>
                                    <p><?php echo htmlspecialchars($item['description']); ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Residential Column -->
                <div class="portfolio-column">
                    <h3 class="column-title">Residential</h3>
                    <div class="column-items">
                        <?php foreach ($categories['Residential'] as $item): ?>
                            <div class="portfolio-item" data-full-desc="<?php echo htmlspecialchars($item['full_description']); ?>">
                                <img src="<?php echo htmlspecialchars($item['image_url']); ?>" alt="<?php echo htmlspecialchars($item['title']); ?>" class="portfolio-img">
                                <div class="portfolio-text">
                                    <h3><?php echo htmlspecialchars($item['title']); ?></h3>
                                    <p><?php echo htmlspecialchars($item['description']); ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Specialized Column -->
                <div class="portfolio-column">
                    <h3 class="column-title">Specialized</h3>
                    <div class="column-items">
                        <?php foreach ($categories['Specialized'] as $item): ?>
                            <div class="portfolio-item" data-full-desc="<?php echo htmlspecialchars($item['full_description']); ?>">
                                <img src="<?php echo htmlspecialchars($item['image_url']); ?>" alt="<?php echo htmlspecialchars($item['title']); ?>" class="portfolio-img">
                                <div class="portfolio-text">
                                    <h3><?php echo htmlspecialchars($item['title']); ?></h3>
                                    <p><?php echo htmlspecialchars($item['description']); ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

        <!-- Modal -->
    <div class="modal" id="imageModal">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <img class="modal-img" id="modalImage" src="" alt="">
            <div class="modal-text">
                <h3 class="modal-title" id="modalTitle"></h3>
                <p class="modal-desc" id="modalDesc"></p>
                <p class="modal-full-desc" id="modalFullDesc"></p>
            </div>
        </div>
    </div>

    <!-- Values Section -->
    <?php
    // Load values data from JSON file
    $values_data = json_decode(file_get_contents('data/values.json'), true);

    // Include Parsedown for markdown processing
    require_once 'Parsedown.php';
    $parsedown = new Parsedown();

    // Process markdown content
    $processed_content = $parsedown->text($values_data['content']);
    ?>
    <section id="values" class="section">
        <div class="container">
            <h2 class="section-title"><?php echo htmlspecialchars($values_data['title']); ?></h2>
            <div class="values-content">
                <div class="values-text">
                    <h2><?php echo htmlspecialchars($values_data['subtitle']); ?></h2>
                    <?php echo $processed_content; ?>
                </div>
                <div class="values-img">
                    <img src="<?php echo htmlspecialchars($values_data['image_url']); ?>" alt="Craftsman working on custom cabinet">
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="section contact">
        <div class="container">
            <h2 class="section-title">Request a Consultation</h2>
            <form id="estimateForm" class="contact-form">
                <div class="form-group">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" id="name" class="form-input" placeholder="Your full name" required>
                </div>
                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" id="email" class="form-input" placeholder="Your email address" required>
                </div>
                <!-- Honeypot field for spam detection -->
                <div class="form-group" style="display: none;">
                    <label for="website">Website</label>
                    <input type="text" id="website" class="form-input" placeholder="How many r's are in strawberry.">
                </div>
                <button type="submit" class="submit-btn" disabled>Submit Request</button>
            </form>
        </div>
    </section>

<?php
include 'footer.php';
?>