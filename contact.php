<?php
// Requires a PHP host with a configured mail transport.
declare(strict_types=1);
$json = strpos($_SERVER['HTTP_ACCEPT'] ?? '', 'application/json') !== false;
function respond(int $status, bool $success, string $message): void {
    global $json;
    http_response_code($status);
    if ($json) {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['success' => $success, 'message' => $message]);
    } elseif ($success) {
        header('Location: thank-you.html', true, 303);
    } else {
        header('Content-Type: text/html; charset=utf-8');
        echo '<!doctype html><html lang="en"><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Enquiry status | Wassail Group</title><body><main><h1>We could not send your enquiry</h1><p>' . htmlspecialchars($message, ENT_QUOTES, 'UTF-8') . '</p><p>Please email <a href="mailto:info@wassailgroup.com">info@wassailgroup.com</a>, or <a href="contact.html">return to the contact form</a>.</p></main></body></html>';
    }
    exit;
}
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Allow: POST'); respond(405, false, 'Please use the contact form.');
}
function field(string $key, int $max): string {
    $value = $_POST[$key] ?? '';
    if (!is_string($value) || strlen($value) > $max) respond(422, false, 'Please check the length of your form fields.');
    return trim($value);
}
if (field('website', 200) !== '') respond(422, false, 'Unable to process this enquiry.');
$name = field('name', 600); $email = field('email', 254);
$subject = field('subject', 800); $message = field('message', 40000);
$organization = field('organization', 720); $type = field('type', 30);
if ($name === '' || $subject === '' || $message === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) respond(422, false, 'Please provide your name, a valid email address, a subject, and a message.');
if (preg_match('/[\r\n\x00]/', $email . $subject . $name)) respond(422, false, 'Please check the name, email, and subject fields.');
if (!in_array($type, ['Business', 'Partnership', 'General'], true)) $type = 'General';
session_start();
if (isset($_SESSION['last_enquiry']) && time() - $_SESSION['last_enquiry'] < 60) respond(429, false, 'Please wait a minute before submitting another enquiry.');
$to = getenv('WASSAIL_CONTACT_TO') ?: 'info@wassailgroup.com';
if (!filter_var($to, FILTER_VALIDATE_EMAIL)) respond(503, false, 'The contact service is not configured.');
$headers = ['From: Wassail Website <noreply@wassailgroup.com>', 'Reply-To: ' . $email, 'MIME-Version: 1.0', 'Content-Type: text/plain; charset=UTF-8'];
$body = "Wassail website enquiry\n\nName: $name\nEmail: $email\nCompany: $organization\nType: $type\nSubject: $subject\n\n$message";
$mailSubject = '=?UTF-8?B?' . base64_encode('[Wassail] ' . $subject) . '?=';
if (!function_exists('mail') || !@mail($to, $mailSubject, $body, implode("\r\n", $headers))) respond(503, false, 'The mail service is temporarily unavailable.');
$_SESSION['last_enquiry'] = time();
respond(200, true, 'Your enquiry has been submitted.');
