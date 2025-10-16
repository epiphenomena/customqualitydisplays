<?php
// Load settings from JSON file if not already loaded
if (!isset($settings_data)) {
    $settings_file = __DIR__ . '/data/settings.json';
    $settings_data = json_decode(file_get_contents($settings_file), true);
}
?>

<footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-about">
                    <div class="footer-logo">QualityCustom<span>Displays</span></div>
                    <p>Custom Cabinets & Displays Crafted to Perfection</p>
                </div>
                <div class="footer-links">
                    <h3 class="footer-heading">Quick Links</h3>
                    <ul>
                        <li><a href="#about">About Us</a></li>
                        <li><a href="#portfolio">Our Work</a></li>
                        <li><a href="#testimonials">Testimonials</a></li>
                        <li><a href="#contact">Get Estimate</a></li>
                    </ul>
                </div>
                <div class="footer-contact">
                    <h3 class="footer-heading">Contact Us</h3>
                    <p><?php echo htmlspecialchars($settings_data['street-address']); ?></p>
                    <p>Phone: <?php echo htmlspecialchars($settings_data['phone-number']); ?></p>
                    <p>Email: <a href="mailto:<?php echo htmlspecialchars($settings_data['contact-email']); ?>" id="contactEmail"><?php echo htmlspecialchars($settings_data['contact-email']); ?></a></p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 Quality Custom Displays. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        <?php
        echo file_get_contents('./script.js');
        ?>
    </script>
</body>
</html>