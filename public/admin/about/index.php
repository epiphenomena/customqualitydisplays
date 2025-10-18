<?php
$title = "About Section - Quality Custom Displays";

// Include image utility functions
require_once __DIR__ . '/../image_utils.php';

// Define the about file path
$about_file = __DIR__ . '/../../data/about.json';

// Load about data from JSON file
$about_data = json_decode(file_get_contents($about_file), true);
$about = $about_data;

// Process form submission if POST data is present
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $about['title'] = $_POST['title'];
    $about['subtitle'] = $_POST['subtitle'];
    $about['content'] = $_POST['content'];

    // Handle about section image upload
    $new_image_path = handle_image_upload('image', 'about-section', 'about section');
    if ($new_image_path) {
        // Remove old image if it exists and is different from the new one
        if (!empty($about['image_url']) && $about['image_url'] !== $new_image_path) {
            remove_image_file($about['image_url']);
        }
        $about['image_url'] = $new_image_path;
    } elseif (isset($_POST['remove-image']) && $_POST['remove-image'] === '1') {
        // Remove existing image if requested
        if (!empty($about['image_url'])) {
            remove_image_file($about['image_url']);
            $about['image_url'] = '';
        }
    }

    // Ensure data directory exists
    $data_dir = __DIR__ . '/../../data/';
    if (!is_dir($data_dir)) {
        mkdir($data_dir, 0755, true);
    }

    // Save about data to JSON file
    file_put_contents($about_file, json_encode($about, JSON_PRETTY_PRINT));

    // Refresh about data after saving
    $about_data = json_decode(file_get_contents($about_file), true);
    $about = $about_data;
}

include '../header.php';
?>

<main>
    <div class="container">
        <h1>About Section Content</h1>
        <p>Edit the content that appears in the about section of the homepage.</p>

        <form method="post" enctype="multipart/form-data" id="about-form">
            <div class="form-group">
                <label for="title">Section Title</label>
                <input type="text" id="title" name="title" placeholder="About Us" value="<?php echo htmlspecialchars($about['title']); ?>">
            </div>

            <div class="form-group">
                <label for="subtitle">Subtitle</label>
                <input type="text" id="subtitle" name="subtitle" placeholder="Precision Craftsmanship Meets Innovative Design" value="<?php echo htmlspecialchars($about['subtitle']); ?>">
            </div>

            <div class="form-group">
                <label for="content">Content (Markdown)</label>
                <textarea id="content" name="content" placeholder="About section content in markdown..." rows="10"><?php echo htmlspecialchars($about['content']); ?></textarea>
                <small class="form-help">Use markdown formatting for paragraphs and lists</small>
                
                <div class="markdown-example">
                    <h3>Markdown Formatting Help</h3>
                    <pre><code>
# Headers
This is a paragraph.

- List item 1
- List item 2
- List item 3
                    </code></pre>
                </div>
            </div>

            <div class="form-group">
                <label for="image">About Section Image</label>
                <input type="file" id="image" name="image" accept="image/*">
                <small class="form-help">Upload an image for the about section (JPG, PNG). Recommended size: 600x400 pixels.</small>

                <?php if (!empty($about['image_url'])): ?>
                    <div class="image-preview">
                        <p>Current image:</p>
                        <img src="<?php echo $about['image_url']; ?>" alt="Current about image" style="max-width: 300px; max-height: 200px;">
                        <div>
                            <button type="submit" name="remove-image" value="1" class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure you want to remove this image?')">Remove Image</button>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="image-preview">
                        <p>Current image:</p>
                        <img src="" alt="About section image preview" style="max-width: 300px; max-height: 200px; display: none;">
                    </div>
                <?php endif; ?>
            </div>

            <button type="submit" class="btn btn-primary">Save About Section</button>
        </form>
    </div>
</main>

<?php
include '../footer.php';
?>