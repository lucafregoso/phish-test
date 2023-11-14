<?php

// Check if the email parameter is set
if (isset($_GET['email'])) {
    // Sanitize the email input
    $email = filter_var($_GET['email'], FILTER_SANITIZE_EMAIL);
    // Get the current timestamp
    $timestamp = date('Y-m-d H:i:s');

    // The file to which the data will be appended
    $file = 'log.csv';

    // Data to append
    $data = [$email, $timestamp];

    // Open the file in append mode
    $handle = fopen($file, 'a+');

    // Write the data to the file
    fputcsv($handle, $data);

    // Close the file
    fclose($handle);

    // Path to your HTML file
    $htmlFilePath = 'output.html';
    
    // Check if the HTML file exists
    if (file_exists($htmlFilePath)) {
        // Read and output the HTML file
        readfile($htmlFilePath);
    } else {
        // Fallback message if the HTML file is not found
        echo "<html><head><title>PHISHING DONE</title></head><body><p>Thank you</p></body></html>";
    }
} else {
    // Fallback message if the email param is not set
    echo "<html><head><title>Warning</title></head><body><p>Wrong address</p></body></html>";
}