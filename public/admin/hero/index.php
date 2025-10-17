<?php
$title = "Hero Section - Quality Custom Displays";

// Define the hero content file path
$hero_file = __DIR__ . '/../../data/hero.md';

// Process form submission if POST data is present
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $hero_content = $_POST['hero-content'];
    
    // Ensure data directory exists
    $data_dir = __DIR__ . '/../../data/';
    if (!is_dir($data_dir)) {
        mkdir($data_dir, 0755, true);
    }

    // Save hero content to markdown file
    file_put_contents($hero_file, $hero_content);
}

// Load hero content from markdown file
$hero_content = file_exists($hero_file) ? file_get_contents($hero_file) : '';

include '../header.php';
?>

<main>
    <div class="container">
        <h1>Hero Section Content</h1>
        <p>Edit the content that appears in the hero section of the homepage.</p>

        <form method="post" id="hero-form">
            <div class="form-group">
                <label for="hero-content">Hero Content (Markdown)</label>
                <textarea id="hero-content" name="hero-content" rows="15" class="markdown-editor" placeholder="Enter hero section content in Markdown format..."><?php echo htmlspecialchars($hero_content); ?></textarea>
                <small class="form-help">Use Markdown syntax for formatting. Supports headers, paragraphs, links, and other basic formatting.</small>
            </div>

            <button type="submit" class="btn btn-primary">Save Hero Content</button>
        </form>
    </div>
</main>

<?php
include '../footer.php';
?>