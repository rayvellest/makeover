<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get and sanitize form data
  $name = strip_tags(trim($_POST["name"]));
  $name = str_replace(array("\r","\n"),array(" "," "),$name);
  $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
  $message = trim($_POST["message"]);

  // Validate required fields
  if ( empty($name) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL) ) {
    http_response_code(400);
    echo "Please complete the form correctly.";
    exit;
  }

  // Recipient email - replace with your Plesk email address
  $recipient = "hello@makeover.social";

  // Email subject
  $subject = "New contact from $name";

  // Build the email content
  $email_content = "Name: $name\n";
  $email_content .= "Email: $email\n\n";
  $email_content .= "Message:\n$message\n";

  // Email headers
  $email_headers = "From: $name <$email>";

  // Send the email
  if (mail($recipient, $subject, $email_content, $email_headers)) {
    http_response_code(200);
    echo "Thank you! Your message has been sent.";
  } else {
    http_response_code(500);
    echo "Oops! Something went wrong and we couldn't send your message.";
  }

} else {
  http_response_code(403);
  echo "There was a problem with your submission, please try again.";
}
?>
