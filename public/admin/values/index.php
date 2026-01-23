<?php
$title = "Values Section - Quality Custom Displays";

// Include image utility functions
require_once __DIR__ . '/../image_utils.php';

// Define the values file path
$values_file = __DIR__ . '/../../data/values.json';

// Load values data from JSON file
$values_data = json_decode(file_get_contents($values_file), true);
$values = $values_data;

// Process form submission if POST data is present
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $values['title'] = $_POST['title'];
    $values['subtitle'] = $_POST['subtitle'];
    $values['content'] = $_POST['content'];

    // Handle values section image upload
    $new_image_path = handle_image_upload('image', 'values-section', 'values section');
    if ($new_image_path) {
        // Remove old image if it exists and is different from the new one
        if (!empty($values['image_url']) && $values['image_url'] !== $new_image_path) {
            remove_image_file($values['image_url']);
        }
        $values['image_url'] = $new_image_path;
    } elseif (isset($_POST['remove-image']) && $_POST['remove-image'] === '1') {
        // Remove existing image if requested
        if (!empty($values['image_url'])) {
            remove_image_file($values['image_url']);
            $values['image_url'] = '';
        }
    }

    // Ensure data directory exists
    $data_dir = __DIR__ . '/../../data/';
    if (!is_dir($data_dir)) {
        mkdir($data_dir, 0755, true);
    }

    // Save values data to JSON file
    file_put_contents($values_file, json_encode($values, JSON_PRETTY_PRINT));

    // Refresh values data after saving
    $values_data = json_decode(file_get_contents($values_file), true);
    $values = $values_data;
}

include '../header.php';
?>

<main>
    <div class="container">
        <h1>Values Section Content</h1>
        <p>Edit the content that appears in the values section of the homepage.</p>

        <form method="post" enctype="multipart/form-data" id="values-form">
            <div class="form-group">
                <label for="title">Section Title</label>
                <input type="text" id="title" name="title" placeholder="Our Values" value="<?php echo htmlspecialchars($values['title']); ?>">
            </div>

            <div class="form-group">
                <label for="subtitle">Subtitle</label>
                <input type="text" id="subtitle" name="subtitle" placeholder="Precision Craftsmanship Meets Innovative Design" value="<?php echo htmlspecialchars($values['subtitle']); ?>">
            </div>

            <div class="form-group">
                <label for="content">Content (Markdown)</label>
                <textarea id="content" name="content" placeholder="Values section content in markdown..." rows="10"><?php echo htmlspecialchars($values['content']); ?></textarea>
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
                <label for="image">Values Section Image</label>
                <input type="file" id="image" name="image" accept="image/*">
                <small class="form-help">Upload an image for the values section (JPG, PNG). Recommended size: 600x400 pixels.</small>

                <?php if (!empty($values['image_url'])): ?>
                    <div class="image-preview">
                        <p>Current image:</p>
                        <img src="/<?php echo $values['image_url']; ?>" alt="Current values image" style="max-width: 300px; max-height: 200px;">
                        <div>
                            <button type="submit" name="remove-image" value="1" class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure you want to remove this image?')">Remove Image</button>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="image-preview">
                        <p>Current image:</p>
                        <img src="" alt="Values section image preview" style="max-width: 300px; max-height: 200px; display: none;">
                    </div>
                <?php endif; ?>
            </div>

            <button type="submit" class="btn btn-primary">Save Values Section</button>
        </form>
    </div>
</main>

<?php
include '../footer.php';
?>