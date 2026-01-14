<?php
// Admin Dashboard
$title = "Admin Dashboard";
include 'header.php';
?>

<main>
    <div class="container">
        <h1>Admin Dashboard</h1>

        <div class="admin-options">
            <div class="admin-card">
                <h3>Settings</h3>
                <p>Configure website settings</p>
                <a href="settings/" class="btn btn-primary">Website Settings</a>
            </div>
            
            <div class="admin-card">
                <h3>Hero Section</h3>
                <p>Manage hero section content</p>
                <a href="hero/" class="btn btn-primary">Edit Hero Content</a>
            </div>
            
            <div class="admin-card">
                <h3>Values Section</h3>
                <p>Manage values section content</p>
                <a href="values/" class="btn btn-primary">Edit Values Content</a>
            </div>
            
            <div class="admin-card">
                <h3>Portfolio</h3>
                <p>Manage portfolio items</p>
                <a href="portfolio/" class="btn btn-primary">Manage Portfolio</a>
            </div>
        </div>
    </div>
</main>

<?php
include 'footer.php';
?>