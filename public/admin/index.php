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
                <h3>About Section</h3>
                <p>Manage about section content</p>
                <a href="about/" class="btn btn-primary">Edit About Content</a>
            </div>
            
            <div class="admin-card">
                <h3>Portfolio</h3>
                <p>Manage portfolio items</p>
                <a href="portfolio/" class="btn btn-primary">Manage Portfolio</a>
            </div>
            
            <div class="admin-card">
                <h3>Testimonials</h3>
                <p>Manage testimonials</p>
                <a href="testimonials/" class="btn btn-primary">Manage Testimonials</a>
            </div>
        </div>
    </div>
</main>

<?php
include 'footer.php';
?>