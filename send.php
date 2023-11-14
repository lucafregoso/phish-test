<?php

// Read CSV file
$csvFile = fopen('recipients.csv', 'r');
while (($line = fgetcsv($csvFile)) !== FALSE) {
  // $line is an array of the csv elements
  list($name, $surname, $email) = $line;

  // Read and prepare email template
  $template = file_get_contents('template.html');
  $template = str_replace(['*DESTINATARIO*', '*NOME*', '*COGNOME*'], [$email, $name, $surname], $template);

  // Set up email headers
  $headers = "From: Your Name <your@email.com>\r\n";
  $headers .= "Reply-To: your@email.com\r\n";
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

  // Send the email
  if (!mail($email, "Your Email Subject", $template, $headers)) {
    echo "Failed to send email to $email\n";
  }
  usleep(200);
}

fclose($csvFile);