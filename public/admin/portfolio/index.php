<?php
$title = "Portfolio - Quality Custom Displays";

// Include image utility functions
require_once __DIR__ . '/../image_utils.php';

// Define the portfolio file path
$portfolio_file = __DIR__ . '/../../data/portfolio.json';

// Load portfolio data from JSON file
$portfolio_data = json_decode(file_get_contents($portfolio_file), true);
$portfolio = $portfolio_data;

// Process form submission if POST data is present
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'add' || $_POST['action'] === 'edit') {
            $item_id = $_POST['item_id'] ?? null;
            $new_item = [
                'title' => $_POST['title'],
                'description' => $_POST['description'],
                'full_description' => $_POST['full_description']
            ];

            // Handle portfolio item image upload
            $new_image_path = handle_image_upload('image', 'portfolio-item', 'portfolio item');
            if ($new_image_path) {
                $new_item['image_url'] = $new_image_path;
                
                // If editing and there was an old image, remove it
                if ($item_id !== null && isset($_POST['old_image']) && !empty($_POST['old_image']) && $_POST['old_image'] !== $new_image_path) {
                    remove_image_file($_POST['old_image']);
                }
            } else {
                // If no new image uploaded but there was an old one, keep it
                if ($item_id !== null && isset($_POST['old_image'])) {
                    $new_item['image_url'] = $_POST['old_image'];
                }
            }
            
            if ($_POST['action'] === 'add') {
                // Add new item to the end of the array
                $portfolio['items'][] = $new_item;
            } else {
                // Update existing item
                $portfolio['items'][$item_id] = $new_item;
            }
        } elseif ($_POST['action'] === 'delete') {
            $item_id = $_POST['item_id'];
            if (isset($portfolio['items'][$item_id])) {
                // Remove the image file if it exists
                if (!empty($portfolio['items'][$item_id]['image_url'])) {
                    remove_image_file($portfolio['items'][$item_id]['image_url']);
                }
                // Remove the portfolio item
                array_splice($portfolio['items'], $item_id, 1);
            }
        } elseif ($_POST['action'] === 'move_up' || $_POST['action'] === 'move_down') {
            $item_id = $_POST['item_id'];
            if (isset($portfolio['items'][$item_id])) {
                $items = &$portfolio['items'];
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

    // Save portfolio to JSON file
    file_put_contents($portfolio_file, json_encode($portfolio, JSON_PRETTY_PRINT));

    // Refresh portfolio after saving
    $portfolio_data = json_decode(file_get_contents($portfolio_file), true);
    $portfolio = $portfolio_data;
}

include '../header.php';
?>

<main>
    <div class="container">
        <h1>Portfolio Management</h1>
        <p>Manage portfolio items that appear in the Our Work section.</p>

        <div class="admin-content-wrapper">
            <!-- Portfolio Items List -->
            <div class="portfolio-admin-list">
                <h2>Current Portfolio Items</h2>
                <?php if (!empty($portfolio['items'])): ?>
                    <div class="portfolio-items-container">
                        <?php foreach ($portfolio['items'] as $index => $item): ?>
                            <div class="portfolio-item-admin">
                                <div class="portfolio-item-info">
                                    <h3><?php echo htmlspecialchars($item['title']); ?></h3>
                                    <p><?php echo htmlspecialchars($item['description']); ?></p>
                                </div>
                                <div class="portfolio-item-actions">
                                    <?php if ($index > 0): ?>
                                        <form method="post" style="display:inline;">
                                            <input type="hidden" name="action" value="move_up">
                                            <input type="hidden" name="item_id" value="<?php echo $index; ?>">
                                            <button type="submit" class="btn btn-secondary btn-sm">↑ Move Up</button>
                                        </form>
                                    <?php endif; ?>
                                    <?php if ($index < count($portfolio['items']) - 1): ?>
                                        <form method="post" style="display:inline;">
                                            <input type="hidden" name="action" value="move_down">
                                            <input type="hidden" name="item_id" value="<?php echo $index; ?>">
                                            <button type="submit" class="btn btn-secondary btn-sm">↓ Move Down</button>
                                        </form>
                                    <?php endif; ?>
                                    <button type="button" class="btn btn-primary btn-sm edit-btn" data-index="<?php echo $index; ?>">Edit</button>
                                    <form method="post" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this portfolio item?');">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="item_id" value="<?php echo $index; ?>">
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p>No portfolio items yet.</p>
                <?php endif; ?>
            </div>

            <!-- Add/Edit Form -->
            <div class="portfolio-form-container">
                <h2 id="form-title">Add New Portfolio Item</h2>
                <form method="post" enctype="multipart/form-data" id="portfolio-form">
                    <input type="hidden" name="action" value="add" id="form-action">
                    <input type="hidden" name="item_id" value="" id="item-id">
                    <input type="hidden" name="old_image" value="" id="old-image">
                    
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" id="title" name="title" placeholder="Project title" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" placeholder="Brief project description" rows="3" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="full_description">Full Description</label>
                        <textarea id="full_description" name="full_description" placeholder="Detailed project description" rows="5" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" id="image" name="image" accept="image/*">
                        <small class="form-help">Upload an image for this portfolio item. Recommended dimensions: 600x400 pixels.</small>
                        <div id="current-image-container" style="display:none;">
                            <p>Current image:</p>
                            <img id="current-image" src="" alt="Current portfolio image" style="max-width: 300px; max-height: 200px;">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Save Portfolio Item</button>
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
            const portfolioItems = <?php echo json_encode($portfolio['items']); ?>;
            const item = portfolioItems[index];
            
            document.getElementById('form-title').textContent = 'Edit Portfolio Item';
            document.getElementById('form-action').value = 'edit';
            document.getElementById('item-id').value = index;
            document.getElementById('title').value = item.title || '';
            document.getElementById('description').value = item.description || '';
            document.getElementById('full_description').value = item.full_description || '';
            
            // Handle current image display
            if (item.image_url) {
                document.getElementById('current-image').src = item.image_url;
                document.getElementById('current-image-container').style.display = 'block';
                document.getElementById('old-image').value = item.image_url;
            } else {
                document.getElementById('current-image-container').style.display = 'none';
                document.getElementById('old-image').value = '';
            }
            
            document.getElementById('cancel-edit').style.display = 'inline-block';
        });
    });
    
    // Handle cancel edit button
    document.getElementById('cancel-edit').addEventListener('click', function() {
        document.getElementById('form-title').textContent = 'Add New Portfolio Item';
        document.getElementById('form-action').value = 'add';
        document.getElementById('item-id').value = '';
        document.getElementById('title').value = '';
        document.getElementById('description').value = '';
        document.getElementById('full_description').value = '';
        document.getElementById('image').value = '';
        document.getElementById('current-image-container').style.display = 'none';
        document.getElementById('cancel-edit').style.display = 'none';
    });
</script>

<?php
include '../footer.php';
?>