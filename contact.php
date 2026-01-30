<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Rate limiting via session
    $now = time();
    if (isset($_SESSION['last_contact']) && ($now - $_SESSION['last_contact']) < 60) {
        http_response_code(429);
        echo "<script>alert('Please wait a moment before sending another message.'); window.history.back();</script>";
        exit;
    }

    // Sanitize input
    $name    = strip_tags(trim($_POST["name"] ?? ''));
    $email   = filter_var(trim($_POST["email"] ?? ''), FILTER_SANITIZE_EMAIL);
    $message = strip_tags(trim($_POST["message"] ?? ''));

    // Validate form fields
    if (empty($name) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "<script>alert('Please complete the form correctly.'); window.history.back();</script>";
        exit;
    }

    // Length limits
    if (strlen($name) > 100 || strlen($email) > 254 || strlen($message) > 5000) {
        http_response_code(400);
        echo "<script>alert('Input too long. Please shorten your message.'); window.history.back();</script>";
        exit;
    }

    // Email configuration
    $to = "faisalakhtar336@gmail.com";
    $subject = "New Message from Portfolio — " . mb_substr($name, 0, 50);

    $email_content  = "Name: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Message:\n$message\n";

    // Use a fixed From address to avoid SPF/DKIM issues
    $headers  = "From: noreply@fai-box.online\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Send email
    if (mail($to, $subject, $email_content, $headers)) {
        $_SESSION['last_contact'] = $now;
        echo "<script>alert('Message sent successfully!'); window.history.back();</script>";
    } else {
        echo "<script>alert('Failed to send message. Please try again later.'); window.history.back();</script>";
    }
}
?>
