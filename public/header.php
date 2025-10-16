<?php
// Load settings from JSON file
$settings_file = __DIR__ . '/data/settings.json';
$settings_data = json_decode(file_get_contents($settings_file), true);

// Set default values if settings are not available
$site_title = !empty($settings_data['site-title']) ? $settings_data['site-title'] : 'Quality Custom Displays';
$site_description = !empty($settings_data['site-description']) ? $settings_data['site-description'] : 'Custom cabinets and displays crafted to perfection. Transform your space with our quality custom-made cabinets and displays designed for your unique needs.';
$contact_email = !empty($settings_data['contact-email']) ? $settings_data['contact-email'] : 'info@qualitycustomdisplays.com';
$phone_number = !empty($settings_data['phone-number']) ? $settings_data['phone-number'] : '(555) 123-4567';
$street_address = !empty($settings_data['street-address']) ? $settings_data['street-address'] : '123 Craftsmanship Ave, Artisanville, CA 94301';
$social_media_card = !empty($settings_data['social-media-card']) ? $settings_data['social-media-card'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($site_title); ?></title>

    <!-- SEO Meta Tags -->
    <meta name="description" content="<?php echo htmlspecialchars($site_description); ?>">
    <meta name="keywords" content="custom cabinets, display cases, built-in furniture, kitchen cabinets, bathroom vanities, office storage, retail displays">
    <meta name="author" content="<?php echo htmlspecialchars($site_title); ?>">
    <meta name="robots" content="index, follow">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="<?php echo htmlspecialchars($site_title . ' - Custom Cabinets & Displays'); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($site_description); ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://www.qualitycustomdisplays.com">
    <?php if (!empty($social_media_card)): ?>
    <meta property="og:image" content="<?php echo htmlspecialchars($social_media_card); ?>">
    <meta property="og:image:alt" content="Custom cabinet and display craftsmanship">
    <?php else: ?>
    <meta property="og:image" content="https://images.unsplash.com/photo-1586023492125-27b2c045efd7?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&h=630&q=80">
    <meta property="og:image:alt" content="Custom cabinet and display craftsmanship">
    <?php endif; ?>
    <meta property="og:site_name" content="<?php echo htmlspecialchars($site_title); ?>">
    <meta property="og:locale" content="en_US">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo htmlspecialchars($site_title . ' - Custom Cabinets & Displays'); ?>">
    <meta name="twitter:description" content="<?php echo htmlspecialchars($site_description); ?>">
    <?php if (!empty($social_media_card)): ?>
    <meta name="twitter:image" content="<?php echo htmlspecialchars($social_media_card); ?>">
    <?php else: ?>
    <meta name="twitter:image" content="https://images.unsplash.com/photo-1586023492125-27b2c045efd7?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&h=630&q=80">
    <?php endif; ?>
    <meta name="twitter:image:alt" content="Custom cabinet and display craftsmanship">

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <style>
        <?php
        echo file_get_contents('./style.css');
        ?>
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container nav-container">
            <a href="#" class="logo">QualityCustom<span>Displays</span></a>
            <button class="hamburger" id="hamburger">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-menu-icon lucide-menu"><path d="M4 12h16"/><path d="M4 18h16"/><path d="M4 6h16"/></svg>
            </button>
            <ul class="nav-menu" id="navMenu">
                <li><a href="#about">About</a></li>
                <li><a href="#portfolio">Portfolio</a></li>
                <li><a href="#testimonials">Testimonials</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </div>
    </header>