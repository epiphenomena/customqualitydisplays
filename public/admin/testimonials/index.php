<?php
$title = "Testimonials - Quality Custom Displays";

// Include image utility functions
require_once __DIR__ . '/../image_utils.php';

// Define the testimonials file path
$testimonials_file = __DIR__ . '/../../data/testimonials.json';

// Load testimonials data from JSON file
$testimonials_data = json_decode(file_get_contents($testimonials_file), true);
$testimonials = $testimonials_data;

// Process form submission if POST data is present
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'add' || $_POST['action'] === 'edit') {
            $item_id = $_POST['item_id'] ?? null;
            $new_item = [
                'text' => $_POST['text'],
                'author_name' => $_POST['author_name'],
                'author_role' => $_POST['author_role']
            ];

            // Handle testimonial author image upload
            $new_image_path = handle_image_upload('author_image', 'testimonial-author', 'testimonial author');
            if ($new_image_path) {
                $new_item['author_image_url'] = $new_image_path;
                
                // If editing and there was an old image, remove it
                if ($item_id !== null && isset($_POST['old_image']) && !empty($_POST['old_image']) && $_POST['old_image'] !== $new_image_path) {
                    remove_image_file($_POST['old_image']);
                }
            } else {
                // If no new image uploaded but there was an old one, keep it
                if ($item_id !== null && isset($_POST['old_image'])) {
                    $new_item['author_image_url'] = $_POST['old_image'];
                } else {
                    // Use a default image if no image is provided
                    $new_item['author_image_url'] = 'https://randomuser.me/api/portraits/men/1.jpg';
                }
            }
            
            if ($_POST['action'] === 'add') {
                // Add new item to the end of the array
                $testimonials['items'][] = $new_item;
            } else {
                // Update existing item
                $testimonials['items'][$item_id] = $new_item;
            }
        } elseif ($_POST['action'] === 'delete') {
            $item_id = $_POST['item_id'];
            if (isset($testimonials['items'][$item_id])) {
                // Remove the image file if it exists
                if (!empty($testimonials['items'][$item_id]['author_image_url']) && 
                    strpos($testimonials['items'][$item_id]['author_image_url'], 'https://randomuser.me/api/portraits/') !== 0) {
                    remove_image_file($testimonials['items'][$item_id]['author_image_url']);
                }
                // Remove the testimonial item
                array_splice($testimonials['items'], $item_id, 1);
            }
        } elseif ($_POST['action'] === 'move_up' || $_POST['action'] === 'move_down') {
            $item_id = $_POST['item_id'];
            if (isset($testimonials['items'][$item_id])) {
                $items = &$testimonials['items'];
                $count = count($items);
                
                if ($_POST['action'] === 'move_up' && $item_id > 0) {
                    // Swap with the previous item
                    $temp = $items[$item_id - 1];
                    $items[$item_id - 1] = $items[$item_id];
                    $items[$item_id] = $temp;
                } elseif ($_POST['action'] === 'move_down' && $item_id < $count - 1) {
                    // Swap with the next item
                    $temp = $items[$item_id + 1];
                    $items[$item_id + 1] = $items[$item_id];
                    $items[$item_id] = $temp;
                }
            }
        }
    }

    // Ensure data directory exists
    $data_dir = __DIR__ . '/../../data/';
    if (!is_dir($data_dir)) {
        mkdir($data_dir, 0755, true);
    }

    // Save testimonials to JSON file
    file_put_contents($testimonials_file, json_encode($testimonials, JSON_PRETTY_PRINT));

    // Refresh testimonials after saving
    $testimonials_data = json_decode(file_get_contents($testimonials_file), true);
    $testimonials = $testimonials_data;
}

include '../header.php';
?>

