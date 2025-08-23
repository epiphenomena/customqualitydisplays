<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $project = trim($_POST["project"]);
    
    // Validate the data
    if (empty($name) || empty($email) || empty($project)) {
        echo "All fields are required.";
        exit;
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit;
    }
    
    // Set the recipient email address
    $to = "info@customqualitydisplays.com"; // Change this to your email address
    
    // Set the email subject
    $subject = "New Estimate Request from $name";
    
    // Build the email content
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Project Description:\n$project\n";
    
    // Build the email headers
    $headers = "From: $name <$email>";
    
    // Send the email
    if (mail($to, $subject, $email_content, $headers)) {
        // Redirect to a thank you page or show a success message
        echo "Thank you! Your request has been sent. We'll contact you soon.";
    } else {
        echo "Oops! Something went wrong and we couldn't send your request.";
    }
} else {
    // Not a POST request, redirect to the form
    header("Location: index.html");
    exit;
}
?>