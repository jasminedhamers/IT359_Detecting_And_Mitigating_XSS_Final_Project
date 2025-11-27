<?php
/**
 * Server-Side Input Validation and Filtering
 * * This function sanitizes user input to prevent Cross-Site Scripting (XSS)
 * by stripping out dangerous HTML tags and event handlers.
 * This is the first layer of defense.
 * * @param string $input The raw user input string (e.g., from $_POST or $_GET).
 * @return string The sanitized, safe input string.
 */
function sanitize_xss_input($input) {
    // 1. Remove dangerous tags and their contents (e.g., <script>...</script>)
    $sanitized = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', '', $input);
    
    // 2. Strip event handlers (e.g., onerror, onload) from any remaining tags
    // This is a simplified regex; production code is more complex.
    $sanitized = preg_replace('/(on[a-z]+)=/i', 'data-$1=', $sanitized);
    
    // 3. Strip dangerous protocols (e.g., javascript: links)
    $sanitized = preg_replace('/(href|src)="(.*?)javascript:/i', '$1="data-javascript:', $sanitized);

    // 4. Use PHP's built-in function to convert remaining special characters
    $sanitized = filter_var($sanitized, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    
    return $sanitized;
}

// Example Usage (for demonstration purposes):
// $username = "User<script>alert('XSS');</script>Name";
// $safe_username = sanitize_xss_input($username);
// echo "Original: " . $username . "\n";
// echo "Sanitized: " . $safe_username . "\n";

?>
