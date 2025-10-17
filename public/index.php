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
    <section id="about" class="section">
        <div class="container">
            <h2 class="section-title">About Us</h2>
            <div class="about-content">
                <div class="about-text">
                    <h2>Precision Craftsmanship Meets Innovative Design</h2>
                    <p>At Quality Custom Displays, we create custom cabinets and displays that perfectly blend functionality with aesthetic appeal. With over 15 years of experience, our master craftsmen pay attention to every detail to deliver exceptional quality.</p>
                    <p>We work with a variety of materials including hardwoods, glass, and metal to create pieces that reflect your style while serving your practical needs.</p>
                    <ul class="about-features">
                        <li>Custom designed to your specifications</li>
                        <li>Premium quality materials</li>
                        <li>Expert craftsmanship</li>
                        <li>On-time completion</li>
                        <li>Installation included</li>
                    </ul>
                </div>
                <div class="about-img">
                    <img src="https://images.unsplash.com/photo-1601760561441-16420502c7e0?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&h=400&q=80" alt="Craftsman working on custom cabinet">
                </div>
            </div>
        </div>
    </section>

    <!-- Portfolio Section -->
    <section id="portfolio" class="section portfolio">
        <div class="container">
            <h2 class="section-title">Our Work</h2>
            <div class="portfolio-grid">
                <!-- Portfolio Items -->
                <div class="portfolio-item" data-category="cabinets kitchen" data-full-desc="These modern kitchen cabinets feature a classic shaker style design with a crisp white finish. We incorporated soft-close hinges and drawers for quiet operation. The custom pull-out organizers include spice racks, utensil dividers, and a dedicated storage space for cutting boards and baking sheets. Crafted from premium maple wood with a durable lacquer finish.">
                    <img src="https://1.bp.blogspot.com/_sl24j8YCPIM/TNgDiIRiW3I/AAAAAAAAAbU/5rIco_H-dn4/s1600/Trade_show_display_Alumalite.jpg" alt="Modern kitchen cabinets" class="portfolio-img">
                    <div class="portfolio-text">
                        <h3>Modern Kitchen Cabinets</h3>
                        <p>White shaker style cabinets with soft-close hinges and custom pull-out organizers.</p>
                    </div>
                </div>
                <div class="portfolio-item" data-category="cabinets office" data-full-desc="This home office storage solution features built-in cabinets that maximize vertical space. The design includes file storage drawers, adjustable shelving for books and decor, and closed cabinets for hiding office supplies. Finished with a rich walnut stain and matte protective coating.">
                    <img src="https://images.unsplash.com/photo-1595428774223-ef52624120d2?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&h=400&q=80" alt="Office storage cabinets" class="portfolio-img">
                    <div class="portfolio-text">
                        <h3>Office Storage Solution</h3>
                        <p>Custom built-in cabinets for home office with file storage and display shelves.</p>
                    </div>
                </div>
                <div class="portfolio-item" data-category="cabinets" data-full-desc="This floating bathroom vanity provides a modern, spacious feel to the bathroom. Crafted from solid oak with a natural oil finish that highlights the wood grain. Features include a marble countertop with an integrated sink, two soft-close drawers, and open shelving for towel storage.">
                    <img src="https://images.unsplash.com/photo-1581539250439-c96689b516dd?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&h=400&q=80" alt="Bathroom vanity" class="portfolio-img">
                    <div class="portfolio-text">
                        <h3>Custom Bathroom Vanity</h3>
                        <p>Floating vanity with natural wood finish and marble countertop.</p>
                    </div>
                </div>

                <!-- Display Items -->
                <div class="portfolio-item" data-category="displays" data-full-desc="This retail display case was designed for a jewelry store, featuring tempered glass on all sides for maximum visibility. The integrated LED lighting provides perfect illumination for the products. The case includes locking doors and adjustable glass shelves to accommodate various product sizes.">
                    <img src="https://www.tradeshowdisplaysandexhibits.com/wp-content/uploads/2019/07/Buddy-phones.jpg" alt="Retail display case" class="portfolio-img">
                    <div class="portfolio-text">
                        <h3>Retail Display Case</h3>
                        <p>Custom glass display case with integrated lighting for retail store.</p>
                    </div>
                </div>
                <div class="portfolio-item" data-category="displays" data-full-desc="This built-in bookcase transforms an entire wall into a functional storage and display area. Features include adjustable shelves to accommodate books of different sizes, cabinet bases with hidden storage, and crown molding that matches the room's existing trim. Finished with a custom mixed paint color to match the client's decor.">
                    <img src="https://i.pinimg.com/originals/2c/f0/0a/2cf00acd102e161fa7180d8fe6a91252.png" alt="Bookcase wall unit" class="portfolio-img">
                    <div class="portfolio-text">
                        <h3>Built-in Bookcase</h3>
                        <p>Floor-to-ceiling bookcase with adjustable shelves and cabinet storage.</p>
                    </div>
                </div>
                <div class="portfolio-item" data-category="displays kitchen" data-full-desc="These open kitchen shelves provide both functionality and aesthetic appeal. Crafted from reclaimed barn wood with custom forged steel brackets. The shelves are perfect for displaying beautiful dishware while keeping everyday items within easy reach. Finished with a food-safe sealant for durability.">
                    <img src="https://images.unsplash.com/photo-1600566752355-35792bedcfea?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&h=400&q=80" alt="Kitchen display shelves" class="portfolio-img">
                    <div class="portfolio-text">
                        <h3>Kitchen Display Shelving</h3>
                        <p>Open shelving with custom brackets for displaying kitchenware.</p>
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

    <!-- Testimonials Section -->
    <section id="testimonials" class="section testimonials">
        <div class="container">
            <h2 class="section-title">What Our Clients Say</h2>
            <div class="testimonial-grid">
                <div class="testimonial">
                    <p class="testimonial-text">"The custom cabinets ArtisanCraft created for our kitchen completely transformed the space. The quality is exceptional and the attention to detail is remarkable."</p>
                    <div class="testimonial-author">
                        <img src="https://randomuser.me/api/portraits/women/65.jpg" alt="Sarah Johnson" class="author-img">
                        <div class="author-info">
                            <h4>Sarah Johnson</h4>
                            <p>Homeowner</p>
                        </div>
                    </div>
                </div>
                <div class="testimonial">
                    <p class="testimonial-text">"We needed custom displays for our retail store and ArtisanCraft delivered beyond our expectations. The displays are both functional and beautiful."</p>
                    <div class="testimonial-author">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Michael Chen" class="author-img">
                        <div class="author-info">
                            <h4>Michael Chen</h4>
                            <p>Boutique Owner</p>
                        </div>
                    </div>
                </div>
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