<main>
    <div class="container">
        <h1>Testimonials Management</h1>
        <p>Manage testimonials that appear in the testimonials section.</p>

        <div class="admin-content-wrapper">
            <!-- Testimonials Items List -->
            <div class="testimonials-admin-list">
                <h2>Current Testimonials</h2>
                <?php if (!empty($testimonials['items'])): ?>
                    <div class="testimonials-items-container">
                        <?php foreach ($testimonials['items'] as $index => $item): ?>
                            <div class="testimonial-item-admin">
                                <div class="testimonial-item-info">
                                    <p>"<?php echo htmlspecialchars(substr($item['text'], 0, 100)); ?><?php echo strlen($item['text']) > 100 ? '...' : ''; ?>"</p>
                                    <p><strong><?php echo htmlspecialchars($item['author_name']); ?></strong> - <?php echo htmlspecialchars($item['author_role']); ?></p>
                                </div>
                                <div class="testimonial-item-actions">
                                    <?php if ($index > 0): ?>
                                        <form method="post" style="display:inline;">
                                            <input type="hidden" name="action" value="move_up">
                                            <input type="hidden" name="item_id" value="<?php echo $index; ?>">
                                            <button type="submit" class="btn btn-secondary btn-sm">↑ Move Up</button>
                                        </form>
                                    <?php endif; ?>
                                    <?php if ($index < count($testimonials['items']) - 1): ?>
                                        <form method="post" style="display:inline;">
                                            <input type="hidden" name="action" value="move_down">
                                            <input type="hidden" name="item_id" value="<?php echo $index; ?>">
                                            <button type="submit" class="btn btn-secondary btn-sm">↓ Move Down</button>
                                        </form>
                                    <?php endif; ?>
                                    <button type="button" class="btn btn-primary btn-sm edit-btn" data-index="<?php echo $index; ?>">Edit</button>
                                    <form method="post" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this testimonial?');">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="item_id" value="<?php echo $index; ?>">
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p>No testimonials yet.</p>
                <?php endif; ?>
            </div>

            <!-- Add/Edit Form -->
            <div class="testimonial-form-container">
                <h2 id="form-title">Add New Testimonial</h2>
                <form method="post" enctype="multipart/form-data" id="testimonial-form">
                    <input type="hidden" name="action" value="add" id="form-action">
                    <input type="hidden" name="item_id" value="" id="item-id">
                    <input type="hidden" name="old_image" value="" id="old-image">
                    
                    <div class="form-group">
                        <label for="text">Testimonial Text</label>
                        <textarea id="text" name="text" placeholder="Enter the testimonial text" rows="5" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="author_name">Author Name</label>
                        <input type="text" id="author_name" name="author_name" placeholder="Author name" required>
                    </div>

                    <div class="form-group">
                        <label for="author_role">Author Role</label>
                        <input type="text" id="author_role" name="author_role" placeholder="Author role (e.g., Homeowner, Boutique Owner)">
                    </div>

                    <div class="form-group">
                        <label for="author_image">Author Image</label>
                        <input type="file" id="author_image" name="author_image" accept="image/*">
                        <small class="form-help">Upload an image for the testimonial author. Recommended square dimensions.</small>
                        <div id="current-image-container" style="display:none;">
                            <p>Current image:</p>
                            <img id="current-image" src="" alt="Current testimonial author image" style="max-width: 100px; max-height: 100px; border-radius: 50%;">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Save Testimonial</button>
                    <button type="button" class="btn btn-secondary" id="cancel-edit" style="display:none;">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</main>

<script>
    // Handle edit button clicks
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function() {
            const index = this.getAttribute('data-index');
            const testimonialItems = <?php echo json_encode($testimonials['items']); ?>;
            const item = testimonialItems[index];
            
            document.getElementById('form-title').textContent = 'Edit Testimonial';
            document.getElementById('form-action').value = 'edit';
            document.getElementById('item-id').value = index;
            document.getElementById('text').value = item.text || '';
            document.getElementById('author_name').value = item.author_name || '';
            document.getElementById('author_role').value = item.author_role || '';
            
            // Handle current image display
            if (item.author_image_url) {
                document.getElementById('current-image').src = item.author_image_url;
                document.getElementById('current-image-container').style.display = 'block';
                document.getElementById('old-image').value = item.author_image_url;
            } else {
                document.getElementById('current-image-container').style.display = 'none';
                document.getElementById('old-image').value = '';
            }
            
            document.getElementById('cancel-edit').style.display = 'inline-block';
        });
    });
    
    // Handle cancel edit button
    document.getElementById('cancel-edit').addEventListener('click', function() {
        document.getElementById('form-title').textContent = 'Add New Testimonial';
        document.getElementById('form-action').value = 'add';
        document.getElementById('item-id').value = '';
        document.getElementById('text').value = '';
        document.getElementById('author_name').value = '';
        document.getElementById('author_role').value = '';
        document.getElementById('author_image').value = '';
        document.getElementById('current-image-container').style.display = 'none';
        document.getElementById('cancel-edit').style.display = 'none';
    });
</script>

<?php
include '../footer.php';
?>