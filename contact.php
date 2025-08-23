<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $phone = trim($_POST["phone"]);
    $project = trim($_POST["project"]);
    $website = trim($_POST["website"]); // Honeypot field

    // Validate the data
    if (empty($name) || empty($email) || empty($project)) {
        http_response_code(400);
        echo "All required fields must be filled out.";
        exit;
    }

    // Simple email validation (check for @ and .)
    if (!strpos($email, '@') || !strpos($email, '.')) {
        http_response_code(400);
        echo "Please enter a valid email address.";
        exit;
    }

    // Check if honeypot field is filled (likely a bot)
    $isSpam = !empty($website);

    // Set the recipient email address
    $to = "clintcalhoun@gmail.com"; // Change this to your email address

    // Set the email subject
    $subject = $isSpam ? "SPAM: New Estimate Request from $name" : "New Estimate Request from $name";

    // Build the email content
    $email_content = $isSpam ? "LIKELY SPAM - Honeypot field was filled\n\n" : "";
    $email_content .= "Name: $name\n";
    $email_content .= "Email: $email\n";
    if (!empty($phone)) {
        $email_content .= "Phone: $phone\n";
    }
    if ($isSpam) {
        $email_content .= "Honeypot Field (Website): $website\n";
    }
    $email_content .= "\nProject Description:\n$project\n";

    // Build the email headers
    $headers = "From: $name <$email>";

    // Send the email
    if (mail($to, $subject, $email_content, $headers)) {
        // Return a success response
        http_response_code(200);
        echo "Thank you! Your request has been sent. We'll contact you soon.";
    } else {
        http_response_code(500);
        echo "Oops! Something went wrong and we couldn't send your request.";
    }
} else {
    // Not a POST request
    http_response_code(405);
    echo "Method not allowed.";
}
?>