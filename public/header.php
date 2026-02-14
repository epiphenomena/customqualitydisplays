<?php
// Load settings from JSON file
$settings_file = __DIR__ . '/data/settings.json';
$settings_data = json_decode(file_get_contents($settings_file), true);

// Extract settings values (these should exist in the JSON file)
$site_title = $settings_data['site-title'];
$site_description = $settings_data['site-description'];
$contact_email = $settings_data['contact-email'];
$phone_number = $settings_data['phone-number'];
$street_address = $settings_data['street-address'];
$social_media_card = $settings_data['social-media-card'];
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
    <meta property="og:title" content="<?php echo htmlspecialchars($site_title); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($site_description); ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://www.qualitycustomdisplays.com">
    <?php if (!empty($social_media_card)): ?>
    <meta property="og:image" content="<?php echo htmlspecialchars($social_media_card); ?>">
    <meta property="og:image:alt" content="Custom cabinet and display craftsmanship">
    <?php else: ?>
    <meta property="og:image" content="<?php echo htmlspecialchars($social_media_card); ?>">
    <?php endif; ?>
    <meta property="og:site_name" content="<?php echo htmlspecialchars($site_title); ?>">
    <meta property="og:locale" content="en_US">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo htmlspecialchars($site_title . ' - Custom Cabinets & Displays'); ?>">
    <meta name="twitter:description" content="<?php echo htmlspecialchars($site_description); ?>">
    <meta name="twitter:image" content="<?php echo htmlspecialchars($social_media_card); ?>">
    <meta name="twitter:image:alt" content="Custom cabinet and display craftsmanship">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Marcellus&display=swap" rel="stylesheet">

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

    </header>