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
        <div class="container hero-content">
            <?php echo $processed_content; ?>
        </div>
    </section>

    <!-- About Section -->
    <?php
    // Load about data from JSON file
    $about_data = json_decode(file_get_contents('data/about.json'), true);
    
    // Include Parsedown for markdown processing
    require_once 'Parsedown.php';
    $parsedown = new Parsedown();
    
    // Process markdown content
    $processed_content = $parsedown->text($about_data['content']);
    ?>
    <section id="about" class="section">
        <div class="container">
            <h2 class="section-title"><?php echo htmlspecialchars($about_data['title']); ?></h2>
            <div class="about-content">
                <div class="about-text">
                    <h2><?php echo htmlspecialchars($about_data['subtitle']); ?></h2>
                    <?php echo $processed_content; ?>
                </div>
                <div class="about-img">
                    <img src="<?php echo htmlspecialchars($about_data['image_url']); ?>" alt="Craftsman working on custom cabinet">
                </div>
            </div>
        </div>
    </section>

    <!-- Portfolio Section -->
    <?php
    // Load portfolio data from JSON file
    $portfolio_data = json_decode(file_get_contents('data/portfolio.json'), true);
    ?>
    <section id="portfolio" class="section portfolio">
        <div class="container">
            <h2 class="section-title"><?php echo htmlspecialchars($portfolio_data['title']); ?></h2>
            <div class="portfolio-grid">
                <!-- Portfolio Items -->
                <?php foreach ($portfolio_data['items'] as $item): ?>
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

    <!-- Testimonials Section -->
    <?php
    // Load testimonials data from JSON file
    $testimonials_data = json_decode(file_get_contents('data/testimonials.json'), true);
    ?>
    <section id="testimonials" class="section testimonials">
        <div class="container">
            <h2 class="section-title"><?php echo htmlspecialchars($testimonials_data['title']); ?></h2>
            <div class="testimonial-grid">
                <?php foreach ($testimonials_data['items'] as $item): ?>
                <div class="testimonial">
                    <p class="testimonial-text">"<?php echo htmlspecialchars($item['text']); ?>"</p>
                    <div class="testimonial-author">
                        <img src="<?php echo htmlspecialchars($item['author_image_url']); ?>" alt="<?php echo htmlspecialchars($item['author_name']); ?>" class="author-img">
                        <div class="author-info">
                            <h4><?php echo htmlspecialchars($item['author_name']); ?></h4>
                            <p><?php echo htmlspecialchars($item['author_role']); ?></p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="section contact">
        <div class="container">
            <h2 class="section-title">Request an Estimate</h2>
            <form id="estimateForm" class="contact-form">
                <div class="form-group">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" id="name" class="form-input" placeholder="Your full name" required>
                </div>
                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" id="email" class="form-input" placeholder="Your email address" required>
                </div>
                <div class="form-group">
                    <label for="phone" class="form-label">Phone Number (Optional)</label>
                    <input type="tel" id="phone" class="form-input" placeholder="Your phone number">
                </div>
                <div class="form-group">
                    <label for="project" class="form-label">Project Description</label>
                    <textarea id="project" class="form-input" placeholder="Tell us about your project needs, dimensions, and any specific requirements" required></textarea>
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