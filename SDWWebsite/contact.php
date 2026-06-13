<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.html');
    exit;
}

$to      = 'office@selectdw.com';
$first   = htmlspecialchars(strip_tags(trim($_POST['first_name'] ?? '')));
$last    = htmlspecialchars(strip_tags(trim($_POST['last_name']  ?? '')));
$phone   = htmlspecialchars(strip_tags(trim($_POST['phone']      ?? '')));
$email   = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
$service = htmlspecialchars(strip_tags(trim($_POST['service'] ?? $_POST['product_interest'] ?? '')));
$message = htmlspecialchars(strip_tags(trim($_POST['message'] ?? '')));
$subject = htmlspecialchars(strip_tags(trim($_POST['_subject'] ?? 'New Form Submission — Select Door & Window')));

// Basic validation
if (empty($first) || empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? 'index.html') . '?error=1');
    exit;
}

// Build email body
$body  = "New estimate request from selectdoorandwindow.com\n";
$body .= str_repeat('-', 48) . "\n\n";
$body .= "Name:    $first $last\n";
$body .= "Phone:   $phone\n";
$body .= "Email:   $email\n";
if ($service) {
    $body .= "Service: $service\n";
}
if ($message) {
    $body .= "\nMessage:\n$message\n";
}
$body .= "\n" . str_repeat('-', 48) . "\n";
$body .= "Submitted: " . date('F j, Y g:i A T') . "\n";

$headers  = "From: website@selectdoorandwindow.com\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

$sent = mail($to, $subject, $body, $headers);

header('Location: ' . ($sent ? 'thank-you.html' : (($_SERVER['HTTP_REFERER'] ?? 'index.html') . '?error=1')));
exit;
?>
